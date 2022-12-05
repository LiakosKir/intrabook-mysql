<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if (!empty($_POST['kwdikos']) && !empty($_POST['name']) && !empty($_POST['epwnymo']) && !empty($_POST['tmhma']) && !empty($_POST['thlefwno'])&& !empty($_POST['email'])&& !empty($_POST['tomeas'])&& !empty($_POST['eidikothta'])&& !empty($_POST['etos'])){
		mysqli_query($con,"SET NAMES utf8");
			$q="INSERT INTO melh (melh_id,melh_onoma,melh_epwnymo,melh_tmhma,melh_thlefwno,melh_email,tomeis_id,eidikothtes_id,eth_id,melh_hmer_kataxwrisis)
			VALUES ('".$_POST['kwdikos']."','".$_POST['name']."','".$_POST['epwnymo']."','".$_POST['tmhma']."','".$_POST['thlefwno']."','".$_POST['email']."',".$_POST['tomeas'].",".$_POST['eidikothta'].",".$_POST['etos'].",'".time()."')";
		if(mysqli_num_rows(mysqli_query($con,"SELECT melh_id from melh WHERE melh_id LIKE '".$_POST['kwdikos']."'"))<1){
				mysqli_query($con,$q);
			echo 'Η καταχώρηση ολοκληρώθηκε!!!';
			unset ($_POST);
		}
		else
			echo 'Ο κωδικός υπάρχει!!<br/>';
	}
	echo head();
?>
<script language="javascript">
	<!--
	function ajax_call(tomeas){
		var xmlhttp;
		if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
			{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		var tmp="";
		xmlhttp.open("GET","ajax.php?id="+tomeas,true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				eidikotites_options=document.getElementById("eidikothtaID");
				str=xmlhttp.responseText;
				vals=str.split("|");
				//καθαρισμός του select
				for(i=eidikotites_options.length;i>0;i--)
					eidikotites_options.options[i] = null;
				//γέμισμα του select
				for(i=0;vals.length;i++){
					tmp=vals[i];
					values=tmp.split(",");
					eidikotites_options.options[eidikotites_options.length] = new Option(values[1],values[0]);				
				}
				
			}
		}
	}
	-->
</script>
<body>
	<?=load_viv_header()?>
	<div id="form_cont">
		<h1 class="headlines">Καταχώρηση Μέλους</h1>
		<form action="melh.php" method="post" id="apo_form">
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
						Όνομα:
					</td>
					<td>
						<input type="text" name="name" id="name" value="<?php if(!empty($_POST)) echo $_POST['name']; ?>" AUTOCOMPLETE="off"/>
					 </td>
				</tr>
				<tr>
					<td>
						Επώνυμο:
					</td>
					<td>
						<input type="text" name="epwnymo" id="epwnymo" value="<?php if(!empty($_POST)) echo $_POST['epwnymo']; ?>" AUTOCOMPLETE="off"/>
					 </td>
				</tr>
				<tr>
					<td>
						Τμήμα:
					</td>
					<td>
						<input type="text" name="tmhma" id="tmhma" value="<?php if(!empty($_POST)) echo $_POST['tmhma']; ?>" AUTOCOMPLETE="off" />
					 </td>
				</tr>
				<tr>
					<td>
						Αρ. Τηλεφώνου:
					</td>
					<td>
						<input type="text" name="thlefwno" id="thlefwno" value="<?php if(!empty($_POST)) echo $_POST['thlefwno']; ?>" AUTOCOMPLETE="off"/>
					 </td>
				</tr>
				<tr>
					<td>
						e-mail:
					</td>
					<td>
						<input type="text" name="email" id="email" value="<?php if(!empty($_POST)) echo $_POST['email']; ?>" AUTOCOMPLETE="off"/>
					 </td>
				</tr>
				<tr>
					<td>
						Τομέας:
					</td>
					<td>
						<select id="tomeasID" name="tomeas" onChange="ajax_call(this.value)">
						   <option value="">Επιλέξτε</option>
							<?php
								mysqli_query($con,"SET NAMES utf8");
								$q="SELECT * FROM tomeis";
								$r=mysqli_query($con,$q);
								while($d=mysqli_fetch_assoc($r)){
									if(!empty($_POST) && $_POST['tomeas']==$d['tomeis_id'])
										echo '<option selected="selected" value="'.$d['tomeis_id'].'">'.$d['tomeis_name'].'</option>';							
									else						
										echo '<option value="'.$d['tomeis_id'].'">'.$d['tomeis_name'].'</option>';
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Ειδικότητα:
					</td>
					<td>
						<select id="eidikothtaID" name="eidikothta">
						   <option value="">Επιλέξτε</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Έτος Κατάρτησης:
					</td>
					<td>
						<select name="etos">
						   <option value="">Επιλέξτε</option>
							<?php
								mysqli_query($con,"SET NAMES utf8");
								$q="SELECT * FROM eth";
								$r=mysqli_query($con,$q);
								while($d=mysqli_fetch_assoc($r)){
									if(!empty($_POST) && $_POST['etos']==$d['eth_id'])
										echo '<option selected="selected" value="'.$d['eth_id'].'">'.$d['eth_name'].'</option>';							
									else						
										echo '<option value="'.$d['eth_id'].'">'.$d['eth_name'].'</option>';
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
	<div style="margin:0 0 0 20px;">
		<h1 class="headlines">Λίστα Μελών</h1>
		<table class="tables">
			<tr>
				<th>Κωδικός</th>
				<th>Όνομα</th>
				<th>Επώνυμο</th>
				<th>Τμήμα</th>
				<th>Τηλέφωνο</th>
				<th>e-mail</th>
				<th>Τομέας</th>
				<th>Ειδικότητα</th>
				<th>Έτος Κατάρτησης</th>
                <th>Ημερομηνία Καταχώρησης</th>
			</tr>
			<?php
				mysqli_query($con,"SET NAMES utf8");
					$q="SELECT * FROM melh
					INNER JOIN tomeis ON melh.tomeis_id=tomeis.tomeis_id
					INNER JOIN eidikothtes ON melh.eidikothtes_id=eidikothtes.eidikothtes_id
					INNER JOIN eth ON melh.eth_id=eth.eth_id
					order by melh_hmer_kataxwrisis DESC limit 0,100";
				$r=mysqli_query($con,$q);
				while($d=mysqli_fetch_assoc($r)){
					echo '
						<tr>
							<td>'.$d['melh_id'].'</td>
							<td>'.$d['melh_onoma'].'</td>
							<td>'.$d['melh_epwnymo'].'</td>
							<td>'.$d['melh_tmhma'].'</td>
							<td>'.$d['melh_thlefwno'].'</td>
							<td>'.$d['melh_email'].'</td>
							<td>'.$d['tomeis_name'].'</td>
							<td>'.$d['eidikothtes_name'].'</td>
							<td>'.$d['eth_name'].'</td>
							<td>'.date("d/m/Y",$d['melh_hmer_kataxwrisis']).'</td>
						</tr>
					';
				}
			?>
		</table>
	</div>
	<?=load_footer()?>
</body>
</html>
