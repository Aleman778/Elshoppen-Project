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
  $sql = "SELECT * From ORDERS WHERE customer_id LIKE $customer_id";
  $orders =  $db->fetchAll($sql);
  //$sql = "SELECT * From ORDERS_PRODUCTS WHERE order_id in (SELECT id FROM ORDERS WHERE customer_id LIKE $customer_id)";
  //$items =  $db->fetchAll($sql);
?>
<!DOCTYPE html>
<html>
<head>
<title>Startsida</title>
  <!-- Include basic libraries -->
  <?php include("$root/modules/bootstrap_css.php"); ?>
</head>
<body>
  <?php include("$root/header.php"); ?>

  <div id="main" class="container">
    <h1>Mina beställningar</h1>
    <div class="row">
      <?php var_dump($orders); ?>
    </div>
  </div>

  <?php include("$root/footer.php"); ?>

  <!-- Include jQuery, popper and bootstrap  -->
  <?php include("$root/modules/bootstrap_js.php"); ?>

  <!-- fix footer position -->
  <script src="/footer.js"></script>

</body>
</html>
