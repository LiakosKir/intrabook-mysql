<?php
	require_once("connection2.php");
	session_start();
	if (!empty($_POST['username']) && !empty($_POST['password'])){
		$q="SELECT *
			FROM user
			WHERE user_email LIKE '".addslashes($_POST['username'])."' AND user_pass LIKE '".addslashes(md5($_POST['password']))."'";
		$r=mysqli_query($con,$q) or die($mysql->error());
		if (mysqli_num_rows($r)>0){
			$d=mysqli_fetch_assoc($r);
			$_SESSION['user_data']['user_id']=$d['user_id'];
			$_SESSION['user_data']['db_user']=$d['db_user'];
			$_SESSION['user_data']['db_pass']=$d['db_pass'];
			if (isset($_SESSION['wrong']))
				unset ($_SESSION['wrong']);
			header('Location:arxiki.php');
		}
		else{
			$_SESSION['wrong']="Λάθος Username ή Password!";
		}
	}
	if (!empty($_POST['reg_user']) && !empty($_POST['reg_pass']) && !empty($_POST['reg_conf_pass']) && !empty($_POST['reg_epwnymo']) && !empty($_POST['reg_name']) && !empty($_POST['reg_thesi'])){
		if ($_POST['reg_pass']==$_POST['reg_conf_pass']){
			mysqli_query($con,"SET NAMES utf8");
			$q="INSERT INTO user (user_id,user_email,user_pass,user_epwnymo,user_onoma,user_thesi,user_hmer_kataxwrisis)VALUES ('".md5(session_id().time())."','".$_POST['reg_user']."','".md5($_POST['reg_pass'])."','".$_POST['reg_epwnymo']."','".$_POST['reg_name']."','".$_POST['reg_thesi']."',".time().")";
			mysqli_query($con,$q);
			echo '
			<script language="javascript">
			<!--
			alert("Η αίτηση στάλθηκε. Η ενεργοποίηση του λογαριασμού θα γίνει εντός λιγών ωρών.");	
			//-->
			</script>';
		}
		else
			echo 'Ασυμμφωνία Κωδικών';
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<meta http-equiv="X-UA-Compatible" content="IE=100" >
		<meta http-equiv="X-UA-Compatible" content="IE=9" >
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		 <script src="http://code.jquery.com/jquery-latest.js"></script>