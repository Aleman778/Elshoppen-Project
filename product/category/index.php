<?php
	session_start();
  include("../../modules/mysql.php");
  
  
  $category = htmlspecialchars($_REQUEST['name']);
  $db = new MySQL();
  $sql = "SELECT id, name, price, image_ref From PRODUCTS WHERE category LIKE :cat AND removed='0';";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("cat" => "$category"));
  $items = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
<title> Sökresultat för <?php echo $category; ?>  Elshoppen</title>
  <!-- Include basic libraries -->
  <?php include("../../modules/bootstrap_css.php"); ?>
  <link rel = "stylesheet" href = "/modules/categories.css" >
</head>
<body>
  <?php include("../../header.php"); ?>
  

<div id="wrapper" class="row">
        <div id = "categories" class = "col-sm" style = "max-width: 250px;">
          <?php include("../../modules/categories.php"); ?>
        </div>

  <div id="main" class="container">
  
    <h1><?php echo $category; ?></h1>
    <div class="row">
      <?php
        foreach ($items as $item) {
          include("../../modules/item_card.php");
        }
      ?>
    </div>
  </div>
</div>
  <?php include("../../footer.php"); ?>

  <!-- Include jQuery, popper and bootstrap  -->
  <?php include("../../modules/bootstrap_js.php"); ?>

  <!-- fix footer position -->
  <script src="../../footer.js"></script>

</body>
</html>
