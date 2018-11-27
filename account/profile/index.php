<?php 
  $root = $_SERVER['DOCUMENT_ROOT'];

  session_start();
  if (!(array_key_exists("customer_id", $_SESSION))) {
      header("Location: /");
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
<title>Profil</title>
<?php include("$root/modules/bootstrap_css.php") ?>
</head>
<body>
    <?php include("$root/header.php") ?>
    <div class="container">
    <h1>Profil</h1>

<br><br>
<div class="container-fluid well span6">
	<div class="row-fluid">
        <div class="span2" >
		    <img src="/images/profiles/default.png" class="img-circle">
        </div>
        
        <div class="span8">
            <h5>Förnamn:</h5>
            <h5>Efternamn:</h5>
            <br>
            <h5>Kön:</h5>            
            <h5>Födelsedatum:</h5>
            <h5>Epost:</h5>
            <br>
            <h5>Mobilnummer:</h5>
            <h5>Adress:</h5>
        </div>
        
        <div class="span2">
            <div class="btn-group">
                <a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
                    Inställningar 
                    <span class="icon-cog icon-white"></span><span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#"><span class="icon-wrench"></span> Ändra information</a></li>
                    <li><a href="#"><span class="icon-wrench"></span> Ändra lösenord</a></li>
                    <li><a href="#"><span class="icon-wrench"></span> Lägg upp profilbild</a></li>
                    <li><a href="#"><span class="icon-trash"></span> Ta bort användaren</a></li>
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