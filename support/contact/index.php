<?php $root = $_SERVER['DOCUMENT_ROOT']; ?>
<!DOCTYPE html>
<html>
<head>
<title>Kontakta oss - Elshoppen</title>
  <!-- Include basic libraries -->
  <?php include("$root/modules/bootstrap_css.php"); ?>
  <?php include("$root/header.php"); ?>
</head>


<body>

    <div id="main" class="container">

        <h1>Kontakta oss</h1>
        <div id="row" class="container">
            <p> Om du har några problem eller frågor kan du kontakta oss på denna Email: <b>Elshoppen@mail.com</b>. Vi kommer svarar inom en till tre dagar.</p>
        </div>
    </div>

    <?php include("$root/footer.php"); ?>

    <!-- Include jQuery, popper and bootstrap  -->
    <?php include("$root/modules/bootstrap_js.php"); ?>

    <!-- fix footer position -->
    <script src="/footer.js"></script>

    </body>
</html>