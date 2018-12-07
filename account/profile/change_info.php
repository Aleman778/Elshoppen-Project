<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];

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
        <?php 
            if (array_key_exists("err", $_GET)) {
                $err_msg = "";
                if ($_GET["err"] == "fname_length")
                    $err_msg = "Förnamnet får maximalt vara 40 bokstäver långt.";
                else if ($_GET["err"] == "fname_empty")
                    $err_msg = "Förnamnet får inte vara tomt.";
                else if ($_GET["err"] == "lname_length")
                    $err_msg = "Efternamnet får maximalt vara 40 bokstäver långt.";
                else if ($_GET["err"] == "lname_empty")
                    $err_msg = "Efternamnet får inte vara tomt.";
                else if (array_key_exists("errmsg", $_GET))
                    $err_msg = $_GET["errmsg"];

                if ($err_msg != "") {
                    echo "<div class=\"alert alert-danger\" role=\"alert\">$err_msg</div>";
                    }
                }
        ?>
        <form action="new_info.php" method="post">
            <h1>Ändra information</h1>
            <p>Ändra den information som inte stämmer, klicka sedan spara.</p>
            <hr>
            <div class="row mb-2">
                <div class="col-md-2">
                    <label for="first-name"><b>Förnamn</b></label>
                </div>
                <div class="col-md-5">
                    <input class="form-control" type="text" value="<?php echo $customer["firstname"]; ?>" placeholder="Fyll i förnamn" name="first-name" maxlength="40" required>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-2">
                    <label for="last-name"><b>Efternamn</b></label>
                </div>
                <div class="col-md-5">
                    <input class="form-control" type="text" value="<?php echo $customer["lastname"]; ?>" placeholder="Fyll i efternamn" name="last-name" maxlength="40" required>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-2">
                    <label for="date-of-birth"><b>Födelsedatum</b></label>
                </div>
                <div class="col-md-5">
                    <input class="form-control" type="date" value="<?php echo $customer["birth_date"]; ?>" placeholder="Fyll i födelsedatum" name="bday" required>
                </div>
            </div>
            <!-- change gender off -->
            <!-- <div class="row mb-2">
                <div class="col-md-2">
                    <label for="gender"><b>Kön</b></label>
                </div>
                <div class="col-md-5">
                    <?php
                        if($customer["gender"] == "m"){ ?>
                            <input type="radio" name="gender" value="male"checked> Man
                            <input type="radio" name="gender" value="female"> Kvinna
                        <?php
                        } else {
                            ?>
                            <input type="radio" name="gender" value="male"> Man
                            <input type="radio" name="gender" value="female"checked> Kvinna
                        <?php
                        }

                    ?>
                </div>
            </div> -->
            <div class="row mb-2">
                <div class="col-md-2">
                    <label for="email"><b>Epost</b></label>
                </div>
                <div class="col-md-5">
                    <input class="form-control" type="email" value="<?php echo $customer["email"]; ?>" placeholder="Fyll i epost" name="email" required>
                </div>
            </div>
            <br>
                
            <div class="row mb-2">
                <div class="col-md-2">
                    <label for="mobile-number"><b>Mobilnummer</b></label>
                </div>
                <div class="col-md-5">
                    <input class="form-control" type="text" value="<?php echo $customer["phone_number"]; ?>" placeholder="Fyll i mobilnummer" maxlength="10" name="mobile-number">
                </div>
            </div>
                
            <div class="row">
                <div class="col-md-2">
                    <label for="address"><b>Adress</b></label>
                </div>
                <div class="col-md-5">
                    <input class="form-control" type="text" value="<?php echo $customer["address"]; ?>" placeholder="Fyll i adress" name="address" required>
                </div>
            </div>
                
            <div class="clearfix mt-4">
                <button type="submit" class="btn btn-primary">Spara</button>
                <a href="/account/profile" class="btn btn-secondary">Avbryt</a>
                <hr>
            </div>
        </form>
    </div>
    <?php include("$root/footer.php") ?>
    <?php include("$root/modules/bootstrap_js.php") ?>

  <!-- fix footer position -->
  <script src="/footer.js"></script>
</body>
</html> 