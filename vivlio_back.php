<?php
	if(isset($_GET['id'])){
		require_once('connection.php');
		$q="UPDATE daneismos
			SET daneismos_hmer_epistrofis=".time()."
			WHERE daneismos_id LIKE '".$_GET['id']."'";	
		mysqli_query($con,$q) or die(mysqli_error($con));
	}
	header('Location:vivlia_epist.php');
?>