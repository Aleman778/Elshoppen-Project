<?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/modules/mysql.php");

    $pid = $_GET["pid"];

    //Check for invalid firstname and lastname.
    $fname_len = strlen($_POST["first-name"]);
    $lname_len = strlen($_POST["last-name"]);
    if ($fname_len > 40){
        header("Location: index.php?err=fname_length");
        exit;
    }
    if ($lname_len > 40){
        header("Location: index.php?err=lname_length");
        exit;
    }
    if ($fname_len == 0){
        header("Location: index.php?err=fname_empty");
        exit;
    }
    if ($lname_len == 0){
        header("Location: index.php?err=lname_empty");
        exit;
    }
    if ($_POST["psw"] != $_POST["psw-repeat"]){
        header("Location: index.php?err=pass_mismatch");
        exit;
    }
    var_dump($_POST["psw"]);

    $db = new MySQL();
    $db->query("START TRANSACTION");
    
    if($_POST["psw"] != "") {
        $phash = password_hash($_POST["psw"], PASSWORD_DEFAULT);
    }
    else {
        $phash = $db->fetch("SELECT password FROM CUSTOMERS WHERE id = $pid");
    }

    $sql = "UPDATE CUSTOMERS SET firstname = :fname, lastname = :lname, 
            birth_date = :bday, email = :email, password = :psw,
            phone_number = :mobile_number, address = :address where id = :id;";

    $p = $db->prepare($sql);
    $p->execute(array(  "fname" => $_POST["first-name"],
                        "lname" => $_POST["last-name"],
                        "bday" => $_POST["bday"],
                        "email" => $_POST["email"],
                        "mobile_number" => $_POST["mobile-number"],
                        "address" => $_POST["address"],
                        "id" => $pid,
                        "psw"=> $phash ));    
    $db->query("COMMIT");

    header("Location: http://localhost/admin/users/list/");
?>