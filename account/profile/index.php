<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];

    //checks if customer is logged in
    session_start();
    if (!(array_key_exists("customer_id", $_SESSION))) {
        header("Location: /");
        exit;
    }
    include("$root/modules/mysql.php");

    $customer_id = $_SESSION["customer_id"];

    $db = new MySQL();
    $sql = "SELECT firstname, lastname , gender, 
            birth_date, email, phone_number, address 
            From CUSTOMERS WHERE id = $customer_id";
    $customer =  $db->fetch($sql);
    
?>
<!DOCTYPE html>
<html>
<head>
<title>Profil</title>
<?php include("$root/modules/bootstrap_css.php") ?>
</head>
<body>
    <?php include("$root/header.php") ?>
    <div class="container">
        <h1>Profil</h1>
        <div class="row">
            <div class="col-md-3">
                <!--hard coded profile picture-->
                <img src="/images/profiles/default.png" class="img-circle">
            </div>

            <div class="col-md-2">
                <ul class="list-group">
                    <li class="list-group-item">Förnamn:</li>
                    <li class="list-group-item">Efternamn:</li>
                    <li class="list-group-item">Kön:</li>
                    <li class="list-group-item">Födelsedatum:</li>
                    <li class="list-group-item">Epost:</li>
                    <li class="list-group-item">Mobilnummer:</li>
                    <li class="list-group-item">Adress:</li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="list-group">
                    <li class="list-group-item">
                        <?php echo $customer["firstname"] ?></li>
                    <li class="list-group-item">
                        <?php echo $customer["lastname"] ?>
                    </li>
                    <li class="list-group-item">
                        <?php if ($customer["gender"] == "m" ) {
                            echo "Man";
                        } else {
                            echo "Kvinna";
                        } ?>
                    </li>
                    <li class="list-group-item">
                        <?php echo $customer["birth_date"] ?>
                    </li>
                    <li class="list-group-item">
                        <?php echo $customer["email"] ?>
                    </li>
                    <li class="list-group-item">
                        <?php echo $customer["phone_number"] ?>
                    </li>
                    <li class="list-group-item">
                        <?php echo $customer["address"] ?>
                    </li>
                </ul>
            </div>

            <div class="col-md-2">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Inställningar
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="./change_info.php"> Ändra information</a>
                        <a class="dropdown-item" href="./change_password.php"> Ändra lösenord</a>
                        <a class="dropdown-item" href="#">Lägg upp profilbild</a>
                    <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Ta bort användaren</a>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <?php include("$root/footer.php") ?>
    <?php include("$root/modules/bootstrap_js.php") ?>

    <!-- fix footer position -->
    <script src="/footer.js"></script>
</body>
</html> 