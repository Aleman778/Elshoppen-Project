<?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/modules/mysql.php");

    session_start();
    if (!(array_key_exists("customer_id", $_SESSION))) {
        header("Location: /");
        exit;
    }
    $pass_len = strlen($_POST["psw"]);
    if ($pass_len < 4 or $pass_len > 20){
        header("Location: change_password.php?err=pass_length");
        exit;
    }
    if ($_POST["psw"] != $_POST["psw-repeat"]){
        header("Location: change_password.php?err=pass_mismatch");
        exit;
    }

    
    $db = new MySQL();
    $db->query("START TRANSACTION");
    
    $phash = password_hash($_POST["psw"], PASSWORD_DEFAULT);

    $sql = "UPDATE CUSTOMERS SET password = :psw where id = :id;";
    $p = $db->prepare($sql);
    $p->execute(array(  "psw" => $phash,
                        "id" => $_SESSION["customer_id"]));    
    $db->query("COMMIT");
    header("Location: index.php");
?>