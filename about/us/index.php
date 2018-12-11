<?php $root = $_SERVER['DOCUMENT_ROOT']; ?>
<!DOCTYPE html>
<html>
<head>
<title>Om oss - Elshoppen</title>
  <!-- Include basic libraries -->
  <?php include("$root/modules/bootstrap_css.php"); ?>
  <?php include("$root/header.php"); ?>
</head>


<body>

    <div id="main" class="container">

        <h1>Om oss</h1>
        <div id="row" class="container">
            <p>
                Vi är ett team av datateknik studenter ifrån Luleås tekniska universitet som går kursen Databasteknik och i den kursen så ska vi göra en webbshopp.
                Webbshoppen vi gjort heter Elshoppen och den säljer diverse elekronik prylar.
                Men denna webbshopp är inte riktig, så ingen av produkter på shoppen går att köpa.
            </p>
        </div>
    </div>

    <?php include("$root/footer.php"); ?>

    <!-- Include jQuery, popper and bootstrap  -->
    <?php include("$root/modules/bootstrap_js.php"); ?>

    <!-- fix footer position -->
    <script src="/footer.js"></script>

    </body>
</html>