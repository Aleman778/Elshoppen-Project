<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    $customer_id = 0;
    $loggedIn = false;
    $product_id = 0;
    $reply_id = 0;
    $comment = array();

    if (session_status() == PHP_SESSION_NONE)
        session_start();
    
    if (array_key_exists("customer_id", $_SESSION)) {
        $customer_id = $_SESSION["customer_id"];
        $loggedIn = true;
    }
    if (array_key_exists("product_id", $_POST))
        $product_id = $_POST["product_id"];
    if (array_key_exists("reply_id", $_POST))
        $reply_id = $_POST["reply_id"];
    if (array_key_exists("comment", $_POST))
        $comment["comment"] = $_POST["comment"];
    if (array_key_exists("firstname", $_SESSION))
        $comment["firstname"] = $_SESSION["firstname"];
    if (array_key_exists("lastname", $_SESSION))
        $comment["lastname"] = $_SESSION["lastname"];
    if (array_key_exists("role", $_SESSION))
        $comment["role"] = $_SESSION["role"];
    if (array_key_exists("email", $_SESSION)) {
        $comment["email"] = $_SESSION["email"];
        $email = $comment["email"];
    }

    //Insert comment into databaase
    $sql = "INSERT INTO COMMENTS (customer_id, product_id, reply_id, comment, time)
            VALUES (:cid, :pid, :rid, :msg, NOW())";
    
    $params = array(
            "cid" => $customer_id,
            "pid" => $product_id,
            "rid" => $reply_id,
            "msg" => $comment["comment"]);

    include("$root/modules/mysql.php");
    $db = new MySQL();
    try {
        $stmt = $db->prepare($sql);
        $stmt->execute($params);

        $sql = "SELECT id, time FROM COMMENTS WHERE customer_id=:cid AND product_id=:pid AND
                                            reply_id=:rid AND comment=:msg";            
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $data = $stmt->fetch();
        $comment["id"] = $data["id"];
        $comment["time"] = $data["time"];
    } catch (PDOException $e) {
        echo "Error!";
    }
    include("gravatar.php");
    include("comment.php");
?>