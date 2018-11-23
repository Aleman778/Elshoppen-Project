<?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    
    session_start();
    if (array_key_exists("customer_id", $_SESSION))
        header("Location: /");

    include("$root/modules/mysql.php");
    $sql = "SELECT firstname, lastname, password, email, id FROM CUSTOMERS WHERE email = :email";
    $db = new MySQL();
    $stmt = $db->prepare($sql);
    $stmt->execute(array('email' => $_POST["email"]));
    $data = $stmt->fetch();

    if (!$data) { //Check if you get any password
        header("Location: index.php?err=email");
    } else {
        $success = password_verify($_POST["psw"], $data["password"]);
        if($success){ //if true go to front page and login
            $_SESSION["customer_id"] = $data["id"];
            $_SESSION["firstname"] = $data["firstname"];
            $_SESSION["lastname"] = $data["lastname"];
            $_SESSION["email"] = $data["email"];
            header("Location: /");
        } else { //go back to login page
            header("Location: index.php?err=pass");
        }
    }
 ?>