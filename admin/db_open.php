<?php
  $host='localhost';
  $name='admin_programa';
  $pass='#Programa#123';
  $db="admin_hgn";
  
 $con= mysqli_connect($host,$name,$pass,$db);
 // var_dump($con);
mysqli_set_charset($con,"utf8");

?>