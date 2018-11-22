<?php $root = $_SERVER['DOCUMENT_ROOT']; ?>
 <!DOCTYPE html>
<html>
<head>
  <title>Profile</title>
  <?php include("$root/modules/bootstrap_css.php") ?>
</head>
  <body>
    <?php include("$root/header.php") ?>
    <div class="container">
      <h1>Profile</h1>
      <img src="/images/profiles/default.png" alt="default">
      <?php 
     include("../../modules/mysql.php");

     $db = new MySQL();
     $sql = "SELECT id, firstname, lastname, gender, birth_date, email, phone_number, address FROM CUSTOMERS";// WHERE email LIKE '%$email%'";
     //$customer = $db->fetchAll($sql);
     // har behövs kod som gör plockar ut en användare som är inloggad av customerna.
     //foreach ($customers as $customer) {
     //  
     // }
      ?>

    </div>
    <?php include("$root/footer.php") ?>
    <?php include("$root/modules/bootstrap_js.php") ?>

    <!-- fix footer position -->
    <script src="/footer.js"></script>
  </body>
</html> 