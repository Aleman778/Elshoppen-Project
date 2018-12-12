<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    $customer_id = 0;
    $loggedIn = false;
    $product_id = 0;
    $rating = 0;
    $review = array();

    if (session_status() == PHP_SESSION_NONE)
        session_start();
    
    if (array_key_exists("customer_id", $_SESSION)) {
        $customer_id = $_SESSION["customer_id"];
        $loggedIn = true;
    }
    if (array_key_exists("product_id", $_POST))
        $product_id = $_POST["product_id"];
    if (array_key_exists("review", $_POST))
        $review["review"] = $_POST["review"];
    if (array_key_exists("firstname", $_SESSION))
        $review["firstname"] = $_SESSION["firstname"];
    if (array_key_exists("lastname", $_SESSION))
        $review["lastname"] = $_SESSION["lastname"];
    if (array_key_exists("role", $_SESSION))
        $review["role"] = $_SESSION["role"];
    if (array_key_exists("email", $_SESSION)) {
        $review["email"] = $_SESSION["email"];
        $email = $review["email"];
    }
    if (array_key_exists("rating", $_POST))
        $rating = $_POST["rating"];

    //Insert review into databaase
    $sql = "INSERT INTO REVIEWS (customer_id, product_id, rating, review)
            VALUES (:cid, :pid, :rat, :rev";
    
    $params = array(
            "cid" => $customer_id,
            "pid" => $product_id,
            "rat" => $rating,
            "rev" => $review["review"]);

    include("$root/modules/mysql.php");
    $db = new MySQL();
    try {
        $stmt = $db->prepare($sql);
        $stmt->execute($params);

        $sql = "SELECT id FROM REVIEW WHERE customer_id=:cid AND product_id=:pid AND
                                            rating=:rat AND review=:rev";            
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $review["id"] = $stmt->fetch()["id"];
    } catch (PDOException $e) {
        echo "Error!";
    }
    include("gravatar.php");
    include("review.php");
?>