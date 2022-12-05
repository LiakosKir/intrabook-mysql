<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if (!empty($_POST['kwdikos']) && !empty($_POST['name']) && !empty($_POST['epwnymo']) && !empty($_POST['tmhma']) && !empty($_POST['thlefwno'])&& !empty($_POST['email'])&& !empty($_POST['tomeas'])&& !empty($_POST['eidikothta'])&& !empty($_POST['etos'])){
		mysqli_query($con,"SET NAMES utf8");
			$q="UPDATE melh
			SET melh_id='".$_POST['kwdikos']."', melh_onoma='".$_POST['name']."',melh_epwnymo='".$_POST['epwnymo']."',melh_tmhma='".$_POST['tmhma']."',melh_thlefwno='".$_POST['thlefwno']."',melh_email='".$_POST['email']."',tomeis_id=".$_POST['tomeas'].",eidikothtes_id=".$_POST['eidikothta'].",eth_id=".$_POST['etos']."
			WHERE melh_id LIKE '".$_GET['id']."'";
				mysqli_query($con,$q);
			header('Location:provoli_melh.php?edit='.$_GET['id']);
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
	<?php
		mysqli_query($con,"SET NAMES utf8");
		$q1="SELECT * FROM melh
			INNER JOIN tomeis ON melh.tomeis_id=tomeis.tomeis_id
			INNER JOIN eidikothtes ON melh.eidikothtes_id=eidikothtes.eidikothtes_id
			INNER JOIN eth ON melh.eth_id=eth.eth_id
			WHERE melh_id LIKE '".$_GET['id']."'";
		$r1=mysqli_query($con,$q1);
		$d1=mysqli_fetch_assoc($r1)
	?>
	<div id="form_cont">
		<h1 class="headlines">Επεξεργασία Μέλους</h1>
		<form action="melh_edit.php?id=<?=$_GET['id']?>" method="post" id="apo_form">
			<table class="form1">
				<tr>
					<td>
						Κωδικός:
					</td>
					<td>
						<input type="text" name="kwdikos" id="kwdikos" value="<?=$d1['melh_id']?>" AUTOCOMPLETE="off" onfocus="this.blur()"/>
					 </td>
				</tr>
				<tr>
					<td>
						Όνομα:
					</td>
					<td>
						<input type="text" name="name" id="name" value="<?=$d1['melh_onoma']?>" AUTOCOMPLETE="off"/>
					 </td>
				</tr>
				<tr>
					<td>
						Επώνυμο:
					</td>
					<td>
						<input type="text" name="epwnymo" id="epwnymo" value="<?=$d1['melh_epwnymo']?>" AUTOCOMPLETE="off"/>
					 </td>
				</tr>
				<tr>
					<td>
						Τμήμα:
					</td>
					<td>
						<input type="text" name="tmhma" id="tmhma" value="<?=$d1['melh_tmhma']?>" AUTOCOMPLETE="off" />
					 </td>
				</tr>
				<tr>
					<td>
						Αρ. Τηλεφώνου:
					</td>
					<td>
						<input type="text" name="thlefwno" id="thlefwno" value="<?=$d1['melh_thlefwno']?>" AUTOCOMPLETE="off"/>
					 </td>
				</tr>
				<tr>
					<td>
						e-mail:
					</td>
					<td>
						<input type="text" name="email" id="email" value="<?=$d1['melh_email']?>" AUTOCOMPLETE="off"/>
					 </td>
				</tr>
				<tr>
					<td>
						Τομέας:
					</td>
					<td>
						<select id="tomeasID" name="tomeas" onChange="ajax_call(this.value)">
						   <option selected="selected" value="<?=$d1['tomeis_id']?>"><?=$d1['tomeis_name']?></option>
							<?php
								mysqli_query($con,"SET NAMES utf8");
								$q="SELECT * FROM tomeis WHERE tomeis_id <> '".$d1['tomeis_id']."'";
								$r=mysqli_query($con,$q);
								while($d=mysqli_fetch_assoc($r)){					
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
						   <option selected="selected" value="<?=$d1['eidikothtes_id']?>"><?=$d1['eidikothtes_name']?></option>
						   <?php
								mysqli_query($con,"SET NAMES utf8");
								$q="SELECT * FROM eidikothtes WHERE (tomeis_id LIKE '".$d1['tomeis_id']."') AND (eidikothtes_id <> '".$d1['eidikothtes_id']."')";
								$r=mysqli_query($con,$q);
								while($d=mysqli_fetch_assoc($r)){					
										echo '<option value="'.$d['eidikothtes_id'].'">'.$d['eidikothtes_name'].'</option>';
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Έτος Κατάρτησης:
					</td>
					<td>
						<select name="etos">
						  <option selected="selected" value="<?=$d1['eth_id']?>"><?=$d1['eth_name']?></option>
							<?php
								mysqli_query($con,"SET NAMES utf8");
								$q="SELECT * FROM eth WHERE eth_id <> '".$d1['eth_id']."'";
								$r=mysqli_query($con,$q);
								while($d=mysqli_fetch_assoc($r)){					
										echo '<option value="'.$d['eth_id'].'">'.$d['eth_name'].'</option>';
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
						<span style="color:#ff0000;">* Όλα τα πεδία είναι υποχρεωτικά</span>
					</td>
					<td colspan="2">&nbsp;</td>
				</tr>
			</table>
		</form>
	</div>
	<?=load_footer()?>
</body>
</html>
