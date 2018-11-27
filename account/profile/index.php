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
  $sql = "SELECT lastname, firstname, gender, 
          birth_date, email, phone_number, address From 
          CUSTOMERS WHERE customer_id LIKE $customer_id";
  //$cust =  $db->fetchAll($sql);

?>
<!DOCTYPE html>
<html>
<head>

<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<title>Profile</title>
<?php include("$root/modules/bootstrap_css.php") ?>
</head>
<body>
  <?php include("$root/header.php") ?>
  <div class="container">
    <h1>Profile</h1>

<br><br>
<div class="container-fluid well span6">
	<div class="row-fluid">
        <div class="span2" >
		    <img src="/images/profiles/default.png" class="img-circle">
        </div>
        
        <div class="span8">
            <h5>Firstname:</h5>
            <h5>Lastname:</h5>
            <br>
            <h5>Gender:</h5>            
            <h5>Birth date:</h5>
            <h5>Email:</h5>
            <br>
            <h5>Phone number:</h5>
            <h5>Address:</h5>
        </div>
        
        <div class="span2">
            <div class="btn-group">
                <a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
                    Settings 
                    <span class="icon-cog icon-white"></span><span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#"><span class="icon-wrench"></span> Modify information</a></li>
                    <li><a href="#"><span class="icon-wrench"></span> Change password</a></li>
                    <li><a href="#"><span class="icon-wrench"></span> Upload profile picture</a></li>
                    <li><a href="#"><span class="icon-trash"></span> Delete</a></li>
                </ul>
            </div>
        </div>
</div>
</div>
    
    <?php
    ?>

  </div>
  <?php include("$root/footer.php") ?>
  <?php include("$root/modules/bootstrap_js.php") ?>

  <!-- fix footer position -->
  <script src="/footer.js"></script>
</body>
</html> 