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

  //insert into database

  header("Location: /account/orders/orderd.php");
?>