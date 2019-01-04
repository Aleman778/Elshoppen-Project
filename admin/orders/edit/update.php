<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/admin/access.php");
    include("$root/modules/mysql.php");

    try {
        $oid = $_GET["oid"];
        $pid = $_GET["pid"];
        $quan = $_POST["quantity"];

        $db = new MySQL();
       
        $db->query("START TRANSACTION"); 
        
        $db->query("UPDATE ORDERS_PRODUCTS SET quantity=$quan WHERE product_id=$pid AND order_id=$oid;");

        $db->query("COMMIT;");

        header("Location: /admin/orders/edit/?edit=success&oid=$oid");
    } catch (Exception $e) {
        header("Location: /admin/orders/edit/edit?edit=error&oid=$oid&pid=$pid&msg=" . $e->getMessage());
    }
?>