<?php
	if(isset($_GET['id'])){
		require_once('connection.php');
		$q="DELETE FROM eidikothtes WHERE eidikothtes_id LIKE '".$_GET['id']."'";	
		mysqli_query($con,$q) or die($mysql->error());
	}
	header('Location:eidikothtes.php');
?>