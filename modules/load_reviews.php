<?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    $product_id = 0;

    include("$root/modules/product_stars.php");

    if (array_key_exists("id", $_GET))
        $product_id = $_GET["id"];
    else if (array_key_exists("product_id", $_POST))
        $product_id = $_POST["product_id"];

    if (!isset($db)) {
        $loggedIn = false;
        if (session_status() == PHP_SESSION_NONE)
            session_start();
        if (array_key_exists("customer_id", $_SESSION))
            $loggedIn = true;
        if (array_key_exists("email", $_SESSION))
            $email = $_SESSION["email"];
            
        include("mysql.php");
        include("gravatar.php");
        $db = new MySQL();
    }
    $sql = "SELECT REVIEWS.*, CUSTOMERS.firstname, CUSTOMERS.lastname, CUSTOMERS.email
            FROM CUSTOMERS JOIN REVIEWS
            WHERE CUSTOMERS.id=REVIEWS.customer_id AND REVIEWS.product_id=:prid LIMIT 10";
    // not working
    try {
        $stmt = $db->prepare($sql);
        $stmt->execute(array("prid" => $product_id));
        $reviews = $stmt->fetchAll();

        foreach ($reviews as $review) { 
            include("review.php");
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }    
?>
