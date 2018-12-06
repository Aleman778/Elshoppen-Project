<?php 
  $root = $_SERVER['DOCUMENT_ROOT'];

  session_start();
  if (!(array_key_exists("customer_id", $_SESSION))) {
      header("Location: /account/signin");
      exit;
  }
  include("$root/modules/mysql.php");

  $customer_id = $_SESSION["customer_id"];

  $db = new MySQL();
  $sql = "SELECT * From ORDERS WHERE customer_id LIKE $customer_id";
  $orders =  $db->fetchAll($sql);
?>
<!DOCTYPE html>
<html>
<head>
<title>Mina beställningar - Elshoppen</title>
  <!-- Include basic libraries -->
  <?php include("$root/modules/bootstrap_css.php"); ?>
</head>
<body>
  <?php include("$root/header.php"); ?>

  <div id="main" class="container">
    <h1>Mina beställningar</h1>
    <div class="row">
      
      <?php foreach ($orders as $order) { 
        $id = $order["id"];
        $items =  $db->fetchAll("SELECT product_id, quantity FROM ORDERS_PRODUCTS WHERE order_id = $id");
      ?>

        <div class="card card-item m-2" style="width: 64rem;">
            <div class="card-body">
                <h5 class="card-title" style="max-height: 48px; overflow: hidden;">
                    <b>Order nummer: </b> <?php echo $id ?>
                </h5>
                  <p><b>Datum av beställning: </b> <?php echo $order[4] ?> </p>
                  <p><b>Address: </b> <?php echo $order[2] ?> </p>
                  <p><b>E-mail: </b> <?php echo $order[3] ?> </p>
                <p class="card-subtitle pb-2"><b>Din Beställning:</b></p>
                  <?php foreach ($items as $item) { ?>
                    <li>
                      <?php 
                        $prod =  $db->fetch("SELECT name FROM PRODUCTS WHERE id = $item[0]");
                        echo (string) $prod[0];
                      ?>
                      <p> 
                      <b>Antal: </b><?php  echo (string) $item[1] ?></p> 
                    </li>
                  <?php } ?>
            </div>
        </div>
      <?php } ?>

    </div>
  </div>

  <?php include("$root/footer.php"); ?>

  <!-- Include jQuery, popper and bootstrap  -->
  <?php include("$root/modules/bootstrap_js.php"); ?>

  <!-- fix footer position -->
  <script src="/footer.js"></script>

</body>
</html>
