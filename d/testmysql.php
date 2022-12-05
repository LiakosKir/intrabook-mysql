<?php 
$link = mysqli_connect('hostname','dbuser','dbpassword'); 
if (!$link) { 
	die('Could not connect to MySQL: ' . $mysql->error()); 
} 
echo 'Connection OK'; mysqli_close($link); 
?> 