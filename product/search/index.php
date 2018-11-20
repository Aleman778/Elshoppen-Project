<?php
  $searchterm = mysql_real_escape_string($_REQUEST['searchterm']);

  $sql = "SELECT * From PRODUCTS WHERE name LIKE '%".$searchterm."%'";
  $r_query = mysql_query($sql);
  var_dump($r_query);
?>