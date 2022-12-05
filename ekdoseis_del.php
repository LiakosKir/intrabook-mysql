<?php
	if(isset($_GET['id'])){
		require_once('connection.php');
		$q="DELETE FROM ekdoseis WHERE ekdoseis_id LIKE '".$_GET['id']."'";	
		mysqli_query($con,$q) or die($mysql->error());
	}
	header('Location:ekdoseis.php');
?>