<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	GLOBAL $note;
	if (!empty($_POST['type']) && !empty($_POST['kwdikos']) && !empty($_POST['tomeas']) && !empty($_POST['xaraktiristika']) && !empty($_POST['thesi_xristis'])&& !empty($_POST['ktirio']) && !empty($_POST['xwros'])){
		mysqli_query($con,"SET NAMES utf8");
			$q="INSERT INTO eidos (eidos_id,typos_id,eidos_xaraktiristika,eidos_thesi_xristis,ktirio_id,xwros_id,tomeas_id,eidos_posotita,promitheutis_id,eidos_aksia_agoras,eidos_hmer_agoras,hmer_kataxwrisis)VALUES ('".$_POST['kwdikos']."','".$_POST['type']."','".$_POST['xaraktiristika']."','".$_POST['thesi_xristis']."','".$_POST['ktirio']."','".$_POST['xwros']."','".$_POST['tomeas']."',".$_POST['posotita'].",'".$_POST['promitheutis']."','".$_POST['kostos']."','".$_POST['hmer_agoras']."','".time()."')";
		if(mysqli_num_rows(mysqli_query($con,"SELECT eidos_id from eidos WHERE eidos_id LIKE '".$_POST['kwdikos']."'"))<1){
				mysqli_query($con,$q);
			$note= 'Η Εγγραφή ολοκληρώθηκε!!!';
			
			if (!empty($_FILES['eikona'])){
			mkdir("images/".$_POST['kwdikos'], 0700);
		
			if (!empty($_FILES['eikona'])){
				if ($_FILES["eikona"]["error"] > 0)
				{
					$tmp_error="Παρουσιάστηκε πρόβλημα κατά το ανέβασμα του αρχείου.";
					$tmp_error.="Κωδικός σφάλματος: " . $_FILES["eikona"]["error"];
				}
				else{
					move_uploaded_file($_FILES["eikona"]["tmp_name"],"images/".$_POST['kwdikos']."/".$_FILES["eikona"]["name"]);
				}
			}
		}
			unset ($_POST);
		}
		else
			$note= 'Το barcode υπάρχει!!';
		
	}
	echo head();
?>
<body>
	<?=load_header()?>
	<div style="margin:0 0 0 20px;">
		<span style="color:#ff0000;"><?=$note?></span>
		<form enctype="multipart/form-data" action="apografi.php" method="post" id="apo_form">
			<h1 class="headlines">Καταχώρηση Είδους</h1>
			<table id="apografi">
				<tr>
					<td class="td_text">
						Κωδικός είδους
					</td>
					<td class="td_form">
						<input type="text" maxlength="13" name="kwdikos" id="kwdikos" value="<?php if(!empty($_POST)) echo $_POST['kwdikos']; ?>"/>
					 </td>
				
					<td class="td_text">
						Τύπος εξοπλισμού
					</td>
					<td class="td_form">
						<select name="type">
							<option value="">Επιλέξτε</option>
							<?php
								mysqli_query($con,"SET NAMES utf8");
								$q="SELECT * FROM typos";
								$r=mysqli_query($con,$q);
								while($d=mysqli_fetch_assoc($r)){
									if(!empty($_POST) && $_POST['type']==$d['typos_id'])
										echo '<option selected="selected" value="'.$d['typos_id'].'">'.$d['typos_name'].'</option>';							
									else						
										echo '<option value="'.$d['typos_id'].'">'.$d['typos_name'].'</option>';
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="td_text">
						Χαρακτηριστικά
					</td>
					<td class="td_form">
						<textarea name="xaraktiristika"><?php if(!empty($_POST)) echo $_POST['xaraktiristika']; ?></textarea>
					 </td>
				
					<td class="td_text">
						Θέση/Χρήστης
					</td>
					<td class="td_form">
						<textarea name="thesi_xristis"><?php if(!empty($_POST)) echo $_POST['thesi_xristis']; ?></textarea>
					 </td>
				</tr>
				<tr>
					<td class="td_text">
						Κτίριο
					</td>
					<td class="td_form">
						<select name="ktirio">
						   <option value="">Επιλέξτε</option>
							<?php
								mysqli_query($con,"SET NAMES utf8");
								$q="SELECT * FROM ktirio";
								$r=mysqli_query($con,$q);
								while($d=mysqli_fetch_assoc($r)){
									if(!empty($_POST) && $_POST['ktirio']==$d['ktirio_id'])
										echo '<option selected="selected" value="'.$d['ktirio_id'].'">'.$d['ktirio_name'].'</option>';							
									else						
										echo '<option value="'.$d['ktirio_id'].'">'.$d['ktirio_name'].'</option>';
								}
							?>
						</select>
					</td>
					<td class="td_text">
						Ποσότητα
					</td>
					<td class="td_form">
						<input type="text" name="posotita" value="<?php if(!empty($_POST)) echo $_POST['posotita']; else echo '1'; ?>"/>
					 </td>
				</tr>
				<tr>
					<td class="td_text">
						Χώρος
					</td>
					<td class="td_form">
						<select name="xwros">
							<option value="">Επιλέξτε</option>
							<?php
								mysqli_query($con,"SET NAMES utf8");
								$q="SELECT * FROM xwros";
								$r=mysqli_query($con,$q);
								while($d=mysqli_fetch_assoc($r)){
									if(!empty($_POST) && $_POST['xwros']==$d['xwros_id'])
										echo '<option selected="selected" value="'.$d['xwros_id'].'">'.$d['xwros_name'].'</option>';							
									else						
										echo '<option value="'.$d['xwros_id'].'">'.$d['xwros_name'].'</option>';
								}
							?>
						</select>
					</td>
				
					<td class="td_text">
						Τομέας
					</td>
					<td class="td_form">
						<select name="tomeas">
							<option value="">Επιλέξτε</option>
							<?php
								mysqli_query($con,"SET NAMES utf8");
								$q="SELECT * FROM tomeas";
								$r=mysqli_query($con,$q);
								while($d=mysqli_fetch_assoc($r)){
									if(!empty($_POST) && $_POST['tomeas']==$d['tomeas_id'])
										echo '<option selected="selected" value="'.$d['tomeas_id'].'">'.$d['tomeas_name'].'</option>';							
									else						
										echo '<option value="'.$d['tomeas_id'].'">'.$d['tomeas_name'].'</option>';
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="td_text">
						Αξία Αγοράς
					</td>
					<td class="td_form">
						<input style="float:left;width:80px;" type="text" name="kostos" value="<?php if(!empty($_POST)) echo $_POST['kostos']; ?>"/>
						<span style="font-size:23px;float:left;">&euro;</span>
					 </td>
				
					<td class="td_text">
						Προμηθευτής
					</td>
					<td class="td_form">
						<select name="promitheutis">
							<option value="">Επιλέξτε</option>
							<?php
								mysqli_query($con,"SET NAMES utf8");
								$q="SELECT * FROM promitheutis";
								$r=mysqli_query($con,$q);
								while($d=mysqli_fetch_assoc($r)){
									if(!empty($_POST) && $_POST['promitheutis']==$d['promitheutis_id'])
										echo '<option selected="selected" value="'.$d['promitheutis_id'].'">'.$d['promitheutis_name'].'</option>';							
									else						
										echo '<option value="'.$d['promitheutis_id'].'">'.$d['promitheutis_name'].'</option>';
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="td_text">
						Ημερομηνία Αγοράς
					</td>
					<td class="td_form">
						<input type="text" name="hmer_agoras" value="<?php if(!empty($_POST)) echo $_POST['hmer_agoras']; ?>"/>
					 </td>
					<td class="td_text">
						Εισαγωγή Εικόνας
					</td>
					<td class="td_form">
						<input type="file" name="eikona"/>
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<input type="submit" value="Εισαγωγή" onClick="validation()"/>
					
						<input type="reset" value="Καθαρισμός"/>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<span style="color:#ff0000;">* Όλα τα πεδία είναι υποχρεωτικά</span>
					</td>
					<td colspan="2">&nbsp;</td>
				</tr>
			</table>
		</form>
	</div>
	<div id="eidos_view">
		<h1 class="headlines">Λίστα Τελευταίων Καταχωρήσεων</h1>
		<table class="tables">
			<tr>
				<th>Κωδικός Είδους</th>
				<th>Τύπος Εξοπλισμού</th>
				<th>Χαρακτηριστικά</th>
				<th>Θέση/Χρήστης</th>
				<th>Κτίριο</th>
				<th>Ποσότητα</th>
				<th>Χώρος</th>
				<th>Τομέας</th>
                <th>Ημερομηνία Καταχώρησης</th>
			</tr>
			<?php
				mysqli_query($con,"SET NAMES utf8");
					$q="SELECT * FROM eidos 
					INNER JOIN typos ON eidos.typos_id=typos.typos_id
					INNER JOIN ktirio ON eidos.ktirio_id=ktirio.ktirio_id
					INNER JOIN xwros ON eidos.xwros_id=xwros.xwros_id
					INNER JOIN tomeas ON eidos.tomeas_id=tomeas.tomeas_id order by hmer_kataxwrisis DESC limit 0,10";
				$r=mysqli_query($con,$q);
				while($d=mysqli_fetch_assoc($r)){
					echo '
						<tr>
							<td>'.$d['eidos_id'].'</td>
							<td>'.$d['typos_name'].'</td>
							<td>'.$d['eidos_xaraktiristika'].'</td>
							<td>'.$d['eidos_thesi_xristis'].'</td>
							<td>'.$d['ktirio_name'].'</td>
							<td>'.$d['eidos_posotita'].'</td>
							<td>'.$d['xwros_name'].'</td>
							<td>'.$d['tomeas_name'].'</td>
							<td>'.date("d/m/Y",$d['hmer_kataxwrisis']).'</td>
						</tr>
					';
				}
			?>
		</table>
	</div>
	<?=load_footer()?>
</body>
</html>
