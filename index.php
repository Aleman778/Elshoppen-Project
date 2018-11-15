<!DOCTYPE html>
<html>
<head>
  <!-- Include basic libraries -->
  <?php include("modules/bootstrap_css.php"); ?>
</head>
<body>
  <?php include "header.php" ?>

  <div id="main" class="container">
    <h1>Välkommen till ELSHOPPEN</h1>
    <div class="row">
      <?php
        $servername = "https://utbweb.its.ltu.se";
        $dbname = "db971229";
        $username = "971229";
        $password = "971220";

        try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          echo "Connected successfully";
        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }


        #//Hardcoded product information, this should be fetched from a database later on.
        #$item["name"] = "Nintendo Switch konsol med två Joy-Cons (grå)";
        #$item["price"] = "3379.00";
        #$item["image_ref"] = "nintendo_switch_gray";
        #$item["id"] = 1;

        //The include statement copies code from the php file specified below and pastes it onto here
        #include("modules/item_card.php");

        //Use loops to create multiple item cards
        #$item["name"] = "Nintendo Switch konsol med två Joy-Cons (neon blå/ röd)";
        #$item["image_ref"] = "nintendo_switch_neon_blue_red";
        #$item["id"] = 2;
        #include("modules/item_card.php");
      ?>
    </div>
  </div>

  <?php include("footer.php"); ?>

  <!-- Include jQuery, popper and bootstrap  -->
  <?php include("modules/bootstrap_js.php"); ?>

  <!-- fix footer position -->
  <script src="../../footer.js"></script>

</body>
</html>
