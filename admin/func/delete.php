<?php

if(isset($_SESSION['GuserID'])){
	$a=mysqli_real_escape_string($con,$_POST["a"]);
	$b=mysqli_real_escape_string($con,$_POST["b"]);
	mysqli_query($con,"DELETE FROM `$a` WHERE id='$b'");
	$lng=mysqli_query($con,"SELECT * FROM langs WHERE tableName='$a' AND tableId='$b' ");
	if(mysqli_num_rows($lng)>0)
	{
		mysqli_query($con,"DELETE FROM langs WHERE tableName='$a' AND tableId='$b' ");
	}
	echo 1;
}
?>