<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/admin/access.php");
    include("$root/modules/mysql.php");

    try {
        $db = new MySQL();
        $stmt = $db->prepare("DELETE FROM COMMENTS WHERE id=:pid;");
        $stmt->execute(array("pid" => $_GET["id"]));
        header("Location: /admin/comments/list/?del=success");
    } catch (Exception $e) {
        header("Location: /admin/comments/list/?del=error&msg=" . $e->getMessage());
    }
?>