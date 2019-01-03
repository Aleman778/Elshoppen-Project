<?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/modules/mysql.php");
    include("$root/admin/access.php");

    $imageref = $_POST["imageFolder"];
    foreach ($_POST as $key => $value) {
        if (strpos($key, "image-") !== false and $value = "on") {
            $suffix = substr($key, 6);
            $imageref .= "," . $_POST["file-$suffix"]; 
        }
    }

    $pid = $_GET["pid"];

    $db = new MySQL();
    $db->query("START TRANSACTION");

    $sql = "UPDATE PRODUCTS SET name = :name, 
            price = :price, inventory = :inventory, image_ref = :image_ref,
            category = :category, description = :description where id = :pid;";

    $p = $db->prepare($sql);
    $p->execute(array(  "name" => $_POST["name"],
                        "price" => $_POST["price"],
                        "inventory" => $_POST["inventory"],
                        "image_ref" => $imageref,
                        "category" => $_POST["category"],
                        "description" => $_POST["description"],
                        "pid" => $pid));    
    
    $db->query("COMMIT");

    header("Location: /admin/products/list/");
?>