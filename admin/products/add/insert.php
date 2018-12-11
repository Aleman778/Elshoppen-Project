<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/admin/access.php");

    /*$db = new MySQL();
    $sql = "INSERT INTO PRODUCTS (name, price, inventory, image_ref, category, description)
            VALUES (:name, :price, :inv, :imr, :cat, :desc)";
    $params = array("name" => $_POST["name"],
                    )
    $db->execute();*/
    var_dump($_POST);
?>