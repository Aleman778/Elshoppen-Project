<?php 
  $root = $_SERVER['DOCUMENT_ROOT'];

  $address = htmlspecialchars($_REQUEST['address']);
  $email = htmlspecialchars($_REQUEST['email']);
  
  session_start();
  if ((!array_key_exists("customer_id", $_SESSION)) or ($address == NULL) or ($email == NULL)) {
      header("Location: /");
      exit;
  }
  include("$root/modules/mysql.php");

  $customer_id = $_SESSION["customer_id"];

  $pid = $_GET["pid"];

  $db = new MySQL();

  if ($pid != "f") {
    $db->query("START TRANSACTION"); 

    $sql_insert_order = "INSERT INTO ORDERS (id, customer_id, address, email, time) 
                          VALUES (DEFAULT, :customer_id, :address, :email, NOW());";
    $qi = $db->prepare($sql_insert_order);
    $qi->execute(array(':customer_id' => $customer_id,
                      ':address' => $address,
                      ':email' => $email)); 

    $order_id = $db->fetch("SELECT LAST_INSERT_ID();");

    $sql_product = "SELECT inventory, price FROM PRODUCTS WHERE id = :pid";
    $qp = $db->prepare($sql_product);
    $qp->execute(array(':pid' => $pid));
    $product_order = $qp->fetch();

    $sql_insert_product = "INSERT INTO ORDERS_PRODUCTS (order_id, product_id, quantity, price) 
                            VALUES (:order_id, :product_id, :quantity, :price)";
    $p = $db->prepare($sql_insert_product);
    $p->execute(array('order_id' => $order_id[0],
                        'product_id' => $pid,
                        'quantity' => 1,
                        'price' => $product_order["price"]));

    
    $inv = $product_order["inventory"] - 1;
    $db->query("UPDATE PRODUCTS SET inventory = $inv WHERE id = $pid");

    $db->query("COMMIT;");
  }
  else {
    // Starting a transaction.
    $db->query("START TRANSACTION"); 

    // Adding order to table ORDERS.
    $sql_insert_order = "INSERT INTO ORDERS (id, customer_id, address, email, time) 
                          VALUES (DEFAULT, :customer_id, :address, :email, NOW());";
    $qi = $db->prepare($sql_insert_order);
    $qi->execute(array(':customer_id' => $customer_id,
                      ':address' => $address,
                      ':email' => $email)); 

    // Geting the id of the order.
    $order_id = $db->fetch("SELECT LAST_INSERT_ID();"); 

    // Geting the products from the cart.
    $sql_products = "SELECT CART.product_id, CART.quantity, PRODUCTS.price, PRODUCTS.inventory
                                FROM CART
                                INNER JOIN PRODUCTS on CART.product_id = PRODUCTS.id
                                WHERE CART.customer_id = :customer_id";       
    $qp = $db->prepare($sql_products);
    $qp->execute(array(':customer_id' => $customer_id));
    $products_order = $qp->fetchAll();

    foreach ($products_order as $order) {
      // Inserting item into order.
      $sql_insert_product = "INSERT INTO ORDERS_PRODUCTS (order_id, product_id, quantity, price) 
                            VALUES (:order_id, :product_id, :quantity, :price)";
      $p = $db->prepare($sql_insert_product);
      $p->execute(array('order_id' => $order_id[0],
                        'product_id' => $order["product_id"],
                        'quantity' => $order["quantity"],
                        'price' => (string) $order["price"]));
      
      // Update product inventory.
      $inv = $order["inventory"] - $order["quantity"];
      $uinv = "UPDATE PRODUCTS SET inventory = :inv WHERE id = :pid";
      $pu = $db->prepare($uinv);
      $pu->execute(array(  'inv' => $inv,
                          'pid' => $order["product_id"]));

      // Deleting item from cart.
      $sql = "DELETE FROM CART
              WHERE customer_id=:cid AND product_id=:pid";
      $stmt = $db->prepare($sql);
      $stmt->execute(array('pid' => $order["product_id"],
                            'cid' => $customer_id));
    }
    // End transaction.
    $db->query("COMMIT;");
  }
  
  //header("Location: /account/orders/orderd.php");
?>