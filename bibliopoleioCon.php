<?php
	$host="localhost";
	$login="admin";
	$pass="123";
	$con=mysqli_connect($host,$login,$pass) or die($mysql->error());
	mysqli_select_db($con,"bibliopoleio");
?>