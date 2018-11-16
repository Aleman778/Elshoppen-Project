<!DOCTYPE html>
<html>
<head>
  <!-- Include bootstrap css -->
  <?php include("../../modules/bootstrap_css.php"); ?>
</head>
<body>

  <?php include("../../header.php") ?>

  <?php 
    include("../../modules/mysql.php");
    $id = $_GET["id"];

    $db = new MySQL();
    $details = $db->fetch("SELECT * FROM PRODUCTS WHERE id = $id");
  ?>

  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item"><a href="/category/<?php echo $details["category"] ?>"><?php echo $details["category"] ?></a></li>
      <li class="breadcrumb-item active"><?php echo $details["name"]; ?></li>
    </ol>

    <h2><?php echo $details["name"] ?></h2>
    <img src="<?php echo "../../images/items/" . $details["image_ref"] . "_card.jpg" ?>">
    <p><?php echo $details["description"] ?></p>
  </div>


  <?php include("../../footer.php") ?>

  <!--  Include bootstrap scripts -->
  <?php include("../../modules/bootstrap_js.php"); ?>

  <!-- fix footer position -->
  <script src="../../footer.js"></script>
</body>
</html>
