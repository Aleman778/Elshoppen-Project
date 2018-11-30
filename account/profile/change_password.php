<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];

    //checks if customer is logged in
    session_start();
    if (!(array_key_exists("customer_id", $_SESSION))) {
        header("Location: /");
        exit;
    }
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
            if ($_GET["err"] == "pass_length")
                $err_msg = "Lösenord måste vara 4 till 20 bokstäver långt.";
            else if ($_GET["err"] == "pass_mismatch")
                $err_msg = "Det upprepande lösenordet matchar inte.";
            if ($err_msg != "") {
                echo "<div class=\"alert alert-danger\" role=\"alert\">$err_msg</div>";
            }
        }
                        ?>
        <h1>Ändra lösenord</h1>
        <p>Fyll i rutorna nedan för att ändra lösenord.</p>
        <hr>
        <form action="password.php" method="post">
            <div class="row mb-2">
                <div class="col-md-2">
                    <label for="psw"><b>Nytt lösenord</b></label>
                </div>
                <div class="col-md-4">
                    <input class="form-control" type="password" placeholder="Fyll i nytt lösenord" maxlength="20" name="psw" required>
                </div>
            </div>
                
            <div class="row mb-2">
                <div class="col-md-2">
                    <label for="psw-repeat"><b>Repetera lösenord</b></label>
                </div>
                <div class="col-md-4">
                    <input class="form-control" type="password" placeholder="Repetera nytt lösenord" maxlength="20" name="psw-repeat" required>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Spara</button>
            <a href="/account/profile" class="btn btn-secondary">Avbryt</a>
            <div class="col-md-2">
            </div>
            </div>
        </form>
    </div>
    <?php include("$root/footer.php") ?>
    <?php include("$root/modules/bootstrap_js.php") ?>

  <!-- fix footer position -->
  <script src="/footer.js"></script>
</body>
</html> 