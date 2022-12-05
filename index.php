<?php
	require_once("connection2.php");
	require_once("lib.php");
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
	echo head();
?>
	<body>
		<div id="index_container">
			<div id="form_container">
				<?php
					if (!empty($_SESSION['wrong'])){
					echo $_SESSION['wrong'];
					}
				?>
				<!--<img src="images/delta_logo.png" width="100"/>-->
				<form class="login_form" action="index.php" method="post">
					<span class="login_head">Είσοδος Χρήστη</span>
					<ul class="index_text">
						<li>Email</li>
						<li>Κωδικός</li>
					</ul>
					<ul class="index_input">
						<li><input type="text" name="username" AUTOCOMPLETE="off"/></li>
						<li><input type="password" name="password"/></li>
						<li><input type="submit" value="Είσοδος"/></li>
					</ul>
				</form>
				<form id="aitisiForm" class="login_form1" action="index.php" method="post">
					<span class="login_head">Αίτηση Εγγραφής</span>
					<ul class="index_text">
						<li>Email</li>
						<li>Κωδικός</li>
						<li>Επιβεβαίωση</li>
						<li>Επώνυμο</li>
						<li>Όνομα</li>
						<li>Θέση</li>
					</ul>
					<ul class="index_input">
						<li><input type="text" name="reg_user" AUTOCOMPLETE="off"/></li>
						<li><input type="password" name="reg_pass"/></li>
						<li><input type="password" name="reg_conf_pass"/></li>
						<li><input type="text" name="reg_epwnymo" AUTOCOMPLETE="off"/></li>
						<li><input type="text" name="reg_name" AUTOCOMPLETE="off"/></li>					
						<li><input type="text" name="reg_thesi" AUTOCOMPLETE="off"/></li>
						<li><input type="submit" value="ΟΚ"/></li>
					</ul>
				</form>
				<span id="aitisiBtn" class="aitisiBtn">Αίτηση Εγγραφής</span>
				<span id="aitisiHide" style="display:none;" class="aitisiBtn">Απόκρυψη Εγγραφής</span>
		   </div>
		</div>
		<script>
			$(document).ready(function(){
				$('#aitisiBtn').click(function(){
					$('#form_container').animate({top:'10%'},"slow");
					$("#aitisiForm").slideDown("slow");
					$('#aitisiHide').css('display','block');
					$('#aitisiBtn').css('display','none');
				});
				$('#aitisiHide').click(function(){
					$('#form_container').animate({top:'20%'},"slow");
					$("#aitisiForm").slideUp("slow");
					$('#aitisiHide').css('display','none');
					$('#aitisiBtn').css('display','block');
				});
			});	
		</script>
    </body>
</html>