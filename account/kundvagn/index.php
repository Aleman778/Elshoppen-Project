<?php 
  $root = $_SERVER['DOCUMENT_ROOT'];

  session_start();
  if (!(array_key_exists("customer_id", $_SESSION))) {
      header("Location: http://localhost/account/signin");
      exit;
  }
  include("$root/modules/mysql.php");

  $customer_id = $_SESSION["customer_id"];

  $db = new MySQL();
  $sql = "SELECT product_id, quantity From CART WHERE customer_id LIKE $customer_id";
  $antal =  $db->fetchAll($sql);
  $sql = "SELECT * From PRODUCTS WHERE id in (SELECT product_id FROM CART WHERE customer_id LIKE $customer_id)";
  $items =  $db->fetchAll($sql);
?>
<!DOCTYPE html>
<html>
<head>
<title>Kundvagn</title>
  <!-- Include basic libraries -->
  <?php include("$root/modules/bootstrap_css.php"); ?>
</head>
<body>
  <?php include("$root/header.php"); ?>

  <div id="main" class="container">
    <h1>Din Kundvagn</h1>
    <div class="row">
    <?php
        foreach ($items as $item) {
          include("$root/modules/item_card.php");
        }
        var_dump($antal);
      ?>
    </div>
  </div>

  <?php include("$root/footer.php"); ?>

  <!-- Include jQuery, popper and bootstrap  -->
  <?php include("$root/modules/bootstrap_js.php"); ?>

  <!-- fix footer position -->
  <script src="/footer.js"></script>

</body>
</html>
