<?php $root = $_SERVER['DOCUMENT_ROOT']; 

    if (!(array_key_exists("txtFName", $_POST))) {
        header("Location: /");
        exit;
    }

?>
<!DOCTYPE html>
<html>
<head>
<title>Skickat - Elshoppen</title>
  <!-- Include basic libraries -->
  <?php include("$root/modules/bootstrap_css.php"); ?>
  <?php include("$root/header.php"); ?>
</head>


<body>

    <div id="main" class="container">
        <h1>Tack <?php echo $_POST["txtFName"] ?>! Du kommer få ett email med info om din order.</h1>
    </div>

    <?php include("$root/footer.php"); ?>

    <!-- Include jQuery, popper and bootstrap  -->
    <?php include("$root/modules/bootstrap_js.php"); ?>

    <!-- fix footer position -->
    <script src="/footer.js"></script>

    </body>
</html>