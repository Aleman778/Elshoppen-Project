<?php $root = $_SERVER['DOCUMENT_ROOT']; ?>
<!DOCTYPE html>
<html>
<head>
<title>Spåra din leverans - Elshoppen</title>
  <!-- Include basic libraries -->
  <?php include("$root/modules/bootstrap_css.php"); ?>
  <?php include("$root/header.php"); ?>
</head>


<body>

    <div id="main" class="container">

        <h1>Spåra din leverans</h1>
        <div id="row" class="container">
            <p>För att spåra ditt packet så måste du skicka ett email till <b>Elshoppen@mail.com</b>, 
            där order id, förnamn, efternam och födelsedatum ska stå med. Efter du gjort det kommer status uppdateringar av packetet skickas till din email.</p>
        </div>
    </div>

    <?php include("$root/footer.php"); ?>

    <!-- Include jQuery, popper and bootstrap  -->
    <?php include("$root/modules/bootstrap_js.php"); ?>

    <!-- fix footer position -->
    <script src="/footer.js"></script>

    </body>
</html>