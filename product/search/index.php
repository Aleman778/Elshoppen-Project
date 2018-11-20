<?php
  include("../../modules/mysql.php");
  
  $searchterm = htmlspecialchars($_REQUEST['searchterm']);

  $sql = "SELECT * From PRODUCTS WHERE name LIKE '%".$searchterm."%'";
  $db = new MySQL();
  $r_query =  $db->fetchAll($sql);
  var_dump($r_query);
?>