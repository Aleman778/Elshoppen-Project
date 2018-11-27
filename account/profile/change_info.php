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
        <h1>Profil</h1>


    </div>
    <?php include("$root/footer.php") ?>
    <?php include("$root/modules/bootstrap_js.php") ?>

  <!-- fix footer position -->
  <script src="/footer.js"></script>
</body>
</html> 