<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	GLOBAL $date;
	GLOBAL $time;
	$time=date('h:m:s');
	if (!empty($_POST)){
		mysqli_query($con,"SET NAMES utf8");
		$q="INSERT INTO daneismos (vivlia_id,melh_id,daneismos_hmer_daneismou,daneismos_sxolia)
		VALUES ('".$_POST['titlos_hid']."','".$_POST['melos_hid']."','".strtotime(str_replace("/","-",$_POST['hmer_dan']))."','".$_POST['sxolia']."')";
		echo '['.strtotime(str_replace("/","-",$_POST['hmer_dan'])).']';
		mysqli_query($con,$q) or die($mysql->error());
	}
	echo head();
?>
	<script language="javascript">
	function ajax_call(titlos){
		var xmlhttp;
		if (titlos.length==0){
		  document.getElementById("titlos_search").innerHTML="";
		  document.getElementById("titlos_search").style.border="0px";
		  return;
		}
		if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
			{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		var tmp="";
		xmlhttp.open("GET","ajax_daneismos_viv.php?id="+titlos,true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				titlos_search=document.getElementById("titlos_search");
				str=xmlhttp.responseText;
				document.getElementById("titlos_search").innerHTML="";
				if(str!=""){
					vals=str.split("|");
					//γέμισμα του select
					document.getElementById("titlos_search").innerHTML="<li style=\"background-color:#000;color:#fff;\">Αποτελέσματα αναζήτησης&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img onclick=\"hideValue()\"src=\"images/deleteButton.png\" style=\"float:right;cursor:pointer\"></li>"
					for(i=0;vals.length;i++){

						if (vals.includes("'")){
						vals.replace("'","\'");
					}
					
						tmp=vals[i];
						values=tmp.split(",");
						document.getElementById("titlos_search").innerHTML+="<li onclick=\"setValue('"+values[0]+"','"+values[1]+"')\" style=\"cursor:pointer\">"+values[1]+"</li>";			
						document.getElementById("titlos_search").style.border="1px solid #000";
					}
				}
			}
		}
	}
	function setValue(id,name){
		document.getElementById("titlos_hid").value=id;
		document.getElementById("titlos").value=name;
		document.getElementById("titlos_search").innerHTML="";
		document.getElementById("titlos_search").style.border="0px";	
	}
	function hideValue(){
		document.getElementById("titlos_search").innerHTML="";
		document.getElementById("titlos_search").style.border="0px";
	}

</script>
<script language="javascript">
	
	function ajax_call_melos(melos){
		var xmlhttp;
		if (titlos.length==0){ 
		  document.getElementById("melos_search").innerHTML="";
		  document.getElementById("melos_search").style.border="0px";
		  return;
		}
		if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
			{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		var tmp="";
		xmlhttp.open("GET","ajax_daneismos_melh.php?id="+melos,true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				titlos_search=document.getElementById("melos_search");
				str=xmlhttp.responseText;				
				document.getElementById("melos_search").innerHTML="";
				if(str!=""){
				vals=str.split("|");								
				//γέμισμα του select	
				document.getElementById("melos_search").innerHTML="<li style=\"background-color:#000;color:#fff;\">Αποτελέσματα αναζήτησης&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img onclick=\"hideValueMelos()\"src=\"images/deleteButton.png\" style=\"float:right;cursor:pointer\"></li>"
				for(i=0;vals.length;i++){
					tmp=vals[i];
					values=tmp.split(",");
					document.getElementById("melos_search").innerHTML+="<li onclick=\"setValueMelos('"+values[0]+"','"+values[1]+"')\" style=\"cursor:pointer\">"+values[1]+"</li>";			
					document.getElementById("melos_search").style.border="1px solid #000";
				}
				}
			}
		}
	}
	function setValueMelos(id,name){
		document.getElementById("melos_hid").value=id;
		document.getElementById("melos").value=name;
		document.getElementById("melos_search").innerHTML="";
		document.getElementById("melos_search").style.border="0px";	
	}
	function hideValueMelos(){
		document.getElementById("melos_search").innerHTML="";
		document.getElementById("melos_search").style.border="0px";
	}
</script>
	<body>
		<?=load_viv_header()?>
		<h1 class="headlines">Δανεισμός Βιβλίου</h1>
		<form id="daneismos_form" action="daneismos.php" method="post">
			<table id="dan_table">
				<tr>
					<td colspan="2">
						Τίτλος Βιβλίου
						<input type="text" id="titlos" name="titlos" onKeyup="ajax_call(this.value)" AUTOCOMPLETE="off"/>
						<input type="hidden" id="titlos_hid" name="titlos_hid" value=""/>
						<ul id="titlos_search" class="live_search">			
						</ul>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						Ονοματεπώνυμο Μέλους
						<input type="text" id="melos" name="melos" onKeyup="ajax_call_melos(this.value)" AUTOCOMPLETE="off"/>
						<input type="hidden" id="melos_hid" name="melos_hid" value=""/>
						<ul id="melos_search" class="live_search">
						</ul>
					</td>
				</tr>
				<tr>
					<td valign="top">
						Ημερομηνία δανεισμού
						<input style="width:200px;" type="text" name="hmer_dan" value="<?php echo date('d/m/Y');?>" onfocus="this.blur()"/>
					</td>
					<td>
						Σχόλια
						<textarea name="sxolia">
						</textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="Καταγραφή"/>
						<input type="reset" value="Καθαρισμός"/>
					</td>
				</tr>
			</table>
		</form>
		<?=load_footer()?>
	</body>
	</html>