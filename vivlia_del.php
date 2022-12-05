<?php
	if(isset($_GET['id'])){
		require_once('connection.php');
		$q="DELETE FROM vivlia WHERE vivlia_id LIKE '".$_GET['id']."'";	
		mysqli_query($con,$q) or die(mysqli_error($con));
	}
	header('Location:provoli_vivlia.php?del='.$_GET['id']);
?>