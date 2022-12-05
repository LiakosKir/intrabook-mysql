<?php
	require_once("connection.php");
	require_once("lib.php");
	mysqli_query($con,"SET NAMES utf8");
	$q="SELECT * FROM melh WHERE melh_onoma LIKE '%".$_GET['id']."%' LIMIT 0,10";	
	$r=mysqli_query($con,$q);
	$txt=array();
	while($d=mysqli_fetch_assoc($r)){
	$txt[]= $d['melh_id'].",".$d['melh_epwnymo']."&nbsp;".$d['melh_onoma'];
	}
	echo implode("|",$txt);
?>