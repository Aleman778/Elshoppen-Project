<?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/modules/mysql.php");

    session_start();
    if (!(array_key_exists("customer_id", $_SESSION))) {
        header("Location: /");
        exit;
    }

    //Check for invalid firstname and lastname.
    $fname_len = strlen($_POST["first-name"]);
    $lname_len = strlen($_POST["last-name"]);
    if ($fname_len > 40){
        header("Location: change_info.php?err=fname_length");
        exit;
    }
    if ($lname_len > 40){
        header("Location: change_info.php?err=lname_length");
        exit;
    }
    if ($fname_len == 0){
        header("Location: change_info.php?err=fname_empty");
        exit;
    }
    if ($lname_len == 0){
        header("Location: change_info.php?err=lname_empty");
        exit;
    }
    
    $db = new MySQL();
    $db->query("START TRANSACTION");
    
    $sql = "UPDATE CUSTOMERS SET firstname = :fname, lastname = :lname, 
            birth_date = :bday, email = :email, 
            phone_number = :mobile_number, address = :address where id = :id;";

    $p = $db->prepare($sql);
    $p->execute(array(  "fname" => $_POST["first-name"],
                        "lname" => $_POST["last-name"],
                        "bday" => $_POST["bday"],
                        "email" => $_POST["email"],
                        "mobile_number" => $_POST["mobile-number"],
                        "address" => $_POST["address"],
                        "id" => $_SESSION["customer_id"]));    
    $db->query("COMMIT");

    header("Location: index.php");
?>