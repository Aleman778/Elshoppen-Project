<?php
  $root = $_SERVER['DOCUMENT_ROOT'];

  session_start();
  if (array_key_exists("customer_id", $_SESSION))
    header("Location: /");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Logga in</title>
  <?php include("$root/modules/bootstrap_css.php") ?>
</head>
  <body>
    <?php include("$root/header.php") ?>

    <div class="container">
      <?php if (array_key_exists("err", $_GET)) { ?>
        <?php if ($_GET["err"] == "pass") { ?>
          <div class="alert alert-danger" role="alert">
            Fel lösenord försök igen.
          </div>
        <?php } ?>
        <?php if ($_GET["err"] == "email") { ?>
          <div class="alert alert-danger" role="alert">
            Det finns inget konto med den angivna email addressen.
          </div>
        <?php } ?>
      <?php } ?>
      <form action="signin.php" method="post">
          <h1>Logga in</h1>
          <p>Fyll i rutorna nedan för att logga in.</p>
          <hr>
          <div class="row mb-2">
            <div class="col-md-2">
              <label for="uname"><b>Epost</b></label>
            </div>
            <div class="col-md-4">
              <input class="form-control" type="text" placeholder="Fyll i email" id="email" name="email" required>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-2">
              <label for="psw"><b>Lösenord</b></label>
            </div>
            <div class="col-md-4">
              <input class="form-control" type="password" placeholder="Fyll i Lösenord" name="psw" required>
            </div>
          </div>
            <button type="submit" class="btn btn-primary">Logga in</button>
            <a href="/" class="btn btn-secondary">Avbryt</a>
            <div class="col-md-2">
              <p>Har du inget konto? <a href="/account/signup">Skapa ett konto.</a></p>
              <br>
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