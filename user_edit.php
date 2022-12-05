<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if ((!empty($_POST['email'])) && (!empty($_POST['epwnymo'])) && (!empty($_POST['onoma'])) && (!empty($_POST['thesi']))){
		mysqli_query($con,"SET NAMES utf8");
		$quer="SELECT User
				FROM mysql.user
				WHERE User LIKE '".$_POST['dikaiwmata']."'";
		$res=mysqli_query($con,$quer);
		$d6=mysqli_fetch_assoc($res);
		$query="UPDATE user
				SET user_email='".$_POST['email']."',user_epwnymo='".$_POST['epwnymo']."',user_onoma='".$_POST['onoma']."',user_thesi='".$_POST['thesi']."',db_user='".$d6['User']."'
				WHERE user_id LIKE '".$_GET['id']."'";
				$r5=mysqli_query($con,$query);
	}
	echo head();
?>
<body>
	<?=load_general_header()?>
	<?php
		mysqli_query($con,"SET NAMES utf8");
		$q='SELECT *
			FROM user
			WHERE user_id LIKE "'.$_GET['id'].'"';
		$r=mysqli_query($con,$q);
		$d=mysqli_fetch_assoc($r);
	?>
	<div style="width:700px !important;" id='metakinisi_container'>
		<h1 align="center" class="headlines">Επεξεργασία Χρήστη</h1>
	
	<div id='metakinisi_right'>
		<form action="user_edit.php?id=<?=$_GET['id']?>" method="post">
		<table id='kinisi_form'>
			<tr>
				<th colspan='2'>Επεξεργασία</th>
			</tr>
			<tr>
				<td>Email</td>
				<td>
					<input type='text' name='email' AUTOCOMPLETE='off' value="<?=$d['user_email']?>"/>
				</td>
			</tr>
			<tr>
				<td>
					Επώνυμο
				</td>
				<td>
					<input type='text' name='epwnymo' AUTOCOMPLETE='off' value="<?=$d['user_epwnymo']?>"/>
				</td>
			</tr>
			<tr>
				<td>
					Όνομα
				</td>
				<td>
					<input type='text' name='onoma' AUTOCOMPLETE='off' value="<?=$d['user_onoma']?>"/>
				</td>
			</tr>
			<tr>
				<td>
					Θέση
				</td>
				<td>
					<input type='text' name='thesi' AUTOCOMPLETE='off' value="<?=$d['user_thesi']?>"/>
				</td>
			</tr>
			<tr>
				<td>Δικαιώματα</td>
				<td>
					<select name='dikaiwmata' style="width:155px;">
						<?php
							if ($d['db_user']!=null)
								echo'
								<option selected=\'selected\' value="'.$d['db_user'].'">'.$d['db_user'].'</option>';
							else
								echo '
								<option selected=\'selected\' value="">Επιλέξτε</option>';
							mysqli_query($con,"SET NAMES utf8");
							$q2="SELECT * 
								FROM mysql.user
								WHERE (User <> '".$d['db_user']."')";
								//WHERE (Password <> null) AND (User <> '".$d['db_user']."')";
							$r2=mysqli_query($con,$q2);
							while($d2=mysqli_fetch_assoc($r2)){
								echo'<option value="'.$d2['User'].'">'.$d2['User'].'</option>';
							}
							?>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2"><input type='submit' value='Αλλαγή'/></td>
			</tr>
		</table>
		</form>
	</div>
	</div>
	<?=load_footer()?>
</body>