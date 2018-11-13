<?php

$conn = new PDO("mysql:host=utbweb.its.ltu.se;dbname=db940224", 940224, 940224);


$sql = "CREATE TABLE Myflends (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
reg_date TIMESTAMP
)";

$conn->exec($sql);
?>