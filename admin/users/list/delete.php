<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/modules/mysql.php");
    include("$root/admin/access.php");
    $deleteAccess = checkAccess("/admin/products/list/delete.php");
    if (!$deleteAccess) {
        header("Location: http://localhost/admin/users/list/");
        exit;
    }

    $db = new MySQL();
    $db->query("START TRANSACTION");
    $sql = "UPDATE CUSTOMERS SET firstname = :fname, lastname = :lname, 
            birth_date = :bday, email = :email, password = :psw, removed = :rem, gender = :gen,
            phone_number = :mobile_number, address = :address where id = :id;";
    $pid = $_GET["id"];
    $p = $db->prepare($sql);
    $p->execute(array(  "fname" => "REMOVED",
                        "lname" => "REMOVED",
                        "bday" => "1000-01-01",
                        "email" => "REMOVED$pid@REMOVED",
                        "mobile_number" => NULL,
                        "address" => NULL,
                        "id" => $pid,
                        "psw"=> "REMOVED",
                        "rem" => "1",
                        "gen" => "r"));
    $db->query("COMMIT");
    header("Location: http://localhost/admin/users/list/");
?>