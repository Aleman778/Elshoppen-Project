<?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/modules/mysql.php");
    include("$root/admin/access.php");
    

    $cid = $_GET["cid"];

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

    $db = new MySQL();
    $db->query("START TRANSACTION");
    
    if($_POST["psw"] != "") {
        $phash = password_hash($_POST["psw"], PASSWORD_DEFAULT);
    }
    else {
        $phash = $db->fetch("SELECT password FROM CUSTOMERS WHERE id = $cid")["password"];
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
                        "id" => $cid,
                        "psw"=> $phash ));    
    $role = $_POST["role"];
    if ($role == "Kund") {
        $stmt = $db->prepare("DELETE FROM EMPLOYEES WHERE id=:cid");
        $stmt->execute(array("cid" => $cid));
    } else if ($role == "Admin" or $role == "Moderator") {
        $row = $db->fetch("SELECT id FROM EMPLOYEES WHERE id=$cid");
        var_dump($row);
            if ($row == false) {
                $stmt = $db->prepare("INSERT INTO EMPLOYEES (id, role) VALUES (:cid, :prole)");
                $stmt->execute(array(   "cid" => $cid,
                                        "prole" => $role));
            }
            else {
                $stmt = $db->prepare("UPDATE EMPLOYEES SET role = :prole WHERE id=:cid");
                $stmt->execute(array(   "cid" => $cid,
                                        "prole" => $role));
            }
    }
    $db->query("COMMIT");

    header("Location: /admin/users/list/");
?>