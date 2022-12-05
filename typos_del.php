<?php
	if(isset($_GET['id'])){
		require_once('connection.php');
		$q="DELETE FROM typos WHERE typos_id LIKE '".$_GET['id']."'";	
		mysqli_query($con,$q) or die(mysqli_error($con));
	}
	header('Location:typos.php');
?>