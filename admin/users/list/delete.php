<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/admin/access.php");
    $deleteAccess = checkAccess("/admin/products/list/delete.php");
?>