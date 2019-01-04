<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/admin/access.php");
    include("$root/modules/mysql.php");

    try {
        $oid = $_GET["oid"];
       
        $db = new MySQL();
       
        $db->query("START TRANSACTION"); 
        
        $sql = "SELECT * FROM ORDERS_PRODUCTS WHERE order_id=$oid";
        $products_order = $db->fetchAll($sql);

        foreach ($products_order as $order) {
            $pid = $order["product_id"];
            $sql = "DELETE FROM ORDERS_PRODUCTS WHERE order_id=$oid AND product_id=$pid";
            $db->query($sql); 
        }

        $sql = "DELETE FROM ORDERS WHERE id=$oid";
        $db->query($sql); 

        // End transaction.
        $db->query("COMMIT;");

        header("Location: /admin/orders/list/?del=success");
    } catch (Exception $e) {
        header("Location: /admin/orders/list/?del=error&msg=" . $e->getMessage());
    }
?>