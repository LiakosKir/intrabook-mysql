<?php
	require_once("bibliopoleioCon.php");
	require_once("lib.php");
	mysqli_query($con,"SET NAMES utf8");
	$q="SELECT * FROM biblia WHERE biblia_name LIKE '%".$_GET['id']."%'";
	$r=mysqli_query($con,$q);
	$txt=array();
	while($d=mysqli_fetch_assoc($r)){
			$txt[]= $d['biblia_id'].",".$d['biblia_name'];							
	}
	echo implode("|",$txt);
?>