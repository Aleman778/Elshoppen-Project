<!DOCTYPE html>
<html>
<head>
<title>Startsida</title>
  <!-- Include basic libraries -->
  <?php include("modules/bootstrap_css.php"); ?>
</head>
<body>
  <?php include("header.php"); ?>
  <?php include("modules/categories.php"); ?>
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
