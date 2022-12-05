<?php
function head(){	
	$text=
		'<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="input_css.css"/>
		<link rel="stylesheet" href="jqx.default.css" type="text/css" />
		<script type="text/javascript" src="jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="jqxcore.js"></script>
		<script type="text/javascript" src="jqxmenu.js"></script>
		<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
		<script src="jquery.js" type="text/javascript"></script>
		<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
		<script language="Javascript">
		<!--
			function validation(){
			if (document.getElementById(\'kwdikos\').value=="")
				alert("Δώστε Κωδικό");
			if (document.getElementById(\'xaraktiristika\').value=="")
				alert("");
			}
		-->
		</script>
		<script language="Javascript">
			var timeout    = 500;
var closetimer = 0;
var ddmenuitem = 0;

function jsddm_open()
{  jsddm_canceltimer();
   jsddm_close();
   ddmenuitem = $(this).find(\'ul\').css(\'visibility\', \'visible\');}

function jsddm_close()
{  if(ddmenuitem) ddmenuitem.css(\'visibility\', \'hidden\');}

function jsddm_timer()
{  closetimer = window.setTimeout(jsddm_close, timeout);}

function jsddm_canceltimer()
{  if(closetimer)
   {  window.clearTimeout(closetimer);
      closetimer = null;}}

$(document).ready(function()
{  $(\'#jsddm > li\').bind(\'mouseover\', jsddm_open)
   $(\'#jsddm > li\').bind(\'mouseout\',  jsddm_timer)});

document.onclick = jsddm_close;
		</script>
		</head>';
	return $text;
}
function load_header(){
	$txt1='<div id="header">
    	<img src="images/header_logo.png">
    </div>
	<span id="logout_btn"><a href="logout.php">Έξοδος</a></span>
	';
	return $txt1;
}
function load_back(){
	$txt='<span id="back_button"><a href="apografi_start.php">Πίσω στο μενού</a></span>';
	return $txt;
}
function load_provoli(){
	GLOBAL $con;
	$txt2='
        <div id=\'content\'>
        <script type="text/javascript">
            $(document).ready(function () {
                var theme = $.data(document.body, \'theme\');
                if (theme == null || theme == undefined) theme = \'\';
                $("#jqxMenu").jqxMenu({ width: \'140\',  mode: \'vertical\', theme: theme });
            });
        </script>
        <div id=\'jqxWidget\' style=\'width: 110px;\'>
            <div id=\'jqxMenu\'>
                <ul>';
  			mysqli_query($con,"SET NAMES utf8");
					$q="SELECT * FROM tomeas";
					$r=mysqli_query($con,$q);
					while($d=mysqli_fetch_assoc($r)){
						echo '<li>'.$d['tomeas_name'].'<ul>';
						$q1="SELECT * FROM eidos 
						INNER JOIN ktirio ON eidos.ktirio_id=ktirio.ktirio_id WHERE tomeas_id LIKE '".$d['tomeas_id']."' GROUP BY ktirio.ktirio_id";
						$r1=mysqli_query($con,$q1);
						while($d1=mysqli_fetch_assoc($r1)){
							echo '<li><a href="provoli.php?ktirio='.$d1['ktirio_id'].'&tomeas='.$d['tomeas_id'].'">'.$d1['ktirio_name'].'</a></li>';
						}
						echo '</ul>';
						echo '</li>';
					}
				echo '</ul></div></div></div>';
				if(!empty($_GET)){
					$q2="SELECT * FROM eidos 
						INNER JOIN xwros ON eidos.xwros_id=xwros.xwros_id WHERE eidos.ktirio_id LIKE '".$_GET['ktirio']."' AND eidos.tomeas_id LIKE '".$_GET['tomeas']."' GROUP BY xwros.xwros_name";
					$r2=mysqli_query($con,$q2);
					echo '<div id="TabbedPanels1" class="TabbedPanels">
 						 <ul class="TabbedPanelsTabGroup">';
					$tab_ids=array();
					while($d2=mysqli_fetch_assoc($r2)){
						echo '<li class="TabbedPanelsTab" tabindex="0">'.$d2['xwros_name'].'</li>';
						$tab_ids[]=$d2['xwros_id'];
					}	
					
				echo '</ul><div class="TabbedPanelsContentGroup">';
					foreach($tab_ids as $id=>$data){				
						$tabs_data=mysqli_query($con,"SELECT * FROM eidos 
					INNER JOIN typos ON eidos.typos_id=typos.typos_id
					INNER JOIN ktirio ON eidos.ktirio_id=ktirio.ktirio_id
					INNER JOIN xwros ON eidos.xwros_id=xwros.xwros_id
					INNER JOIN tomeas ON eidos.tomeas_id=tomeas.tomeas_id WHERE eidos.xwros_id LIKE '".$data."'");						
						echo '<div class="TabbedPanelsContent"><table border="1" id="apo_view_table">
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
								</tr>';
						while($d3=mysqli_fetch_assoc($tabs_data)){
							echo '<tr>
							<td>'.$d3['eidos_id'].'</td>
							<td>'.$d3['typos_name'].'</td>
							<td>'.$d3['eidos_xaraktiristika'].'</td>
							<td>'.$d3['eidos_thesi_xristis'].'</td>
							<td>'.$d3['ktirio_name'].'</td>
							<td>'.$d3['eidos_posotita'].'</td>
							<td>'.$d3['xwros_name'].'</td>
							<td>'.$d3['tomeas_name'].'</td>
							<td>'.date("d/m/Y",$d3['hmer_kataxwrisis']).'</td>
						</tr>';
						}
						echo '</table>
								
								</div>';
					}
  				echo '</div></div>';
  
					
				}
				echo '
     <script type="text/javascript">
		<!--
		var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
		//-->
	</script>
	';
return $txt2;
}
?>