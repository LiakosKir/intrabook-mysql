<?php
	require_once("connection.php");
	require_once("lib.php");
	mysqli_query($con,"SET NAMES utf8");

	$fixApos;
	if (strpos($_GET['id'],"'")){
		$fixApos= str_replace("'","\'",$_GET['id']);
	}
	else $fixApos=$_GET['id'];
	
	$q="SELECT * FROM vivlia WHERE vivlia_name LIKE '%".$fixApos."%' LIMIT 0,10";	
	$r=mysqli_query($con,$q);
	$txt=array();
	while($d=mysqli_fetch_assoc($r)){

		$fixApos2;
		if (strpos($d['vivlia_name'],"'")){
			$fixApos2= str_replace("'","\'",$d['vivlia_name']);
		}
		else $fixApos2=$d['vivlia_name'];

	$txt[]= $d['vivlia_id'].",".$fixApos2;
	}
	echo implode("|",$txt);
?>