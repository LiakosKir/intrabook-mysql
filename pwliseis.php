<?php
	require_once("bibliopoleioCon.php");
	require_once("lib.php");
	$alrt='';
	echo bib_login_validation();
	if(!empty($_GET)){
		if ((!empty($_POST['apodeiksi']))){
			if(($_GET['mode'])=='reg'){
				mysqli_query($con,"SET NAMES utf8");
				$query="SELECT *
						FROM biblia
						WHERE biblia_name LIKE '".$_POST['titlos']."'";
				$r=mysqli_query($con,$query);
				$d=mysqli_fetch_assoc($r);
				$q="INSERT INTO pwliseis (pwliseis_id,pwliseis_apodeiksi,pwliseis_hmerominia,biblia_id,pwliseis_pelatis,pwliseis_temaxia,pwliseis_timi,pwliseis_telikiAxia,pwliseis_tiposSynallagis)
					VALUES ('".md5($_POST['apodeiksi'])."','".$_POST['apodeiksi']."','".$_POST['date']."','".$_POST['titlos_hid']."','".$_POST['pelatis']."','".$_POST['temaxia']."','".$_POST['timi']."','".$_POST['aksia']."','".($_POST['typos']=="Επιλέξτε"?null:$_POST['typos'])."')";
				$res=mysqli_query($con,$q);
				$alrt='<script>alert("Η καταχώρηση ολοκληρώθηκε")</script>';
				unset ($_POST);
			}
			if(($_GET['mode'])=='edit'){
				mysqli_query($con,"SET NAMES utf8");
				$query="SELECT biblia_id FROM biblia WHERE biblia_name LIKE '".$_POST['titlos']."'";
				$r=mysqli_query($con,$query);
				$d=mysqli_fetch_assoc($r);
				$q="UPDATE pwliseis
					SET pwliseis_hmerominia='".$_POST['date']."',biblia_id='".$d['biblia_id']."',pwliseis_pelatis='".$_POST['pelatis']."',pwliseis_temaxia='".$_POST['temaxia']."',pwliseis_timi='".$_POST['timi']."',pwliseis_telikiAxia='".$_POST['aksia']."',pwliseis_tiposSynallagis='".$_POST['typos']."'
					WHERE pwliseis_id LIKE '".$_GET['id']."'";
				mysqli_query($con,$q);
				$alrt='<script>alert("Η μεταβολή ολοκληρώθηκε")</script>';
				unset ($_POST);
			}
		}
	}
	echo head();
?>
	<script language="javascript">
	<!--
	function ajax_call(titlos){
		var xmlhttp;
		if(document.getElementById("titlosSearch").style.display=="none")
			document.getElementById("titlosSearch").style.display="block";
		if (titlos.length==0){
		  document.getElementById("titlosSearch").innerHTML="";
		  document.getElementById("titlosSearch").style.border="0px";
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
		xmlhttp.open("GET","ajaxPwliseisBib.php?id="+titlos,true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				titlos_search=document.getElementById("titlosSearch");
				str=xmlhttp.responseText;
				document.getElementById("titlosSearch").innerHTML="";
				if(str!=""){
					vals=str.split("|");
					//γέμισμα του select
					document.getElementById("titlosSearch").innerHTML="<li style=\"background-color:#ccc;color:#000;font-size:10px;border-bottom:dotted 1px #000;\">Αποτελέσματα αναζήτησης&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img onclick=\"hideValue()\"src=\"images/deleteButton.png\" style=\"float:right;cursor:pointer\"></li>"
					for(i=0;vals.length;i++){
						tmp=vals[i];
						values=tmp.split(",");
						document.getElementById("titlosSearch").innerHTML+="<li onclick=\"setValue('"+values[0]+"','"+values[1]+"')\" style=\"cursor:pointer\">"+values[1]+"</li>";			
						document.getElementById("titlosSearch").style.border="1px solid #ccc";
					}
				}
			}
		}
	}
	function setValue(id,name){
		document.getElementById("titlos_hid").value=id;
		document.getElementById("titlos").value=name;
		document.getElementById("titlosSearch").innerHTML="";
		document.getElementById("titlosSearch").style.border="0px";
	}
	function hideValue(){
		document.getElementById("titlosSearch").innerHTML="";
		document.getElementById("titlosSearch").style.border="0px";
	}
	-->
</script>
	<body>
		<?=load_bibliopoleioHeader()?>
		<?php
			if(empty($_GET))
				echo load_pwliseisPro();
			else{
				if(($_GET['mode'])=='reg')
					echo load_pwliseisReg().$alrt;
				if(($_GET['mode'])=='edit')
					echo load_pwliseisEdit().$alrt;
			}
		?>
		<?=load_footer()?>
	</body>
</html>