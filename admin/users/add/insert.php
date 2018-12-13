<?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/admin/access.php");
    include("$root/admin/access.php");
    
    $editAccess = checkAccess("/admin/products/list/edit.php");
    if (!$editAccess) {
        header("Location: http://localhost/admin/users/list/");
        exit;
    }

    //Check for invalid firstname, lastname and password.
    $fname_len = strlen($_POST["first-name"]);
    $lname_len = strlen($_POST["last-name"]);
    $pass_len = strlen($_POST["psw"]);
    if ($fname_len > 40)
        header("Location: index.php?err=fname_length");
    if ($lname_len > 40)
        header("Location: index.php?err=lname_length");
    if ($fname_len == 0)
        header("Location: index.php?err=fname_empty");
    if ($lname_len == 0)
        header("Location: index.php?err=lname_empty");
    if ($pass_len < 4 or $pass_len > 20)
        header("Location: index.php?err=pass_length");
    if ($_POST["psw"] != $_POST["psw-repeat"])
        header("Location: index.php?err=pass_mismatch");

    //Sql statement
    $sql = "INSERT INTO CUSTOMERS (lastname, firstname, password, gender, birth_date,
                                   email, removed, phone_number, address)
            VALUES (:lname, :fname, :pass, :gender, CAST(:bdate AS DATE), :email, 0,
                    :pnum, :addr)";

    //Hash and salt password
    $phash = password_hash($_POST["psw"], PASSWORD_DEFAULT);

    //Insert parameters
    $params = array("lname" => $_POST["last-name"],
                    "fname" => $_POST["first-name"],
                    "pass" => $phash,
                    "gender" => $_POST["gender"][0],
                    "bdate" => $_POST["bday"],
                    "email" => $_POST["email"],
                    "pnum" => $_POST["mobile-number"],
                    "addr" => $_POST["address"]);
    
    //Execute insert query
    include("$root/modules/mysql.php");
    $db = new MySQL();
    try {
        $stmt = $db->prepare($sql);
        $stmt->execute($params);

        //Get the generated id
        $stmt = $db->prepare("SELECT id FROM CUSTOMERS WHERE email=:email");
        $stmt->execute(array("email" => $_POST["email"]));
        $data = $stmt->fetch();
        if (!$data) {
            header("Location: index.php?err=other&errmsg=Databas fel, försök igen.");
        }
        $id = (int) $data["id"];

        header("Location: http://localhost/admin/users/list/");
    } catch (PDOException $e) {
        $errmsg = $e->getMessage();
        if (strpos($errmsg, 'Duplicate') !== false) {
            $errmsg = "Det finns redan en registrerad kund med email '" . $_POST["email"] . "'.";
        }
        header("Location: index.php?err=other&errmsg=" . $errmsg);
    }
?>