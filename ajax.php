<?php
require_once("connection.php");
	require_once("lib.php");
	mysqli_query($con,"SET NAMES utf8");
	$q="SELECT * FROM eidikothtes WHERE tomeis_id LIKE '".$_GET['id']."'";
	$r=mysqli_query($con,$q);
	$txt=array();
	while($d=mysqli_fetch_assoc($r)){
			$txt[]= $d['eidikothtes_id'].",".$d['eidikothtes_name'];							
	}
	echo implode("|",$txt);
?>