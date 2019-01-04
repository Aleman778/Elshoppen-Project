<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/admin/access.php");
    include("$root/modules/mysql.php");

    try {
        $oid = $_GET["oid"];
        $pid = $_GET["pid"];
       
        $db = new MySQL();
       
        $db->query("START TRANSACTION"); 
        
        $sql = "DELETE FROM ORDERS_PRODUCTS WHERE order_id=$oid AND product_id=$pid";
        $db->query($sql); 

        $db->query("COMMIT;");

        header("Location: /admin/orders/edit/?del=success&oid=$oid");
    } catch (Exception $e) {
        header("Location: /admin/orders/edit/?del=error&oid=$oid&msg=" . $e->getMessage());
    }
?>