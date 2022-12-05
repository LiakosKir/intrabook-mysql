<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	echo head();
?>
<body>
	<?=load_general_header()?>
	<div style="margin:10px 0 0 20px;">
	<h1 class="headlines">Διαχείρηση Χρηστών</h1>
	<form style="margin-top:20px;" action="user_management.php" method="post">
		Αναζήτηση Χρήστη<input type="text" name="xristis"/><input type="submit" value="ΟΚ"/>
		<table class="tables">
			<tr>
				<th>
					Email
				</th>
				<th>
					Ονοματεπώνυμο
				</th>
				<th>
					Θέση
				</th>
				<th>
					Δικαιώματα
				</th>
				<th>
					Ημερομηνία Καταχώρησης
				</th>
				<th>
					Ενέργειες
				</th>
			</tr>
		<?php
		mysqli_query($con,"SET NAMES utf8");
		if (!empty($_POST)){
			$q="SELECT *
				FROM user
				WHERE user_email LIKE '%".$_POST['xristis']."%'";
		}
		else
			$q="SELECT *
				FROM user
				ORDER BY user_hmer_kataxwrisis DESC";
			$r=mysqli_query($con,$q);
			while($d=mysqli_fetch_assoc($r)){
			echo '
				<tr>
					<td>'.$d['user_email'].'</td>
					<td>'.$d['user_epwnymo'].'&nbsp;'.$d['user_onoma'].'</td>
					<td>'.$d['user_thesi'].'</td>
					<td>'.$d['db_user'].'</td>
					<td>'.date('d/m/Y',$d['user_hmer_kataxwrisis']).'</td>
					<td>
						<a href="user_edit.php?id='.$d['user_id'].'"><img src="images/edit_foto.png"/></a>
						<a href="user_del.php?id='.$d['user_id'].'"><img src="images/deleteButton.png"/></a>
					</td>
				</tr>';
			}
		?>
		</table>
	</form>
	</div>
	<?=load_footer()?>
</body>