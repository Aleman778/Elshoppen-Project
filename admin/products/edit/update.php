<?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/modules/mysql.php");
    include("$root/admin/access.php");

    var_dump($_POST);

    $pid = $_GET["pid"];

    $db = new MySQL();
    $db->query("START TRANSACTION");

    $sql = "UPDATE PRODUCTS SET name = :name, 
            price = :price, inventory = :inventory, image_ref = :image_ref,
            category = :category, description = :description, removed = :removed where id = :pid;";

    $p = $db->prepare($sql);
    $p->execute(array(  "name" => $_POST["name"],
                        "price" => $_POST["price"],
                        "inventory" => $_POST["inventory"],
                        "image_ref" => $_POST["imageFolder"],
                        "category" => $_POST["category"],
                        "description" => $_POST["description"],
                        "removed" => $_POST["removed"],
                        "pid" => $pid));    
    
    $db->query("COMMIT");

    header("Location: /admin/products/list/");
?>