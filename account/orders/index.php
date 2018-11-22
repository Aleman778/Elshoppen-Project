<?php 
    session_start();
    $id = $_SESSION["id"];
    if ($id == NULL) {
        header("Location: http://localhost/account/signin");
        exit;
    }
?>
<?php $root = $_SERVER['DOCUMENT_ROOT']; ?>
<!DOCTYPE html>
<html>
<head>
<title>Startsida</title>
  <!-- Include basic libraries -->
  <?php include("$root/modules/bootstrap_css.php"); ?>
</head>
<body>
  <?php include("$root/header.php"); ?>

  <div id="main" class="container">
    <h1>Mina beställningar</h1>
    <div class="row">
      Data om order!
    </div>
  </div>

  <?php include("$root/footer.php"); ?>

  <!-- Include jQuery, popper and bootstrap  -->
  <?php include("$root/modules/bootstrap_js.php"); ?>

  <!-- fix footer position -->
  <script src="/footer.js"></script>

</body>
</html>
