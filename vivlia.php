<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if (!empty($_POST['kwdikos']) && !empty($_POST['name']) && !empty($_POST['sygrafeas']) && !empty($_POST['katigoria']) && !empty($_POST['ekdoseis'])&& !empty($_POST['epipedo'])){
		mysqli_query($con,"SET NAMES utf8");
		$fixApos;
		if (strpos($_POST['name'],"'")){
			$fixApos= str_replace("'","\'",$_POST['name']);
		}
		$q="INSERT INTO vivlia (vivlia_id,vivlia_name,vivlia_sygrafeas,ekdoseis_id,katigories_id,epipeda_id,vivlia_hmer_kataxwrisis)
			VALUES ('".$_POST['kwdikos']."','".$fixApos."','".$_POST['sygrafeas']."',".$_POST['ekdoseis'].",".$_POST['katigoria'].",".$_POST['epipedo'].",'".time()."')";
		if(mysqli_num_rows(mysqli_query($con,"SELECT vivlia_id from vivlia WHERE vivlia_id LIKE '".$_POST['kwdikos']."'"))<1){
				mysqli_query($con,$q);
			echo 'Η καταχώρηση ολοκληρώθηκε!!!'.$q;
			unset ($_POST);
		}
		else
			echo 'Ο κωδικός υπάρχει!!';
	}
	echo head();
?>
<body>
	<?=load_viv_header()?>
	<div id="form_cont">
		<h1 class="headlines">Καταχώρηση Βιβλίου</h1>
		<form action="vivlia.php" method="post" id="apo_form">
			<table class="form1">
				<tr>
					<td>
						Κωδικός:
					</td>
					<td>
						<input type="text" name="kwdikos" id="kwdikos" value="<?php if(!empty($_POST)) echo $_POST['kwdikos']; ?>" AUTOCOMPLETE="off"/>
					 </td>
				</tr>
				<tr>
					<td>
						Τίτλος:
					</td>
					<td>
						<textarea name="name"><?php if(!empty($_POST)) echo $_POST['name']; ?></textarea>
					 </td>
				</tr>
				<tr>
					<td>
						Συγραφέας:
					</td>
					<td>
						<input type="text" name="sygrafeas" id="sygrafeas" value="<?php if(!empty($_POST)) echo $_POST['sygrafeas']; ?>" AUTOCOMPLETE="off"/>
					 </td>
				</tr>
				<tr>
					<td>
						Εκδόσεις:
					</td>
					<td>
						<select name="ekdoseis">
						   <option value="">Επιλέξτε</option>
							<?php
								mysqli_query($con,"SET NAMES utf8");
								$q="SELECT * FROM ekdoseis";
								$r=mysqli_query($con,$q);
								while($d=mysqli_fetch_assoc($r)){
									if(!empty($_POST) && $_POST['ekdoseis']==$d['ekdoseis_id'])
										echo '<option selected="selected" value="'.$d['ekdoseis_id'].'">'.$d['ekdoseis_name'].'</option>';							
									else						
										echo '<option value="'.$d['ekdoseis_id'].'">'.$d['ekdoseis_name'].'</option>';
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Επίπεδο:
					</td>
					<td>
						<select name="epipedo">
						   <option value="">Επιλέξτε</option>
							<?php
								mysqli_query($con,"SET NAMES utf8");
								$q="SELECT * FROM epipeda";
								$r=mysqli_query($con,$q);
								while($d=mysqli_fetch_assoc($r)){
									if(!empty($_POST) && $_POST['epipedo']==$d['epipeda_id'])
										echo '<option selected="selected" value="'.$d['epipeda_id'].'">'.$d['epipeda_name'].'</option>';							
									else						
										echo '<option value="'.$d['epipeda_id'].'">'.$d['epipeda_name'].'</option>';
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Κατηγορία:
					</td>
					<td>
						<select name="katigoria">
						   <option value="">Επιλέξτε</option>
							<?php
								mysqli_query($con,"SET NAMES utf8");
								$q="SELECT * FROM katigories";
								$r=mysqli_query($con,$q);
								while($d=mysqli_fetch_assoc($r)){
									if(!empty($_POST) && $_POST['katigoria']==$d['katigories_id'])
										echo '<option selected="selected" value="'.$d['katigories_id'].'">'.$d['katigories_name'].'</option>';							
									else						
										echo '<option value="'.$d['katigories_id'].'">'.$d['katigories_name'].'</option>';
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" value="Εισαγωγή" onClick="validation()"/>
					</td>
					<td>
						<input type="reset" value="Καθαρισμός"/>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<span style="color:#ff0000;">* Όλα τα πεδία είναι υποχρεωτικά</span>
					</td>
				</tr>
			</table>
		</form>		
	</div>
	<div style="margin:10px 0 0 20px;">
		<h1 class="headlines">Λίστα Βιβλίων</h1>
		<table class="tables">
			<tr>
				<th>Κωδικός</th>
				<th>Τίτλος</th>
				<th>Συγραφέας</th>
				<th>Εκδόσεις</th>
				<th>Επίπεδο</th>
				<th>Κατηγορία</th>
                <th>Ημερομηνία Καταχώρησης</th>
			</tr>
			<?php
				mysqli_query($con,"SET NAMES utf8");
					$q="SELECT * FROM vivlia
					INNER JOIN ekdoseis ON vivlia.ekdoseis_id=ekdoseis.ekdoseis_id
					INNER JOIN epipeda ON vivlia.epipeda_id=epipeda.epipeda_id
					INNER JOIN katigories ON vivlia.katigories_id=katigories.katigories_id
					order by vivlia_hmer_kataxwrisis DESC limit 0,100";
				$r=mysqli_query($con,$q);
				while($d=mysqli_fetch_assoc($r)){
					echo '
						<tr>
							<td>'.$d['vivlia_id'].'</td>
							<td>'.$d['vivlia_name'].'</td>
							<td>'.$d['vivlia_sygrafeas'].'</td>
							<td>'.$d['ekdoseis_name'].'</td>
							<td>'.$d['epipeda_name'].'</td>
							<td>'.$d['katigories_name'].'</td>
							<td>'.date("d/m/Y",$d['vivlia_hmer_kataxwrisis']).'</td>
						</tr>
					';
				}
			?>
		</table>
	</div>
	<?=load_footer()?>
</body>
</html>
