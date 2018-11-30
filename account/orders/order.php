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

  $db = new MySQL();

  //insert into database
  $sql_start = "START TRANSACTION;";
  $sql_insert_order = "INSERT INTO ORDERS (id, customer_id, address, email) 
                         VALUES (DEFAULT, :customer_id, :address, :email);";
  $sql_order_id = "SELECT LAST_INSERT_ID();";
  $sql_products = "SELECT CART.product_id, CART.quantity, PRODUCTS.price
                              FROM CART
                              INNER JOIN PRODUCTS on CART.product_id = PRODUCTS.id
                              WHERE CART.customer_id = :customer_id";       
  $qi = $db->prepare($sql_insert_order);
  $qp = $db->prepare($sql_products);
  $db->query($sql_start);
  $qi->execute(array(':customer_id' => $customer_id,
                    ':address' => $address,
                    ':email' => $email)); // denna funkar ej för någon anledning
  $order_id = $db->fetch($sql_order_id);
  $qp->execute(array(':customer_id' => $customer_id));
  $products_order = $qp->fetchAll();

  foreach ($products_order as $order) {
    $sql_insert_product = "INSERT INTO ORDERS_PRODUCTS (order_id, product_id, quantity, price) 
                          VALUES (:order_id, :product_id, :quantity, :price)";
    $p = $db->prepare($sql_insert_product);
    $p->execute(array('order_id' => $order_id[0],
                      'product_id' => $order["product_id"],
                      'quantity' => $order["quantity"],
                      'price' => (string) $order["price"]));
    $sql = "DELETE FROM CART
            WHERE customer_id=:cid AND product_id=:pid";
    $stmt = $db->prepare($sql);
    $stmt->execute(array('pid' => $order["product_id"],
                          'cid' => $customer_id));
  }
  $sql_end = "COMMIT;";
  $db->query($sql_end);
  
  
  header("Location: /account/orders/orderd.php");
?>