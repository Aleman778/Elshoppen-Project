<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/admin/access.php");
    include("$root/modules/mysql.php");

    //Build image reference (image_folder,image1,image2, etc...)
    try {
        $imageref = $_POST["imageFolder"];
        foreach ($_POST as $key => $value) {
            if (strpos($key, "image-") !== false and $value = "on") {
                $suffix = substr($key, 6);
                $imageref .= "," . $_POST["file-$suffix"]; 
            }
        }

        $db = new MySQL();
        $sql = "INSERT INTO PRODUCTS (name, price, inventory, category, description, image_ref)
                VALUES (:name, :price, :inv, :cat, :desc, :imr)";
        $params = array("name"  => $_POST["name"],
                        "price" => $_POST["price"],
                        "inv"   => $_POST["inventory"],
                        "cat"   => $_POST["category"],
                        "desc"  => $_POST["description"],
                        "imr"   => $imageref);

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        header("Location: /admin/products/add/?ins=success");
    } catch (Exception $e) {
        header("Location: /admin/products/add/?ins=error&msg=" . $e->getMessage());
    }
?>