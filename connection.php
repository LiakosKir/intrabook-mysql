<?php
	session_start();
	$host="localhost";
	$login=$_SESSION['user_data']['db_user'];
	$pass=$_SESSION['user_data']['db_pass'];
	//$login= 'root';
	//$pass= '';
	$con=mysqli_connect($host,$login,$pass) or die(mysqli_error($con));
	mysqli_select_db($con,"eksoplismos");
?>