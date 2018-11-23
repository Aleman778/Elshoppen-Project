<?php $root = $_SERVER['DOCUMENT_ROOT']; ?>
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
    <h1>Skriv in din betalinformation</h1>

        <div class="row">
            <div class="col-md-2">
                <label for="address"><b>Adress</b></label>
            </div>
            <div class="col-md">
                <input class="form-control" type="text" placeholder="Fyll i adress" name="address" required>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-2">
                <label for="email"><b>Epost</b></label>
            </div>
            <div class="col-md">
                <input class="form-control" type="email" placeholder="Fyll i epost" name="email" required>
            </div>
        </div>
        <br>
        
        <a href="/account/orders/order.php" class="btn btn-primary">Betala</a>

    </div>
  </div>

  <?php include("$root/footer.php"); ?>

  <!-- Include jQuery, popper and bootstrap  -->
  <?php include("$root/modules/bootstrap_js.php"); ?>

  <!-- fix footer position -->
  <script src="/footer.js"></script>

</body>
</html>
