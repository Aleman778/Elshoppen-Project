<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/admin/access.php");
    include("$root/modules/mysql.php");

    try {
        $oid = $_GET["oid"];
        $temp = 1;

        $db = new MySQL();
       
        $db->query("START TRANSACTION"); 
        
        $db->query("UPDATE ORDERS SET handled=$temp WHERE id=$oid;");

        $db->query("COMMIT;");

        //header("Location: /admin/orders/list/?edit=success&oid=$oid");
    } catch (Exception $e) {
        //header("Location: /admin/orders/edit/edit?edit=error&oid=$oid&pid=$pid&msg=" . $e->getMessage());
    }
?>