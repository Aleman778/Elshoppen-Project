
<?php

    include("../../modules/mysql.php");

    $name = htmlspecialchars($_REQUEST['name']);
    $db = new MySQL();
    $sql = "SELECT id, name, price, image_ref From PRODUCTS WHERE name LIKE '%$name%'";

  ?>