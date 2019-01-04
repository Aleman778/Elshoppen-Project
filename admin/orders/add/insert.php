<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/admin/access.php");
    include("$root/modules/mysql.php");

    try {
        $oid = $_GET["oid"];
        $pid = $_POST["pid"];
        $quan = $_POST["quantity"];

        $db = new MySQL();
       
        $price = $db->fetch("SELECT price FROM PRODUCTS WHERE id=$pid")["price"];

        $db->query("START TRANSACTION"); 
        
        $db->query("INSERT INTO ORDERS_PRODUCTS (order_id, product_id, quantity, price) VALUES ($oid, $pid, $quan, $price)");

        $db->query("COMMIT;");

        header("Location: /admin/orders/edit/?ins=success&oid=$oid");
    } catch (Exception $e) {
        header("Location: /admin/orders/add/?ins=error&oid=$oid&msg=" . $e->getMessage());
    }
?>