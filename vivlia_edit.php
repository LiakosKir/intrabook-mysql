<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if (!empty($_POST['kwdikos']) && !empty($_POST['name']) && !empty($_POST['sygrafeas']) && !empty($_POST['katigoria']) && !empty($_POST['ekdoseis'])&& !empty($_POST['epipedo'])){
		mysqli_query($con,"SET NAMES utf8");
			$q="UPDATE vivlia
			SET vivlia_id='".$_POST['kwdikos']."',vivlia_name='".$_POST['name']."',vivlia_sygrafeas='".$_POST['sygrafeas']."',ekdoseis_id=".$_POST['ekdoseis'].",katigories_id=".$_POST['katigoria'].",epipeda_id=".$_POST['epipedo']."
			WHERE vivlia_id LIKE ".$_GET['id'];
			header('Location:provoli_vivlia.php?edit='.$_GET['id']);
	}
	echo head();
?>
<body>
	<?=load_viv_header()?>
	<?php
		mysqli_query($con,"SET NAMES utf8");
		$q1="SELECT * FROM vivlia
			INNER JOIN ekdoseis ON vivlia.ekdoseis_id=ekdoseis.ekdoseis_id
			INNER JOIN epipeda ON vivlia.epipeda_id=epipeda.epipeda_id
			INNER JOIN katigories ON vivlia.katigories_id=katigories.katigories_id
			WHERE vivlia_id LIKE '".$_GET['id']."'";
		$r1=mysqli_query($con,$q1);
		$d1=mysqli_fetch_assoc($r1);
	?>
	<div id="form_cont">
		<h1 class="headlines">Επεξεργασία Βιβλίου</h1>
		<form action="vivlia_edit.php?id=<?=$_GET['id']?>" method="post" id="apo_form">
			<table class="form1">
				<tr>
					<td>
						Κωδικός:
					</td>
					<td>
						<input type="text" name="kwdikos" id="kwdikos" value="<?=$d1['vivlia_id']?>" AUTOCOMPLETE="off" onfocus="this.blur()"/>
					 </td>
				</tr>
				<tr>
					<td>
						Τίτλος:
					</td>
					<td>
						<textarea name="name"><?=$d1['vivlia_name']?></textarea>
					 </td>
				</tr>
				<tr>
					<td>
						Συγραφέας:
					</td>
					<td>
						<input type="text" name="sygrafeas" id="sygrafeas" value="<?=$d1['vivlia_sygrafeas']?>" AUTOCOMPLETE="off"/>
					 </td>
				</tr>
				<tr>
					<td>
						Εκδόσεις:
					</td>
					<td>
						<select name="ekdoseis">
						   <option selected="selected" value="<?=$d1['ekdoseis_id']?>"><?=$d1['ekdoseis_name']?></option>
							<?php
								mysqli_query($con,"SET NAMES utf8");
								$q="SELECT * FROM ekdoseis WHERE ekdoseis_id <> ".$d1['ekdoseis_id'];
								$r=mysqli_query($con,$q);
								while($d=mysqli_fetch_assoc($r)){					
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
						   <option selected="selected" value="<?=$d1['epipeda_id']?>"><?=$d1['epipeda_name']?></option>
							<?php
								mysqli_query($con,"SET NAMES utf8");
								$q="SELECT * FROM epipeda WHERE epipeda_id <> ".$d1['epipeda_id'];
								$r=mysqli_query($con,$q);
								while($d=mysqli_fetch_assoc($r)){					
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
						   <option selected="selected" value="<?=$d1['katigories_id']?>"><?=$d1['katigories_name']?></option>
							<?php
								mysqli_query($con,"SET NAMES utf8");
								$q="SELECT * FROM katigories WHERE katigories_id <> ".$d1['katigories_id'];
								$r=mysqli_query($con,$q);
								while($d=mysqli_fetch_assoc($r)){				
									echo '<option value="'.$d['katigories_id'].'">'.$d['katigories_name'].'</option>';
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" value="ΟΚ" onClick="validation()"/>
					</td>
					<td>
						<input type="reset" value="Καθαρισμός"/>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<span class="" style="color:#ff0000;">* Όλα τα πεδία είναι υποχρεωτικά</span>
					</td>
					<td colspan="2">&nbsp;</td>
				</tr>
			</table>
		</form>
	</div>
	<?=load_footer()?>
</body>
</html>
