<?php 
    include("../modules/mysql.php");

    var_dump($_POST);
    $fname_len = strlen($_POST["first-name"]);
    $lname_len = strlen($_POST["last-name"]);
    $pass_len = strlen($_POST["psw"]);
    if ($fname_len > 40)
        header("Location: index.php?err=fname_length");
    else if ($lname_len > 40)
        header("Location: index.php?err=lname_length");
    else if ($fname_len == 0)
        header("Location: index.php?err=fname_empty");
    else if ($lname_len == 0)
        header("Location: index.php?err=lname_empty");
    else if ($pass_len < 4 or $pass_len > 20)
        header("Location: index.php?err=pass_length");
    else if ($_POST["psw"] != $_POST["psw-repeat"])
        header("Location: index.php?err=pass_mismatch");


    $sql = "INSERT INTO CUSTOMERS (lastname, firstname, password, gender, birth_date,
                                   email, removed phone_number, address)
            VALUES (:lname, :fname, :pass, :gender, :bdate, :email, 0,
                    :pnum, :addr)";

    $params = array("lname" => $_POST["last-name"],
                    "fname" => $_POST["first-name"],
                    "pass" => $_POST["psw"],
                    "gender" => $_POST["gender"][0],
                    "bdate" => strtotime($_POST["bday"]),
                    "email" => $_POST["email"],
                    "pnum" => $_POST["mobile-number"],
                    "addr" => $_POST["address"]);
    
    $db = new MySQL();
    try {
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage();
    }
?>