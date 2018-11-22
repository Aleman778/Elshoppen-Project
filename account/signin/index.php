<?php $root = $_SERVER['DOCUMENT_ROOT']; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Logga in</title>
  <?php include("$root/modules/bootstrap_css.php") ?>
</head>
  <body>
    <?php include("$root/header.php") ?>

    <div class="container">
      <form action="action_page.php">
          <h1>Logga in</h1>
          <p>Fyll i rutorna nedan för att logga in.</p>
          <hr>
          <div class="row">
            <div class="col-md-2">
              <label for="uname"><b>Användarnamn</b></label>
            </div>
            <div class="col-md-2">
              <input class="form-control" type="text" placeholder="Fyll i Användarnamn" name="uname" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <label for="psw"><b>Lösenord</b></label>
            </div>
            <div class="col-md-2">
              <input class="form-control" type="password" placeholder="Fyll i Lösenord" name="psw" required>
            </div>
          </div>
            <button type="submit" class="btn btn-primary">Logga in</button>
            <a href="/" class="btn btn-secondary">Avbryt</a>
            <div class="col-md-2">
              <p>Har du inget konto? <a href="/signup">Skapa ett konto.</a></p>
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