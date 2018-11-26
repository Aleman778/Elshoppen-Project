<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    $customer_id = 0;
    $product_id = 0;
    $reply_id = 0;
    $comment = "";

    if (session_status() == PHP_SESSION_NONE)
        session_start();
    
    if (array_key_exists("customer_id", $_SESSION))
        $customer_id = $_SESSION["customer_id"];

    if (array_key_exists("product_id", $_POST))
        $product_id = $_POST["product_id"];
    
    if (array_key_exists("reply_id", $_POST))
        $reply_id = $_POST["reply_id"];

    if (array_key_exists("comment", $_POST))
        $comment = $_POST["comment"];

    $sql = "INSERT INTO COMMENTS (customer_id, product_id, reply_id, comment)
            VALUES (:cid, :pid, :rid, :msg)";
    
    $params = array(
            "cid" => $customer_id,
            "pid" => $product_id,
            "rid" => $reply_id,
            "msg" => $comment);

    include("$root/modules/mysql.php");
    $db = new MySQL();
    try {
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        echo "Success! you have to refresh the page to see you comment!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>