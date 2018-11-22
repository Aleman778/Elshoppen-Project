<?php 
    session_start();
    if (!(array_key_exists("customer_id", $_SESSION))) {
        header("Location: http://localhost/account/signin");
        exit;
    }
    include("../../modules/mysql.php");

    $id = $_SESSION["id"];

    $db = new MySQL();
    $sql = "SELECT product_id, quantity From CART WHERE customer_id LIKE $id";
    $antal =  $db->fetchAll($sql);
    $sql = "SELECT * From PRODUCTS WHERE id in $antal";
    $items =  $db->fetchAll($sql);
?>
<!DOCTYPE html>
<html>
<head>
<title>Kundvagn</title>
  <!-- Include basic libraries -->
  <?php include("modules/bootstrap_css.php"); ?>
</head>
<body>
  <?php include("header.php"); ?>

  <div id="main" class="container">
    <h1>Din Kundvagn</h1>
    <div class="row">
    <?php
        foreach ($items as $item) {
          include("modules/item_card.php");
        }
        var_dump($antal);
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
