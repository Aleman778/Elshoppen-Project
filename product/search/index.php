<?php

// Fixa så det inte kan bli sql injektion

  include("../../modules/mysql.php");
  
  $searchterm = htmlspecialchars($_REQUEST['searchterm']);

  $sql = "SELECT id, name, price, image_ref From PRODUCTS WHERE name LIKE '%".$searchterm."%'";
  $db = new MySQL();
  $items =  $db->fetchAll($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <!-- Include basic libraries -->
  <?php include("../../modules/bootstrap_css.php"); ?>
</head>
<body>
  <?php include("../../header.php"); ?>

  <div id="main" class="container">
  
    <h1>Din sökning "<?php echo $searchterm; ?>" gav "<?php echo count($items); ?>" träff<?php if(count($items) != 1) echo "ar"; ?>.</h1>
    <div class="row">
      <?php
        foreach ($items as $item) {
          include("../../modules/item_card.php");
        }
      ?>
    </div>
  </div>

  <?php include("../../footer.php"); ?>

  <!-- Include jQuery, popper and bootstrap  -->
  <?php include("../../modules/bootstrap_js.php"); ?>

  <!-- fix footer position -->
  <script src="../../footer.js"></script>

</body>
</html>
