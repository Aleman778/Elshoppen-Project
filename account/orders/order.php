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
  $sql = "SELECT C.product_id , C.quantity, 
          P.id, P.price, 
          FROM CART C
          INNER JOIN PRODUCTS P ON C.product_id = P.id
          WHERE C.customer_id LIKE $customer_id";
  $items =  $db->fetchAll($sql);

  //insert into database

  header("Location: /account/orders/orderd.php");
?>