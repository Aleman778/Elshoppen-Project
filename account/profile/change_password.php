<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];

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
        <h1>Ändra lösenord</h1>
        <form action="signin.php" method="post">
            <div class="row mb-2">
                <div class="col-md-2">
                    <label for="psw"><b>Nytt lösenord</b></label>
                </div>
                <div class="col-md-5">
                    <input class="form-control" type="password" placeholder="Fyll i nytt lösenord" maxlength="20" name="psw" required>
                </div>
            </div>
                
            <div class="row mb-2">
                <div class="col-md-2">
                    <label for="psw-repeat"><b>Repetera nytt lösenord</b></label>
                </div>
                <div class="col-md-5">
                    <input class="form-control" type="password" placeholder="Repetera nytt lösenord" maxlength="20" name="psw-repeat" required>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Spara</button>
            <a href="/" class="btn btn-secondary">Avbryt</a>
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