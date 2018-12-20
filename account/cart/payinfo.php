<?php $root = $_SERVER['DOCUMENT_ROOT']; 

    session_start();
    if ((!array_key_exists("customer_id", $_SESSION))) {
        header("Location: /account/signin/");
        exit;
    }

    include("$root/modules/mysql.php");

    $customer_id = $_SESSION["customer_id"];

    $pid = "f";
    if (array_key_exists("item", $_GET)){
        $pid = $_GET["item"];
    }

    $db = new MySQL();
    $sql = "SELECT address FROM CUSTOMERS WHERE id = $customer_id";
    $address = $db->fetch($sql);
    $address = $address["address"];
?>
<!DOCTYPE html>
<html>
<head>
<title>Skriv in din betalinformation - Elshoppen</title>
  <!-- Include basic libraries -->
  <?php include("$root/modules/bootstrap_css.php"); ?>
</head>
<body>
  <?php include("$root/header.php"); ?>

  <div id="main" class="container">
    <form action="../orders/order.php?pid=<?php echo $pid;?>" method="post">
        <h1>Skriv in din betalinformation</h1>
            <div class="row">
                <div class="col-md-2">
                    <label for="address"><b>Adress</b></label>
                </div>
                <div class="col-md">
                    <input class="form-control" type="text" placeholder="Fyll i adress" <?php if ($address != "") {?> value = <?php echo $address; }?> name="address" required>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-2">
                    <label for="email"><b>Epost</b></label>
                </div>
                <div class="col-md">
                    <input class="form-control" type="email" placeholder="Fyll i epost" value = <?php echo $_SESSION["email"] ?> name="email" required>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Beställ</button>
        </div>
    </form> 
  </div>

  <?php include("$root/footer.php"); ?>

  <!-- Include jQuery, popper and bootstrap  -->
  <?php include("$root/modules/bootstrap_js.php"); ?>

  <!-- fix footer position -->
  <script src="/footer.js"></script>

</body>
</html>
