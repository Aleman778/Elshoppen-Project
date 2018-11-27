<?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    $customer_id = 0;
    $product_id = 0;
    $arg = "1";
    
    session_start();
        
    if (array_key_exists("customer_id", $_SESSION))
        $customer_id = $_SESSION["customer_id"];
    else
        header("Location: /account/signin");

    if (array_key_exists("id", $_GET))
        $product_id = $_GET["id"];

    if (array_key_exists("action", $_GET))
        $action = $_GET["action"];
        
    if (array_key_exists("arg", $_GET))
        $arg = $_GET["arg"];
    
    include("$root/modules/mysql.php");
    $sql = "SELECT quantity FROM CART
            WHERE customer_id=:cid AND product_id=:pid";
    $db = new MySQL();
    $params = array("cid" => $_SESSION["customer_id"], "pid" => $_GET["id"]);

    try {
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $data = $stmt->fetch();
        if (!$data) {
            $sql = "INSERT INTO CART (customer_id, product_id, quantity)
                    VALUES (:cid, :pid, 1)";
            $stmt = $db->prepare($sql);
            $stmt->execute($params);
        } else if ($data["quantity"]) {
            if ($action == "set") {
                $sql = "UPDATE CART SET quantity=$arg
                        WHERE customer_id=:cid AND product_id=:pid";
                $stmt = $db->prepare($sql);
                $stmt->execute($params);
            } else if ($action == "delete") {
                $sql = "DELETE FROM CART
                        WHERE customer_id=:cid AND product_id=:pid";
                $stmt = $db->prepare($sql);
                $stmt->execute($params);
            } else if ($action == "decrement") {
                $decr = $data["quantity"] - 1;
                $sql = "UPDATE CART SET quantity=$incr
                WHERE customer_id=:cid AND product_id=:pid";
                $stmt = $db->prepare($sql);
                $stmt->execute($params);
            } else {
                $incr = $data["quantity"] + 1;
                $sql = "UPDATE CART SET quantity=$incr
                        WHERE customer_id=:cid AND product_id=:pid";
                $stmt = $db->prepare($sql);
                $stmt->execute($params);
            }
        }   
        echo "success";   
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>