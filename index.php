<!DOCTYPE html>
<html>
<head>
  <!-- Include basic libraries -->
  <?php include("modules/bootstrap_css.php"); ?>
</head>
<body>
  <?php include("header.php"); ?>

  <div id="main" class="container">
    <h1>Välkommen till ELSHOPPEN</h1>
    <div class="row">
      <?php
        include("modules/mysql.php");

        $db = new MySQL();
        $sql = "SELECT id, name, price, image_ref FROM PRODUCTS";
        $items = $db->fetchAll($sql);
        foreach ($items as $item) {
          include("modules/item_card.php");
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
