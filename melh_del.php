<?php
	if(isset($_GET['id'])){
		require_once('connection.php');
		mysqli_query($con,"SET NAMES utf8");
		$q="SELECT * FROM daneismos
		WHERE (melh_id LIKE '".$_GET['id']."') AND (daneismos_hmer_epistrofis is NULL)";
		$r=mysqli_query($con,$q);
		$d=mysqli_fetch_assoc($r);
		if (mysqli_num_rows($r)>0)
			header('Location:provoli_melh.php?xreos='.$_GET['id']);
		else{
			$q1="DELETE FROM melh where melh_id LIKE '".$_GET['id']."'";
			$r1=mysqli_query($con,$q1);
			header('Location:provoli_melh.php?del='.$_GET['id']);
		}
	}
?>