<?php
	$host="localhost";
	$login="admin";
	$pass="123";
	$con=mysqli_connect($host,$login,$pass) or die(mysqli_error($con));
	mysqli_select_db($con,"eksoplismos");
?>