<?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    
    session_start();
        
    if (array_key_exists("customer_id", $_SESSION))
        $customer_id = $_SESSION["customer_id"];
    else
        header("Location: /account/signin");

    if (array_key_exists("id", $_GET))
        $product_id = $_GET["id"];
    
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
            $incr = $data["quantity"] + 1;
            $sql = "UPDATE CART SET quantity=$incr
                    WHERE customer_id=:cid AND product_id=:pid";
            $stmt = $db->prepare($sql);
            $stmt->execute($params);
        }
        var_dump($data);
    } catch (PDOException $e) {
        $msg = $e->getMessage();
        header("Location: /product/details/index.php?id=" . $_GET["id"] . "&err=$msg");
    }

    header("Location: /product/details/index.php?id=" . $_GET["id"]);
?>