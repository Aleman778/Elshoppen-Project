<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/admin/access.php");
    include("$root/modules/mysql.php");

    try {
        $db = new MySQL();
        $stmt = $db->prepare("DELETE FROM PRODUCTS WHERE id=:pid");
        $stmt->execute(array("pid" => $_GET["id"]));
        header("Location: /admin/products/list/?del=success");
    } catch (Exception $e) {
        header("Location: /admin/products/list/?del=error&msg=" . $e->getMessage());
    }
?>