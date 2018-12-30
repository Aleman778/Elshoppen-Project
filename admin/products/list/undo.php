<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/admin/access.php");
    include("$root/modules/mysql.php");

    try {
        $db = new MySQL();
        $stmt = $db->prepare("UPDATE PRODUCTS SET removed='0' WHERE id=:pid;");
        $stmt->execute(array("pid" => $_GET["id"]));
        header("Location: /admin/products/list/");
    } catch (Exception $e) {
        header("Location: /admin/products/list/");
    }
?>