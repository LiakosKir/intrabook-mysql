<?php
function head(){	
	$text=
		'<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<meta http-equiv="X-UA-Compatible" content="IE=100" >
		<meta http-equiv="X-UA-Compatible" content="IE=9" >
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="input_css.css"/>
		<link rel="stylesheet" href="jqx.default.css" type="text/css" />
		<link rel="stylesheet" href="js/css/jquery.lightbox-0.5.css" type="text/css" />
		<script type="text/javascript" src="jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="jqxcore.js"></script>
		<script type="text/javascript" src="jqxmenu.js"></script>
		<script type="text/javascript" src="js/js/jquery.js"></script>
		<script type="text/javascript" src="js/js/jquery.lightbox-0.5.js"></script>
		<script type="text/javascript" src="paraggeliesAnimate.js"></script>
		<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
		<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
			function goBack()
			  {
			  window.history.back()
			  }
		</script>
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
	GLOBAL $con;
	mysqli_query($con, "SET NAMES utf8");
		$q="SELECT *
			FROM user
			WHERE user_id LIKE '".$_SESSION['user_data']['user_id']."'";
		$r=mysqli_query($con,$q);
		$d=mysqli_fetch_assoc($r);
		$txt1='
			<div id="header">
				<img src="images/header_logo.png">
				<div id="head_links">
					<span class="head_user">'.$d['user_epwnymo'].'&nbsp;'.$d['user_onoma'].'-(<a href="logout.php">Έξοδος</a>)</span><br/>
					<span id="apo_viv_links">
						<a href="arxiki.php">Αρχική</a>&nbsp;-
						<a href="apografi_start.php">Απογραφή</a>&nbsp;-
						<a href="vivliothiki_start.php">Βιβλιοθήκη</a>&nbsp;-
						<a href="user_management.php">Διαχείρηση Χρηστών</a>&nbsp;-
						<a href="bibliopwleio_start.php">Βιβλιοπωλείο</a>
					</span>
				</div>
			</div>
		<div id="main">          
			<div class="container4">
			<div class="menu4">
            <ul id="menu_ul">
				<li class="goback" onclick="goBack()"><img src="images/back_btn.gif" align="absmiddle"/>
					<span>Επιστροφή</span>
				</li>
                <li class="menu_li"><a href="#"><span>Απογραφή</span></a>
					<ul>
						<li><a href="apografi.php"><span>Καταχώρηση Είδους</span></a></li>
						<li><a href="eidos_edit.php"><span>Εισαγωγή Εικόνας</span></a></li>
						<li><a href="metakinisi.php"><span>Μετακίνηση</span></a></li>
					</ul>
				</li>
				<li class="menu_li">
					<a href="#"><span>Προβολή</span></a>
					<ul>';
						$txt1.= load_provoli();
					$txt1.='</ul>
				</li>
				<li class="menu_li">
					<a href="#"><span>Γενική Προβολή</span></a>
					<ul>';
                	mysqli_query($con,"SET NAMES utf8");
					$q="SELECT * FROM ktirio";				
					$r=mysqli_query($con,$q) or die('<center>'.((mysqli_errno($con)==1142)?'Access Denied<br /><a href="arxiki.php">Επιστροφή</a>':mysqli_error($con)).'</center>');
					while($d=mysqli_fetch_assoc($r)){
						$txt1.= '<li><a href="gen_provoli_tbl.php?id='.$d['ktirio_id'].'"><span>'.$d['ktirio_name'].'</span></a></li>';
					}
					$txt1.='</ul>
				</li>
				<li class="menu_li">
					<a href="#"><span>Εκτύπωση</span></a>
					<ul>';
						$txt1.= load_ektiposi();
					$txt1.='</ul>
				</li>
				<li class="menu_li">
					<a href="#"><span>Βοηθητικά</span></a>
					<ul>
						<li><a href="promitheutes.php"><span>Προμηθευτές</span></a></li>
						<li><a href="etairia.php"><span>Εταιρία</span></a></li>
						<li><a href="tomeas.php"><span>Τομέας</span></a></li>
						<li><a href="typos.php"><span>Τύπος</span></a></li>
						<li><a href="ktirio.php"><span>Κτίριο</span></a></li>
						<li><a href="xwros.php"><span>Χώρος</span></a></li>
					</ul>
				</li>
             </div>
			 </div>
        </div>
	';
	return $txt1;
}
function load_viv_header(){
	GLOBAL $con;
	mysqli_query($con,"SET NAMES utf8");
		$q="SELECT *
			FROM user
			WHERE user_id LIKE '".$_SESSION['user_data']['user_id']."'";
		$r=mysqli_query($con,$q);
		$d=mysqli_fetch_assoc($r);
	$txt1=
		'<div id="header">
			<img src="images/header_logo.png">
			<div id="head_links">
				<span class="head_user">'.$d['user_epwnymo'].'&nbsp;'.$d['user_onoma'].'-(<a href="logout.php">Έξοδος</a>)</span><br/>
				<span id="apo_viv_links">
					<a href="arxiki.php">Αρχική</a>&nbsp;-
					<a href="apografi_start.php">Απογραφή</a>&nbsp;-
					<a href="vivliothiki_start.php">Βιβλιοθήκη</a>&nbsp;-
					<a href="user_management.php">Διαχείρηση Χρηστών</a>&nbsp;-
					<a href="bibliopwleio_start.php">Βιβλιοπωλείο</a>
				</span>
			</div>
		</div>
		<div id="main">          
			<div class="container4">
			<div class="menu4">
            <ul id="menu_ul">
				<li class="goback" onclick="goBack()"><img src="images/back_btn.gif" align="absmiddle"/><span>Επιστροφή</span></li>
				<li class="menu_li">
					<a href="daneismos.php"><span>Δανεισμός</span></a>
				</li>
				<li class="menu_li">
					<a href="vivlia_epist.php"><span>Επιστροφή</span></a>
				</li>
				<li class="menu_li">
					<a href="#"><span>Προβολή</span></a>
					<ul>
						<li><a href="provoli_melh.php"><span>Μέλη</span></a></li>
						<li><a href="provoli_vivlia.php"><span>Βιβλία</span></a></li>
					</ul>
				</li>
				<li class="menu_li">
					<a href="#"><span>Εκτύπωση</span></a>
					<ul>
						<li><a href="ektiposi_melh.php"><span>Μέλη</span></a></li>
						<li><a href="ektiposi_vivlia.php"><span>Βιβλία</span></a></li>
						<li><a href="ektiposi_daneismoi.php"><span>Δανεισμοί</span></a></li>
						</ul>
				</li>
				<li class="menu_li">
					<a href="#"><span>Βοηθητικά</span></a>
					<ul>
						<li><a href="melh.php"><span>Μέλη</span></a></li>
						<li><a href="vivlia.php"><span>Βιβλία</span></a></li>
						<li><a href="epipeda.php"><span>Επίπεδα</span></a></li>
						<li><a href="katigories.php"><span>Κατηγορίες</span></a></li>
						<li><a href="ekdoseis.php"><span>Εκδόσεις</span></a></li>
						<li><a href="tomeis.php"><span>Τομείς</span></a></li>
						<li><a href="eidikothtes.php"><span>Ειδικότητες</span></a></li>
						<li><a href="eth.php"><span>Διδακτικά Έτη</span></a></li>
					</ul>
				</li>
             </div>
			 </div>
        </div>
	';
	return $txt1;
}
function load_general_header(){
	GLOBAL $con;
	mysqli_query($con,"SET NAMES utf8");
	$q="SELECT *
	FROM user
	WHERE user_id LIKE '".$_SESSION['user_data']['user_id']."'
	";
	$r=mysqli_query($con,$q);
	$d=mysqli_fetch_assoc($r);
	$txt='
		<div id="header">
			<img src="images/header_logo.png"/>
			<div id="head_links">
				<span class="head_user">'.$d['user_epwnymo'].'&nbsp;'.$d['user_onoma'].'-(<a href="logout.php">Έξοδος</a>)</span><br/>
				<span id="apo_viv_links">
					<a href="arxiki.php">Αρχική</a>&nbsp;-
					<a href="apografi_start.php">Απογραφή</a>&nbsp;-
					<a href="vivliothiki_start.php">Βιβλιοθήκη</a>&nbsp;-
					<a href="user_management.php">Διαχείρηση Χρηστών</a>&nbsp;-
					<a href="bibliopwleio_start.php">Βιβλιοπωλείο</a>
				</span>
			</div>
		</div>';
	return $txt;
}
function load_bibliopoleio_header(){
	$txt='
		<div id="header">
			<img src="images/header_logo.png"/>
			<div id="head_links">
				<span class="head_user">admin-(<a href="logout.php">Έξοδος</a>)</span><br/>
				<span id="apo_viv_links">
					<a href="arxiki.php">Αρχική</a>&nbsp;-
					<a href="apografi_start.php">Απογραφή</a>&nbsp;-
					<a href="vivliothiki_start.php">Βιβλιοθήκη</a>&nbsp;-
					<a href="user_management.php">Διαχείρηση Χρηστών</a>&nbsp;-
					<a href="bibliopwleio_start.php">Βιβλιοπωλείο</a>
				</span>
			</div>
		</div>';
	return $txt;
}
function load_bibliopoleioHeader(){
	$txt='
		<div id="header">
			<img src="images/header_logo.png"/>
			<div id="head_links">
				<span class="head_user">admin-(<a href="logout.php">Έξοδος</a>)</span><br/>
				<span id="apo_viv_links">
					<a href="arxiki.php">Αρχική</a>&nbsp;-
					<a href="apografi_start.php">Απογραφή</a>&nbsp;-
					<a href="vivliothiki_start.php">Βιβλιοθήκη</a>&nbsp;-
					<a href="user_management.php">Διαχείρηση Χρηστών</a>&nbsp;-
					<a href="bibliopwleio_start.php">Βιβλιοπωλείο</a>
				</span>
			</div>
		</div>
		<div id="main">          
			<div class="container4">
			<div class="menu4">
            <ul id="menu_ul">
				<li class="goback" onclick="goBack()"><img src="images/back_btn.gif" align="absmiddle"/><span>Επιστροφή</span></li>
				<li class="menu_li">
					<a href="paraggelies.php"><span>Παραγγελίες</span></a>
				</li>
				<li class="menu_li">
					<a href="biblia.php"><span>Βιβλία</span></a>
				</li>
				<li class="menu_li">
					<a href="suggrafeis.php"><span>Συγγραφείς</span></a>
				</li>
				<li class="menu_li">
					<a href="ekdotikoi.php"><span>Εκδότες</span></a>
				</li>
				<li class="menu_li">
					<a href="pwliseis.php"><span>Πωλήσεις</span></a>
				</li>
				<li class="menu_li">
					<a href="#"><span>Διάφορα</span></a>
					<ul>
						<li><a href="#"><span>Αιτήσεις ISBN</span></a></li>
						<li><a href="#"><span>Συγκεντρωτικά</span></a></li>
						<li><a href="#"><span>Συμφωνητικά</span></a></li>
						<li><a href="#"><span>Πληρωμές</span></a></li>
					</ul>
				</li>
             </div>
			 </div>
        </div>
	';
	return $txt;
}
function load_footer(){
	$txt='
	<span style="margin-top:70px;float:left;">&nbsp;</span>
	<div class="footer">
			<li class="browser">
				Η σελίδα υποστηρίζεται πλέον από ΟΛΟΥΣ τους Browsers ! ;)
			</li>
	</div>';
	return $txt;
}
function load_provoli(){
	GLOBAL $con;
	$txt2='';
  			mysqli_query($con,"SET NAMES utf8");
					$q="SELECT * FROM tomeas";
					$r=mysqli_query($con,$q) or die('<div class="mauri_i_nixta_sto_vouno"><span class="acc_denied">'.((mysqli_errno($con)==1142)?'<img align="absmiddle" width="100px" src="images/user_lock.png"/><br/>Δεν έχετε δικαίωμα πρόσβασης σε αυτή την σελίδα.<br/><br/><a href="arxiki.php">Επιστροφή</a>':mysqli_error($con)).'</span></div>');
					while($d=mysqli_fetch_assoc($r)){
						$txt2.='<li><a href="#">'.$d['tomeas_name'].'</a><ul>';
						$q1="SELECT * FROM eidos 
						INNER JOIN ktirio ON eidos.ktirio_id=ktirio.ktirio_id WHERE tomeas_id LIKE '".$d['tomeas_id']."' GROUP BY ktirio.ktirio_id";
						$r1=mysqli_query($con,$q1);
						while($d1=mysqli_fetch_assoc($r1)){
							$txt2.= '<li><a href="provoli.php?ktirio='.$d1['ktirio_id'].'&tomeas='.$d['tomeas_id'].'">'.$d1['ktirio_name'].'</a></li>';
						}
						$txt2.='</ul></li>';
					}
return $txt2;
}
function load_ektiposi(){
	GLOBAL $con;
	$txt2='';
  			mysqli_query($con,"SET NAMES utf8");
					$q="SELECT * FROM ktirio";
					$r=mysqli_query($con,$q);
					while($d=mysqli_fetch_assoc($r)){
						$txt2.='<li><a href="#">'.$d['ktirio_name'].'</a><ul>';
						$q1="SELECT * FROM eidos 
						INNER JOIN xwros ON eidos.xwros_id=xwros.xwros_id WHERE eidos.ktirio_id LIKE '".$d['ktirio_id']."' GROUP BY xwros.xwros_id";
						$r1=mysqli_query($con,$q1);
						while($d1=mysqli_fetch_assoc($r1)){
							$txt2.= '<li><a href="ektiposi.php?xwros='.$d1['xwros_id'].'&ktirio='.$d['ktirio_id'].'">'.$d1['xwros_name'].'</a></li>';
						}
						$txt2.='</ul></li>';
					}
return $txt2;
}
function login_validation(){
	if (!isset($_SESSION['user_data']))
		header('Location:index.php');
}
function bib_login_validation(){
	
}
function kinisi_form(){
	global $con;
	mysqli_query($con,"SET NAMES utf8");
	$q3="SELECT * FROM eidos 
		INNER JOIN typos ON eidos.typos_id=typos.typos_id
		INNER JOIN ktirio ON eidos.ktirio_id=ktirio.ktirio_id
		INNER JOIN xwros ON eidos.xwros_id=xwros.xwros_id
		INNER JOIN tomeas ON eidos.tomeas_id=tomeas.tomeas_id
		WHERE eidos_id=".$_GET['id']."";
	$r3=mysqli_query($con,$q3);
	$d3=mysqli_fetch_assoc($r3);
	$txt="
	
	<div id='metakinisi_container'>
		<h1 class='headlines'>Μετακίνηση Είδους</h1>
		<div id='metakinisi_left'>
			<table>
				<tr>
					<th colspan='2'>ΣΤΟΙΧΕΙΑ ΕΙΔΟΥΣ</th>
				</tr>
				<tr>
					<td style='text-align:right !important;'>Κωδικός:</td><td style='text-align:left !important;color:#b1b1b1;'>".$d3['eidos_id']."</td>
				</tr>
				<tr>
					<td style='text-align:right !important;'>Τύπος Εξοπλισμού:</td><td style='text-align:left !important;color:#b1b1b1;'>".$d3['typos_name']."</td>
				</tr>
				<tr>
					<td style='text-align:right !important;'>Κτίριο:</td><td style='text-align:left !important;color:#b1b1b1;'>".$d3['ktirio_name']."</td>
				</tr>
				<tr>
					<td style='text-align:right !important;'>Χώρος:</td><td style='text-align:left !important;color:#b1b1b1;'>".$d3['xwros_name']."</td>
				</tr>
				<tr>
					<td style='text-align:right !important;'>Τομέας:</td><td style='text-align:left !important;color:#b1b1b1;'>".$d3['tomeas_name']."</td>
				</tr>
			</table>
		</div>
	<div id='metakinisi_right'>
		<form action=\"metakinisi.php?id=".$_GET['id']."\" method=\"post\">
		<input type='hidden' name='apo' value='".$d3['ktirio_name']."-".$d3['xwros_name']."'/>
		<table id='kinisi_form'>
			<tr>
				<th>ΚΙΝΗΣΗ</th>
			</tr>
			<tr>
				<td>Είδος Κίνησης:</td>
			</tr>
			<tr>
				<td>
					<select name='kinisi'>
						<option selected='selected'>Επιλέξτε</option>";
					mysqli_query($con,"SET NAMES utf8");
					$q2="SELECT * FROM kinisi";
					$r2=mysqli_query($con,$q2);
					while($d2=mysqli_fetch_assoc($r2)){
						$txt.='<option value="'.$d2['kinisi_id'].'">'.$d2['kinisi_name'].'</option>';
					}
				$txt.="</select>
				</td>
			</tr>
			<tr>
				<td>Προορισμός:</td>
			</tr>
			<tr>
				<td>
					<select name='target'>
						<option selected='selected'>Επιλέξτε</option>";
						mysqli_query($con,"SET NAMES utf8");
						$q="SELECT * FROM ktirio";
						$r=mysqli_query($con,$q);
						while($d=mysqli_fetch_assoc($r)){
						$txt.='<optgroup label="'.$d['ktirio_name'].'">';
							mysqli_query($con,"SET NAMES utf8");
							$q1="SELECT * FROM xwros 
							INNER JOIN eidos ON xwros.xwros_id=eidos.xwros_id
							WHERE ktirio_id LIKE '".$d['ktirio_id']."'
							GROUP BY xwros.xwros_id
							ORDER BY xwros.xwros_name ASC";
							$r1=mysqli_query($con,$q1);
							while($d1=mysqli_fetch_assoc($r1)){
								$txt.='<option value="'.$d1['tomeas_id'].'@'.$d['ktirio_id'].'@'.$d1['xwros_id'].'@'.$d['ktirio_name'].'-'.$d1['xwros_name'].'">'.$d1['xwros_name'].'</option>';
							}
						$txt.='</optgroup>';
						}
			$txt.="</select>
				</td>
			</tr>
			<tr>
				<td>
					Σχόλια:<br />
					<input type='text' name='sxolia' AUTOCOMPLETE='off'/>
				</td>
			</tr>
			<tr>
				<td><input type='submit' value='OK'/></td>
			</tr>
		</table>
		</form>
	</div>
	</div>";
	return $txt;
}
function is_image($filename){
	$images=array("jpg","gif","png","bmp");
	$explode=explode('.',$filename);
	$file=end($explode);
	if(in_array($file,$images))
		return true;
	else
		return false;
}
function load_suggrafeisPro(){
	GLOBAL $con;
	mysqli_query($con,"SET NAMES utf8");
	$q="SELECT * FROM suggrafeis";
	if(!empty($_POST['suggrafeas']))
		$q.=" WHERE suggrafeis_epwnymo LIKE '%".$_POST['suggrafeas']."%'";
	$q.=" ORDER BY suggrafeis_epwnymo ASC";
	$r=mysqli_query($con,$q);
	$txt='
	<div class="container_sample">
		<h1 class="headlines">Λίστα Συγγραφέων <span style="font-weight:normal;">('.mysqli_num_rows($r).')</span></h1>
		<div class="addContainer">
			<a href="suggrafeis.php?mode=reg"><img align="absmiddle" src="images/add_btn.png"/>
				<span>Προσθήκη νέου συγγραφέα</span>
			</a>
		</div>
		<form style="margin:10px 0 5px 0;" action="suggrafeis.php" method="post" id="apo_form">
			<input type="text" name="suggrafeas" id="suggrafeas" value="" AUTOCOMPLETE="off" title="Πληκτρολογήστε το επώνυμο του συγγραφέα"/>
			<input type="submit" name="search_btn" id="search_btn" value="Αναζήτηση"/>
		</form>
		<table class="tables">
			<tr>
				<th>
					Επώνυμο
				</th>
				<th>
					Όνομα
				</th>
				<th>
					Διεύθυνση
				</th>
				<th>
					Τ.Κ
				</th>
				<th>
					Πόλη
				</th>
				<th>
					Περιοχή
				</th>
				<th>
					Τηλέφωνο Σταθερό
				</th>
				<th>
					Τηλέφωνο Κινητό
				</th>
				<th>
					ΑΦΜ
				</th>
				<th>
					ΔΟΥ
				</th>
				<th>
					Φύλλο
				</th>
				<th>
					email
				</th>
				<th>
					Ημερ/νια Γέννησης
				</th>
				<th>
					Ενέργειες
				</th>
			</tr>
		';
	while($d=mysqli_fetch_assoc($r)){
		$txt.='
			<tr>
				<td>'.($d['suggrafeis_epwnymo']==null?'&nbsp;':$d['suggrafeis_epwnymo']).'</td>
				<td>'.($d['suggrafeis_onoma']==null?'&nbsp;':$d['suggrafeis_onoma']).'</td>
				<td>'.($d['suggrafeis_dieuthinsi']==null?'&nbsp;':$d['suggrafeis_dieuthinsi']).'</td>
				<td>'.($d['suggrafeis_tk']==null?'&nbsp;':$d['suggrafeis_tk']).'</td>
				<td>'.($d['suggrafeis_poli']==null?'&nbsp;':$d['suggrafeis_poli']).'</td>
				<td>'.($d['suggrafeis_perioxi']==null?'&nbsp;':$d['suggrafeis_perioxi']).'</td>
				<td>'.($d['suggrafeis_stathero']==null?'&nbsp;':$d['suggrafeis_stathero']).'</td>
				<td>'.($d['suggrafeis_kinito']==null?'&nbsp;':$d['suggrafeis_kinito']).'</td>
				<td>'.($d['suggrafeis_afm']==null?'&nbsp;':$d['suggrafeis_afm']).'</td>
				<td>'.($d['suggrafeis_doy']==null?'&nbsp;':$d['suggrafeis_doy']).'</td>
				<td>'.($d['suggrafeis_fylo']==null?'&nbsp;':$d['suggrafeis_fylo']).'</td>
				<td>'.($d['suggrafeis_email']==null?'&nbsp;':$d['suggrafeis_email']).'</td>
				<td>'.($d['suggrafeis_hmer_gennisis']==null?'&nbsp;':$d['suggrafeis_hmer_gennisis']).'</td>
				<td><a href="suggrafeis.php?mode=edit&id='.$d['suggrafeis_id'].'"><img src="images/edit_foto.png"/></a></td>
			</tr>
		';
	}
	$txt.='</table>
	</div>
	';
	return $txt;
}
function load_suggrafeisReg(){
	$txt='
	<div class="container_sample">
		<h1 class="headlines">Εισαγωγή Συγγραφέα</h1>
		<form style="margin-top:20px;" action="suggrafeis.php?mode=reg" method="post">
			<table class="entry_forms">
				<tr>
					<td>
						Επώνυμο
					</td>
					<td>
						<input type="text" name="epwnymo" value="'.((!empty($_POST))?($_POST['epwnymo']):(null)).'"/><span class="asteriskos">*</span>
					</td>
					<td>
						Τηλέφωνο Κινητό
					</td>
					<td>
						<input type="text" name="kinito" value="'.((!empty($_POST))?($_POST['kinito']):(null)).'"/>
					</td>
				</tr>
				<tr>
					<td>
						Όνομα
					</td>
					<td>
						<input type="text" name="onoma" value="'.((!empty($_POST))?($_POST['onoma']):(null)).'"/><span class="asteriskos">*</span>
					</td>
					<td>
						Τηλέφωνο Σταθερό
					</td>
					<td>
						<input type="text" name="stathero" value="'.((!empty($_POST))?($_POST['stathero']):(null)).'"/>
					</td>
					
				</tr>
				<tr>
					<td>
						Διεύθυνση
					</td>
					<td>
						<input type="text" name="dieuthinsi" value="'.((!empty($_POST))?($_POST['dieuthinsi']):(null)).'"/>
					</td>
					<td>
						Α.Φ.Μ
					</td>
					<td>
						<input type="text" name="afm" value="'.((!empty($_POST))?($_POST['afm']):(null)).'"/>
					</td>
					
				</tr>
				<tr>
					<td>
						Πόλη
					</td>
					<td>
						<input type="text" name="poli" value="'.((!empty($_POST))?($_POST['poli']):(null)).'"/>
					</td>
					<td>
						Δ.Ο.Υ
					</td>
					<td>
						<input type="text" name="doy" value="'.((!empty($_POST))?($_POST['doy']):(null)).'"/>
					</td>
					
				</tr>
				<tr>
					<td>
						Περιοχή
					</td>
					<td>
						<input type="text" name="perioxi" value="'.((!empty($_POST))?($_POST['perioxi']):(null)).'"/>
					</td>
					<td>
						Φύλλο
					</td>
					<td>
						<select name="fyllo"/>
							<option>Επιλέξτε</option>
							<option '.(isset($_POST['fyllo']) && $_POST['fyllo']=="Αρρέν"?"selected='selected'":"").' value="Αρρέν">Αρρέν</option>
							<option '.(isset($_POST['fyllo']) && $_POST['fyllo']=="Θηλή"?"selected='selected'":"").' value="Θηλή">Θηλή</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Τ.Κ.
					</td>
					<td>
						<input type="text" name="tk" value="'.((!empty($_POST))?($_POST['tk']):(null)).'"/>
					</td>
					<td>
						Ημερ/νία Γέννησης
					</td>
					<td>
						<input type="text" name="hmer_gennisis" value="'.((!empty($_POST))?($_POST['hmer_gennisis']):(null)).'"/>
					</td>
				</tr>
				<tr>
					<td>
						email
					</td>
					<td>
						<input type="text" name="email" value="'.((!empty($_POST))?($_POST['email']):(null)).'"/>
					</td>
				</tr>
				<tr>
					<td colspan="4" align="center">
						<input type="submit" value="Εισαγωγή"/>
						<input type="reset" value="Καθαρισμός"/>
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<span style="color:#ff0000;">Τα πεδία με αστερίσκο (*) είναι υποχρεωτικά</span>
					</td>
				</tr>
			</table>
		</form>
		</div>';
	return $txt;
}
function load_suggrafeisEdit(){
	GLOBAL $con;
	mysqli_query($con,"SET NAMES utf8");
	$q="SELECT * 
		FROM suggrafeis
		WHERE suggrafeis_id LIKE '".$_GET['id']."'";
	$r=mysqli_query($con,$q);
	$d=mysqli_fetch_assoc($r);
	$txt='
		<div class="container_sample">
		<h1 class="headlines">Επεξεργασία Συγγραφέα</h1>
		<form style="margin-top:20px;" action="suggrafeis.php?mode=edit&id='.$_GET['id'].'" method="post">
			<table class="entry_forms">
				<tr>
					<td>
						Επώνυμο
					</td>
					<td>
						<input type="text" name="epwnymo" value="'.$d['suggrafeis_epwnymo'].'" onfocus="this.blur()"/>
					</td>
					<td>
						Τηλέφωνο Κινητό
					</td>
					<td>
						<input type="text" name="kinito" value="'.$d['suggrafeis_kinito'].'"/>
					</td>
				</tr>
				<tr>
					<td>
						Όνομα
					</td>
					<td>
						<input type="text" name="onoma" value="'.$d['suggrafeis_onoma'].'" onfocus="this.blur()"/>
					</td>
					<td>
						Τηλέφωνο Σταθερό
					</td>
					<td>
						<input type="text" name="stathero" value="'.$d['suggrafeis_stathero'].'"/>
					</td>
					
				</tr>
				<tr>
					<td>
						Διεύθυνση
					</td>
					<td>
						<input type="text" name="dieuthinsi" value="'.$d['suggrafeis_dieuthinsi'].'"/>
					</td>
					<td>
						Α.Φ.Μ
					</td>
					<td>
						<input type="text" name="afm" value="'.$d['suggrafeis_afm'].'"/>
					</td>
					
				</tr>
				<tr>
					<td>
						Πόλη
					</td>
					<td>
						<input type="text" name="poli" value="'.$d['suggrafeis_poli'].'"/>
					</td>
					<td>
						Δ.Ο.Υ
					</td>
					<td>
						<input type="text" name="doy" value="'.$d['suggrafeis_doy'].'"/>
					</td>
					
				</tr>
				<tr>
					<td>
						Περιοχή
					</td>
					<td>
						<input type="text" name="perioxi" value="'.$d['suggrafeis_perioxi'].'"/>
					</td>
					<td>
						Φύλλο
					</td>
					<td>
						<select name="fyllo"/>
							<option>Επιλέξτε</option>
							<option '.($d['suggrafeis_fylo']=='Αρρέν'?'selected="selected"':'').' value="Αρρέν">Αρρέν</option>
							<option '.($d['suggrafeis_fylo']=='Θηλή'?'selected="selected"':'').' value="Θηλή">Θηλή</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Τ.Κ.
					</td>
					<td>
						<input type="text" name="tk" value="'.$d['suggrafeis_tk'].'"/>
					</td>
					<td>
						Ημερ/νία Γέννησης
					</td>
					<td>
						<input type="text" name="hmer_gennisis" value="'.$d['suggrafeis_hmer_gennisis'].'"/>
					</td>
				</tr>
				<tr>
					<td>
						email
					</td>
					<td>
						<input type="text" name="email" value="'.$d['suggrafeis_email'].'"/>
					</td>
				</tr>
				<tr>
					<td colspan="4" align="center">
						<input type="submit" value="Μεταβολή"/>
						<input type="reset" value="Καθαρισμός"/>
					</td>
				</tr>
			</table>
		</form>
		</div>';
	return $txt;
}
function load_bibliaPro(){
	GLOBAL $con;
	mysqli_query($con,"SET NAMES utf8");
	$q="SELECT * 
		FROM biblia INNER JOIN suggrafeis ON biblia.suggrafeis_id=suggrafeis.suggrafeis_id";
	if(!empty($_POST['biblio']))
		$q.=" WHERE biblia_name LIKE '%".$_POST['biblio']."%' OR biblia_isbn LIKE '%".$_POST['biblio']."%'";
	$q.=" ORDER BY biblia_name ASC";
	$r=mysqli_query($con,$q);
	$txt='
	<div class="container_sample">
		<h1 class="headlines">Λίστα Βιβλίων <span style="font-weight:normal;">('.mysqli_num_rows($r).')</span></h1>
		<div class="addContainer">
			<a href="biblia.php?mode=reg"><img align="absmiddle" src="images/add_btn.png"/>
				<span>Προσθήκη νέου βιβλίου</span>
			</a>
		</div>
		<form style="margin:10px 0 5px 0;" action="biblia.php" method="post" id="apo_form">
			<input type="text" name="biblio" id="biblio" value="" AUTOCOMPLETE="off" title="Πληκτρολογήστε τον τίτλο ή το ISBN του βιβλίου"/>
			<input type="submit" name="search_btn" id="search_btn" value="Αναζήτηση"/>
		</form>
		<table class="tables">
			<tr>
				<th>
					Κωδικός
				</th>
				<th>
					Σχολική Περίοδος
				</th>
				<th>
					Ημερομηνία
				</th>
				<th>
					ISBN
				</th>
				<th>
					Τίτλος
				</th>
				<th>
					Χρώμα
				</th>
				<th>
					Διαστάσεις
				</th>
				<th>
					Σελίδες
				</th>
				<th>
					Συγγραφέας
				</th>
				<th>
					Τομέας/Ειδικότητα
				</th>
				<th>
					Σχόλια
				</th>
				<th>
					Είδος Τίτλου
				</th>
				<th>
					Εικονογραφημένο
				</th>
				<th>
					Ενέργειες
				</th>
			</tr>
		';
	while($d=mysqli_fetch_assoc($r)){
		$txt.='
			<tr>
				<td>'.$d['biblia_id'].'</td>
				<td>'.($d['biblia_periodos']==null?'&nbsp;':$d['biblia_periodos']).'</td>
				<td>'.($d['biblia_hmeromhnia']==null?'&nbsp;':$d['biblia_hmeromhnia']).'</td>
				<td>'.($d['biblia_isbn']==null?'&nbsp;':$d['biblia_isbn']).'</td>
				<td>'.($d['biblia_name']==null?'&nbsp;':$d['biblia_name']).'</td>
				<td>'.($d['biblia_xrwma']==null?'&nbsp;':$d['biblia_xrwma']).'</td>
				<td>'.($d['biblia_diastaseis']==null?'&nbsp;':$d['biblia_diastaseis']).'</td>
				<td>'.($d['biblia_selides']==null?'&nbsp;':$d['biblia_selides']).'</td>
				<td>'.(($d['suggrafeis_epwnymo']==null && $d['suggrafeis_onoma']==null)?'&nbsp;':$d['suggrafeis_epwnymo'].'&nbsp;'.$d['suggrafeis_onoma']).'</td>
				<td>';
					if($d['tomeisEidikotites_id']==null)
						$txt.='&nbsp;';
					else{
						$tomeas=explode("_",$d['tomeisEidikotites_id']);
						$tomeasImpl=implode("' OR eidikothtes_id LIKE '",$tomeas);
						mysqli_select_db($con,"eksoplismos");
						mysqli_query($con,"SET NAMES utf8");
						$q2= "SELECT *
							FROM tomeis INNER JOIN eidikothtes ON tomeis.tomeis_id=eidikothtes.tomeis_id
							WHERE eidikothtes_id LIKE '".$tomeasImpl."'";
						$r2=mysqli_query($con,$q2);
						while($d2=mysqli_fetch_assoc($r2)){
							$txt.='<li>'.$d2['tomeis_name'].'/'.$d2['eidikothtes_name'].'</li>';
						}
					}
			$txt.='
				</td>
				<td>'.($d['biblia_sxolia']==null?'&nbsp;':$d['biblia_sxolia']).'</td>
				<td>'.($d['biblia_eidosTitlou']==null?'&nbsp;':$d['biblia_eidosTitlou']).'</td>
				<td>'.((($d['biblia_eikonografimeno'])==1)?("Ναι"):("Όχι")).'</td>
				<td><a href="biblia.php?mode=edit&id='.$d['biblia_id'].'"><img src="images/edit_foto.png"/></a></td>
			</tr>
		';
	}
	$txt.='</table>
	</div>
	';
	return $txt;
}
function load_bibliaReg(){
	GLOBAL $con;
	$txt='
		<div class="container_sample">
		<h1 class="headlines">Εισαγωγή Βιβλίου</h1>
		<form style="margin-top:20px;" action="biblia.php?mode=reg" method="post">
			<table class="entry_forms">
				<tr>
					<td>
						Σχολική Περίοδος
					</td>
					<td>
						<input type="text" name="periodos" value="'.(isset($_POST['periodos'])?$_POST['periodos']:'').'"/>
					</td>
					<td>
						Χρώμα
					</td>
					<td>
						<select name="xrwma"/>
							<option>Επιλέξτε</option>
							<option '.(isset($_POST['xrwma']) && $_POST['xrwma']=='Ασπρόμαυρο'?'selected="selected"':'').' value="Ασπρόμαυρο">Ασπρόμαυρο</option>
							<option '.(isset($_POST['xrwma']) && $_POST['xrwma']=='Έγχρωμο'?'selected="selected"':'').' value="Έγχρωμο">Έγχρωμο</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Ημερομηνία
					</td>
					<td>
						<input type="text" name="date" value="'.(isset($_POST['date'])?$_POST['date']:'').'"/>
					</td>
					<td>
						Συγγραφέας
					</td>
					<td>
						<select name="suggrafeas"/>
							<option>Επιλέξτε</option>';
						mysqli_query($con,"SET NAMES utf8");
						$q="SELECT * FROM suggrafeis
							ORDER BY suggrafeis_epwnymo";
						$r=mysqli_query($con,$q);						
						while($d=mysqli_fetch_assoc($r)){
							$sel="";
							if((isset($_POST['suggrafeas'])) && ($d['suggrafeis_id']==$_POST['suggrafeas']))
								$sel="selected=\"selected\"";
							$txt.='
							<option '.$sel.' value="'.$d['suggrafeis_id'].'">'.$d['suggrafeis_epwnymo'].'&nbsp;'.$d['suggrafeis_onoma'].'</option>
							';
						}
					$txt.='</select>
					</td>
				</tr>
				<tr>
					<td>
						ISBN
					</td>
					<td>
						<input type="text" name="isbn" value="'.(isset($_POST['isbn'])?$_POST['isbn']:'').'"/>
					</td>
					<td valign="top" rowspan="3">
						Τομέας/Ειδικότητα
					</td>
					<td rowspan="3">
						<select style="width:auto;height:auto;" multiple="multiple" size="5" name="tomeas[]"/>';
						mysqli_select_db($con,"eksoplismos");
						mysqli_query($con,"SET NAMES utf8");
						$q2="SELECT *
							FROM tomeis";
						$r2=mysqli_query($con,$q2);
						while($d2=mysqli_fetch_assoc($r2)){
							$txt.='<optgroup label="'.$d2['tomeis_name'].'">';
							$q1="SELECT *
								FROM eidikothtes
								WHERE tomeis_id LIKE '".$d2['tomeis_id']."'";
							$r1=mysqli_query($con,$q1);
							while($d1=mysqli_fetch_assoc($r1)){
								$sel2='';
								if(isset($_POST['tomeas'])){
									for($i=0;$i<count($_POST['tomeas']);$i++){
										if($_POST['tomeas'][$i]==$d1['eidikothtes_id'])
										$sel2='selected="selected"';
									}
								}
								$txt.='<option '.$sel2.' value="'.$d1['eidikothtes_id'].'">'.$d1['eidikothtes_name'].'</option>';
							}	
							$txt.= '</optgroup>';
						}
						$txt.='</select>
					</td>
				</tr>
				<tr>
					<td>
						Τίτλος Βιβλίου
					</td>
					<td>
						<input type="text" name="titlos" value="'.(isset($_POST['titlos'])?$_POST['titlos']:'').'"/><span class="asteriskos">*</span>
					</td>
				</tr>
				<tr>
					<td>
						Διαστάσεις
					</td>
					<td>
						<input type="text" name="diastaseis" value="'.(isset($_POST['diastaseis'])?$_POST['diastaseis']:'').'"/>
					</td>
				</tr>
				<tr>
					<td>
						Σελίδες
					</td>
					<td>
						<input type="text" name="selides" value="'.(isset($_POST['selides'])?$_POST['selides']:'').'"/>
					</td>
					<td rowspan="3" valign="top">
						Σχόλια
					</td>
					<td rowspan="3" valign="top">
						<textarea name="sxolia">'.(isset($_POST['sxolia'])?$_POST['sxolia']:null).'</textarea>
					</td>
				</tr>
				<tr>
					<td>
						Είδος Τίτλου
					</td>
					<td>
						<select name="eidosTitlou"/>
							<option>Επιλέξτε</option>
							<option '.(isset($_POST['eidosTitlou']) && $_POST['eidosTitlou']=='Βιβλίο'?'selected="selected"':'').' value="Βιβλίο">Βιβλίο</option>
							<option '.(isset($_POST['eidosTitlou']) && $_POST['eidosTitlou']=='Ερωτήσεις Πιστοποίησης'?'selected="selected"':'').' value="Ερωτήσεις Πιστοποίησης">Ερωτήσεις Πιστοποίησης</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Εικονογραφημένο
					</td>
					<td>
						<input type="checkbox" name="eikonografimeno" '.(isset($_POST['eikonografimeno']) && $_POST['eikonografimeno']==1?'checked="checked"':'').'/>
					</td>
				</tr>
				<tr>
					<td colspan="4" align="center">
						<input type="submit" value="Εισαγωγή"/>
						<input type="reset" value="Καθαρισμός"/>
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<span style="color:#ff0000;">Τα πεδία με αστερίσκο (*) είναι υποχρεωτικά</span>
					</td>
				</tr>
			</table>
		</form>
		</div>
	';
	return $txt;
}
function load_bibliaEdit(){
	GLOBAL $con;
	mysqli_query($con,"SET NAMES utf8");
	$q="SELECT * 
		FROM biblia
		WHERE biblia_id LIKE '".$_GET['id']."'";
	$r=mysqli_query($con,$q);
	$d=mysqli_fetch_assoc($r);
	$txt='
		<div class="container_sample">
		<h1 class="headlines">Επεξεργασία Βιβλίου</h1>
		<form style="margin-top:20px;" action="biblia.php?mode=edit&id='.$_GET['id'].'" method="post">
			<table class="entry_forms">
				<tr>
					<td>
						Σχολική Περίοδος
					</td>
					<td>
						<input type="text" name="periodos" value="'.$d['biblia_periodos'].'"/>
					</td>
					<td>
						Χρώμα
					</td>
					<td>
						<select name="xrwma"/>
							<option '.($d['biblia_xrwma']=='Ασπρόμαυρο'?'selected="selected"':'').' value="Ασπρόμαυρο">Ασπρόμαυρο</option>
							<option '.($d['biblia_xrwma']=='Έγχρωμο'?'selected="selected"':'').' value="Έγχρωμο">Έγχρωμο</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Ημερομηνία
					</td>
					<td>
						<input type="text" name="date" value="'.$d['biblia_hmeromhnia'].'"/>
					</td>
					<td>
						Συγγραφέας
					</td>
					<td>
						<select name="suggrafeas">';
						mysqli_query($con,"SET NAMES utf8");
						$query="SELECT * FROM suggrafeis";
						$res=mysqli_query($con,$query);						
						while($data=mysqli_fetch_assoc($res)){
							$txt.='
							<option '.($data['suggrafeis_id']==$d['suggrafeis_id']?'selected="selected"':'').' value="'.$data['suggrafeis_id'].'">'.$data['suggrafeis_epwnymo'].'&nbsp;'.$data['suggrafeis_onoma'].'</option>
							';
						}
					$txt.='</select>
					</td>
				</tr>
				<tr>
					<td>
						ISBN
					</td>
					<td>
						<input type="text" name="isbn" value="'.$d['biblia_isbn'].'"/>
					</td>
					<td valign="top" rowspan="3">
						Τομέας/Ειδικότητα
					</td>
					<td rowspan="3">
						<select style="width:auto;height:auto;" multiple="multiple" size="5" name="tomeas[]"/>';
						mysqli_select_db($con,"eksoplismos");
						mysqli_query($con,"SET NAMES utf8");
						$q2="SELECT *
							FROM tomeis";
						$r2=mysqli_query($con,$q2);
						while($d2=mysqli_fetch_assoc($r2)){
							$txt.='<optgroup label="'.$d2['tomeis_name'].'">';
							$q1="SELECT *
								FROM eidikothtes
								WHERE tomeis_id LIKE '".$d2['tomeis_id']."'";
							$r1=mysqli_query($con,$q1);
							while($d1=mysqli_fetch_assoc($r1)){
								$sel='';
								$tomeas=explode('_',$d['tomeisEidikotites_id']);
								for($i=0;$i<count($tomeas);$i++){
									if(isset($tomeas[$i])){
										if($tomeas[$i]==$d1['eidikothtes_id'])
										$sel='selected="selected"';
									}
								}
								$txt.='<option '.$sel.' value="'.$d1['eidikothtes_id'].'">'.$d1['eidikothtes_name'].'</option>';
							}
							$txt.= '</optgroup>';
						}
						$txt.='</select>
					</td>
				</tr>
				<tr>
					<td>
						Τίτλος Βιβλίου
					</td>
					<td>
						<input type="text" name="titlos" value="'.$d['biblia_name'].'"/>
					</td>
				</tr>
				<tr>
					<td>
						Διαστάσεις
					</td>
					<td>
						<input type="text" name="diastaseis" value="'.$d['biblia_diastaseis'].'"/>
					</td>
				</tr>
				<tr>
					<td>
						Σελίδες
					</td>
					<td>
						<input type="text" name="selides" value="'.$d['biblia_selides'].'"/>
					</td>
					<td rowspan="3" valign="top">
						Σχόλια
					</td>
					<td rowspan="3" valign="top">
						<textarea name="sxolia">'.$d['biblia_sxolia'].'</textarea>
					</td>
				</tr>
				<tr>
					<td>
						Είδος Τίτλου
					</td>
					<td>
						<select name="eidosTitlou"/>
							<option '.(isset($d['biblia_eidosTitlou']) && $d['biblia_eidosTitlou']=='Βιβλίο'?'selected="selected"':'').' value="Βιβλίο">Βιβλίο</option>
							<option '.(isset($d['biblia_eidosTitlou']) && $d['biblia_eidosTitlou']=='Ερωτήσεις Πιστοποίησης'?'selected="selected"':'').' value="Ερωτήσεις Πιστοποίησης">Ερωτήσεις Πιστοποίησης</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Εικονογραφημένο
					</td>
					<td>
						<input type="checkbox" name="eikonografimeno" '.($d['biblia_eikonografimeno']==1?"checked='checked'":'').'/>
					</td>
				</tr>
				<tr>
					<td colspan="4" align="center">
						<input type="submit" value="Εισαγωγή"/>
						<input type="reset" value="Καθαρισμός"/>
					</td>
				</tr>
			</table>
		</form>
		</div>
	';
	return $txt;
}
function load_ekdotikoiPro(){
	GLOBAL $con;
	mysqli_query($con,"SET NAMES utf8");
	$q="SELECT * FROM ekdotikoi";
	if(!empty($_POST['ekdotikos']))
		$q.=" WHERE ekdotikoi_name LIKE '%".$_POST['ekdotikos']."%'";
	$q.=" ORDER BY ekdotikoi_name ASC";
	$r=mysqli_query($con,$q);
	$txt='
	<div class="container_sample">
		<h1 class="headlines">Λίστα Εκδοτικών Οίκων <span style="font-weight:normal">('.mysqli_num_rows($r).')</span></h1>
		<div class="addContainer">
		<a href="ekdotikoi.php?mode=reg"><img align="absmiddle" src="images/add_btn.png"/>
			<span>Προσθήκη νέου εκδοτικού</span>
		</a>
		</div>
		<form style="margin:10px 0 5px 0;" action="ekdotikoi.php" method="post" id="apo_form">
			<input type="text" name="ekdotikos" id="ekdotikos" value="" AUTOCOMPLETE="off" title="Πληκτρολογήστε την επωνυμία του εκδοτικού"/>
			<input type="submit" name="search_btn" id="search_btn" value="Αναζήτηση"/>
		</form>
		<table class="tables">
			<tr>
				<th>
					Επωνυμία
				</th>
				<th>
					Επώνυμο
				</th>
				<th>
					Όνομα
				</th>
				<th>
					Διεύθυνση
				</th>
				<th>
					Τ.Κ
				</th>
				<th>
					Πόλη
				</th>
				<th>
					Τηλέφωνο Σταθερό
				</th>
				<th>
					Τηλέφωνο Κινητό
				</th>
				<th>
					email
				</th>
				<th>
					ΑΦΜ
				</th>
				<th>
					ΔΟΥ
				</th>
				<th>
					Σχόλια
				</th>
				<th>
					Ενέργειες
				</th>
			</tr>
		';
	while($d=mysqli_fetch_assoc($r)){
		$txt.='
			<tr>
				<td>'.($d['ekdotikoi_name']==null?'&nbsp;':$d['ekdotikoi_name']).'</td>
				<td>'.($d['ekdotikoi_epwnymo']==null?'&nbsp;':$d['ekdotikoi_epwnymo']).'</td>
				<td>'.($d['ekdotikoi_onoma']==null?'&nbsp;':$d['ekdotikoi_onoma']).'</td>
				<td>'.($d['ekdotikoi_dieuthinsi']==null?'&nbsp;':$d['ekdotikoi_dieuthinsi']).'</td>
				<td>'.($d['ekdotikoi_tk']==null?'&nbsp;':$d['ekdotikoi_tk']).'</td>
				<td>'.($d['ekdotikoi_poli']==null?'&nbsp;':$d['ekdotikoi_poli']).'</td>
				<td>'.($d['ekdotikoi_stathero']==null?'&nbsp;':$d['ekdotikoi_stathero']).'</td>
				<td>'.($d['ekdotikoi_kinito']==null?'&nbsp;':$d['ekdotikoi_kinito']).'</td>
				<td>'.($d['ekdotikoi_email']==null?'&nbsp;':$d['ekdotikoi_email']).'</td>
				<td>'.($d['ekdotikoi_afm']==null?'&nbsp;':$d['ekdotikoi_afm']).'</td>
				<td>'.($d['ekdotikoi_doy']==null?'&nbsp;':$d['ekdotikoi_doy']).'</td>
				<td>'.($d['ekdotikoi_sxolia']==null?'&nbsp;':$d['ekdotikoi_sxolia']).'</td>
				<td><a href="ekdotikoi.php?mode=edit&id='.$d['ekdotikoi_id'].'"><img src="images/edit_foto.png"/></a></td>
			</tr>
		';
	}
	$txt.='</table>
	</div>
	';
	return $txt;
}
function load_ekdotikoiReg(){
	$txt='
		<div class="container_sample">
		<h1 class="headlines">Εισαγωγή Εκδοτικού Οίκου</h1>
		<form style="margin-top:20px;" action="ekdotikoi.php?mode=reg" method="post">
			<table class="entry_forms">
				<tr>
					<td>
						Επωνυμία
					</td>
					<td>
						<input type="text" name="epwnymia" value="'.(isset($_POST['epwnymia'])?$_POST['epwnymia']:'').'"/><span class="asteriskos">*</span>
					</td>
					<td>
						Τηλέφωνο Κινητό
					</td>
					<td>
						<input type="text" name="kinito" value="'.(isset($_POST['kinito'])?$_POST['kinito']:'').'"/>
					</td>
				</tr>
				<tr>
					<td>
						Επώνυμο
					</td>
					<td>
						<input type="text" name="epwnymo" value="'.(isset($_POST['epwnymo'])?$_POST['epwnymo']:'').'"/>
					</td>
					<td>
						Τηλέφωνο Σταθερό
					</td>
					<td>
						<input type="text" name="stathero" value="'.(isset($_POST['stathero'])?$_POST['stathero']:'').'"/>
					</td>
					
				</tr>
				<tr>
					<td>
						Όνομα
					</td>
					<td>
						<input type="text" name="onoma" value="'.(isset($_POST['onoma'])?$_POST['onoma']:'').'"/>
					</td>
					<td>
						Α.Φ.Μ
					</td>
					<td>
						<input type="text" name="afm" value="'.(isset($_POST['afm'])?$_POST['afm']:'').'"/>
					</td>
					
				</tr>
				<tr>
					<td>
						Πόλη
					</td>
					<td>
						<input type="text" name="poli" value="'.(isset($_POST['poli'])?$_POST['poli']:'').'"/>
					</td>
					<td>
						Δ.Ο.Υ
					</td>
					<td>
						<input type="text" name="doy" value="'.(isset($_POST['doy'])?$_POST['doy']:'').'"/>
					</td>
					
				</tr>
				<tr>
					<td>
						Τ.Κ.
					</td>
					<td>
						<input type="text" name="tk" value="'.(isset($_POST['tk'])?$_POST['tk']:'').'"/>
					</td>
					<td>
						email
					</td>
					<td>
						<input type="text" name="email" value="'.(isset($_POST['email'])?$_POST['email']:'').'"/>
					</td>
				</tr>
				<tr valign="top">
					<td>
						Διεύθυνση
					</td>
					<td>
						<input type="text" name="dieuthinsi" value="'.(isset($_POST['dieuthinsi'])?$_POST['dieuthinsi']:'').'"/>
					</td>
					<td>
						Σχόλια
					</td>
					<td>
						<textarea name="sxolia"/>'.(isset($_POST['sxolia'])?$_POST['sxolia']:'&nbsp;').'</textarea>
					</td>
				</tr>
				<tr>
					<td colspan="4" align="center">
						<input type="submit" value="Εισαγωγή"/>
						<input type="reset" value="Καθαρισμός"/>
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<span style="color:#ff0000;">Τα πεδία με αστερίσκο (*) είναι υποχρεωτικά</span>
					</td>
				</tr>
			</table>
		</form>
		</div>
	';
	return $txt;
}
function load_ekdotikoiEdit(){
	GLOBAL $con;
	mysqli_query($con,"SET NAMES utf8");
	$q="SELECT * 
		FROM ekdotikoi
		WHERE ekdotikoi_id LIKE '".$_GET['id']."'";
	$r=mysqli_query($con,$q);
	$d=mysqli_fetch_assoc($r);
	$txt='
		<div class="container_sample">
		<h1 class="headlines">Επεξεργασία Εκδοτικού Οίκου</h1>
		<form style="margin-top:20px;" action="ekdotikoi.php?mode=edit&id='.$_GET['id'].'" method="post">
			<table class="entry_forms">
				<tr>
					<td>
						Επωνυμία
					</td>
					<td>
						<input type="text" name="epwnymia" value="'.$d['ekdotikoi_name'].'" onfocus="this.blur()"/>
					</td>
					<td>
						Τηλέφωνο Κινητό
					</td>
					<td>
						<input type="text" name="kinito" value="'.$d['ekdotikoi_kinito'].'"/>
					</td>
				</tr>
				<tr>
					<td>
						Επώνυμο
					</td>
					<td>
						<input type="text" name="epwnymo" value="'.$d['ekdotikoi_epwnymo'].'"/>
					</td>
					<td>
						Τηλέφωνο Σταθερό
					</td>
					<td>
						<input type="text" name="stathero" value="'.$d['ekdotikoi_stathero'].'"/>
					</td>
					
				</tr>
				<tr>
					<td>
						Όνομα
					</td>
					<td>
						<input type="text" name="onoma" value="'.$d['ekdotikoi_onoma'].'"/>
					</td>
					<td>
						Α.Φ.Μ
					</td>
					<td>
						<input type="text" name="afm" value="'.$d['ekdotikoi_afm'].'"/>
					</td>
					
				</tr>
				<tr>
					<td>
						Πόλη
					</td>
					<td>
						<input type="text" name="poli" value="'.$d['ekdotikoi_poli'].'"/>
					</td>
					<td>
						Δ.Ο.Υ
					</td>
					<td>
						<input type="text" name="doy" value="'.$d['ekdotikoi_doy'].'"/>
					</td>
					
				</tr>
				<tr>
					<td>
						Τ.Κ.
					</td>
					<td>
						<input type="text" name="tk" value="'.$d['ekdotikoi_tk'].'"/>
					</td>
					<td>
						email
					</td>
					<td>
						<input type="text" name="email" value="'.$d['ekdotikoi_email'].'"/>
					</td>
				</tr>
				<tr valign="top">
					<td>
						Διεύθυνση
					</td>
					<td>
						<input type="text" name="dieuthinsi" value="'.$d['ekdotikoi_dieuthinsi'].'"/>
					</td>
					<td>
						Σχόλια
					</td>
					<td>
						<textarea name="sxolia"/>'.$d['ekdotikoi_sxolia'].'</textarea>
					</td>
				</tr>
				<tr>
					<td colspan="4" align="center">
						<input type="submit" value="Εισαγωγή"/>
						<input type="reset" value="Καθαρισμός"/>
					</td>
				</tr>
			</table>
		</form>
		</div>
	';
	return $txt;
}
function load_pwliseisPro(){
	GLOBAL $con;
	mysqli_query($con,"SET NAMES utf8");
	$q="SELECT *
		FROM pwliseis INNER JOIN biblia ON pwliseis.biblia_id=biblia.biblia_id";
	if(!empty($_POST['biblio']))
		$q.=" WHERE biblia_name LIKE '%".$_POST['biblio']."%'";
	$q.=" ORDER BY biblia_name ASC";
	$r=mysqli_query($con,$q);
	$txt='
	<div class="container_sample">
		<h1 class="headlines">Λίστα Πωλήσεων<span style="font-weight:normal">('.mysqli_num_rows($r).')</span></h1>
		<div class="addContainer">
		<a href="pwliseis.php?mode=reg"><img align="absmiddle" src="images/add_btn.png"/>
			<span>Προσθήκη νέας πώλησης</span>
		</a>
		</div>
		<form style="margin:10px 0 5px 0;" action="pwliseis.php" method="post" id="apo_form">
			<input type="text" name="biblio" id="biblio" value="" AUTOCOMPLETE="off" title="Πληκτρολογήστε τον τίτλο του βιβλίου"/>
			<input type="submit" name="search_btn" id="search_btn" value="Αναζήτηση"/>
		</form>
		<table class="tables">
			<tr>
				<th>
					Αριθμός Απόδειξης
				</th>
				<th>
					Ημερομηνία
				</th>
				<th>
					Τίτλος Βιβλίου
				</th>
				<th>
					Ονοματεπώνυμο Πελάτη
				</th>
				<th>
					Τεμάχια
				</th>
				<th>
					Τιμή
				</th>
				<th>
					Τελική Αξία
				</th>
				<th>
					Τύπος Συναλλαγής
				</th>
				<th>
					Ενέργειες
				</th>
			</tr>
		';
	while($d=mysqli_fetch_assoc($r)){
		$txt.='
			<tr>
				<td>'.($d['pwliseis_apodeiksi']==null?'&nbsp;':$d['pwliseis_apodeiksi']).'</td>
				<td>'.($d['pwliseis_hmerominia']==null?'&nbsp;':$d['pwliseis_hmerominia']).'</td>
				<td>'.($d['biblia_name']==null?'&nbsp;':$d['biblia_name']).'</td>
				<td>'.($d['pwliseis_pelatis']==null?'&nbsp;':$d['pwliseis_pelatis']).'</td>
				<td>'.($d['pwliseis_temaxia']==null?'&nbsp;':$d['pwliseis_temaxia']).'</td>
				<td>'.($d['pwliseis_timi']==null?'&nbsp;':$d['pwliseis_timi']).'</td>
				<td>'.($d['pwliseis_telikiAxia']==null?'&nbsp;':$d['pwliseis_telikiAxia']).'</td>
				<td>'.($d['pwliseis_tiposSynallagis']==null?'&nbsp;':$d['pwliseis_tiposSynallagis']).'</td>
				<td><a href="pwliseis.php?mode=edit&id='.$d['pwliseis_id'].'"><img src="images/edit_foto.png"/></a></td>
			</tr>
		';
	}
	$txt.='</table>
	</div>
	';
	return $txt;
}
function load_pwliseisReg(){
	GLOBAL $con;
	mysqli_query($con,"SET NAMES utf8");
	$txt='
		<div class="container_sample">
		<h1 class="headlines">Πωλήσεις</h1>
		<form style="margin-top:20px;" action="pwliseis.php?mode=reg" method="post">
			<table class="entry_forms">
				<tr>
					<td>
						Αρ. Απόδειξης
					</td>';
						$q="SELECT pwliseis_apodeiksi
							FROM pwliseis
							ORDER BY pwliseis_apodeiksi DESC LIMIT 0,1";
						$txt.='
					<td>
						<input type="text" name="apodeiksi" value="'.(mysqli_num_rows(mysqli_query($con,$q))+1).'" onfocus="this.blur()"/>
					</td>
				</tr>
				<tr>
					<td>
						Ημερομηνία
					</td>
					<td>
						<input type="text" name="date" value="'.(isset($_POST['date'])?$_POST['date']:'').'"/>
					</td>
				</tr>
				<tr>
					<td>
						Τίτλος Βιβλίου
					</td>
					<td onBlur="document.getElementById(\'titlosSearch\').style.display=\'none\'">
						<input type="text" name="titlos" id="titlos" onKeyup="ajax_call(this.value)" value="'.(isset($_POST['titlos'])?$_POST['titlos']:'').'" AUTOCOMPLETE="off"/>
						<input type="hidden" name="titlos_hid" id="titlos_hid"/>
						<ul name="titlosSearch" class="liveSearch" id="titlosSearch">
						</ul>
					</td>
				</tr>
				<tr>
					<td>
						Ονοματεπώνυμο Πελάτη
					</td>
					<td>
						<input type="text" name="pelatis" value="'.(isset($_POST['pelatis'])?$_POST['pelatis']:'').'"/>
					</td>
				</tr>
				<tr>
					<td>
						Τεμάχια
					</td>
					<td>
						<input style="width:50px;" type="text" name="temaxia" value="'.(isset($_POST['temaxia'])?$_POST['temaxia']:'').'"/>
					</td>
				</tr>
				<tr>
					<td>
						Τιμή
					</td>
					<td>
						<input style="width:50px;" type="text" name="timi" value="'.(isset($_POST['timi'])?$_POST['timi']:'').'"/>&euro;
					</td>
				</tr>
				<tr>
					<td>
						Τελική Αξία
					</td>
					<td>
						<input style="width:50px;" type="text" name="aksia" value="'.(isset($_POST['aksia'])?$_POST['aksia']:'').'"/>&euro;
					</td>
				</tr>
				<tr>
					<td>
						Τύπος Συναλλαγής
					</td>
					<td>
						<select name="typos">
							<option>Επιλέξτε</option>
							<option '.(isset($_POST['typos']) && $_POST['typos']=='Πώληση'?'selected="selected"':'').' value="Πώληση">Πώληση</option>
							<option '.(isset($_POST['typos']) && $_POST['typos']=='Παραχώρηση'?'selected="selected"':'').' value="Παραχώρηση">Παραχώρηση</option>';
						$txt.='
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="4" align="center">
						<input type="submit" value="ΟΚ"/>
						<input type="reset" value="Καθαρισμός"/>
					</td>
				</tr>
			</table>
		</form>
		</div>
	';
	return $txt;
}
function load_pwliseisEdit(){
	GLOBAL $con;
	mysqli_query($con,"SET NAMES utf8");
	$q="SELECT * 
		FROM pwliseis INNER JOIN biblia ON pwliseis.biblia_id=biblia.biblia_id
		WHERE pwliseis_id LIKE '".$_GET['id']."'";
	$r=mysqli_query($con,$q);
	$d=mysqli_fetch_assoc($r);
	$txt='
		<div class="container_sample">
		<h1 class="headlines">Επεξεργασία Πώλησης</h1>
		<form style="margin-top:20px;" action="pwliseis.php?mode=edit?id='.$_GET['id'].'" method="post">
			<table class="entry_forms">
				<tr>
					<td>
						Αρ. Απόδειξης
					</td>
					<td>
						<input type="text" name="apodeiksi" value="'.$d['pwliseis_apodeiksi'].'" onfocus="this.blur()"/>
					</td>
				</tr>
				<tr>
					<td>
						Ημερομηνία
					</td>
					<td>
						<input type="text" name="date" value="'.$d['pwliseis_hmerominia'].'"/>
					</td>
				</tr>
				<tr>
					<td>
						Τίτλος Βιβλίου
					</td>
					<td>
						<input type="text" name="titlos" value="'.$d['biblia_name'].'"/>
					</td>
				</tr>
				<tr>
					<td>
						Ονοματεπώνυμο Πελάτη
					</td>
					<td>
						<input type="text" name="pelatis" value="'.$d['pwliseis_pelatis'].'"/>
					</td>
				</tr>
				<tr>
					<td>
						Τεμάχια
					</td>
					<td>
						<input style="width:50px;" type="text" name="temaxia" value="'.$d['pwliseis_temaxia'].'"/>
					</td>
				</tr>
				<tr>
					<td>
						Τιμή
					</td>
					<td>
						<input style="width:50px;" type="text" name="timi" value="'.$d['pwliseis_timi'].'"/>&euro;
					</td>
				</tr>
				<tr>
					<td>
						Τελική Αξία
					</td>
					<td>
						<input style="width:50px;" type="text" name="aksia" value="'.$d['pwliseis_telikiAxia'].'"/>&euro;
					</td>
				</tr>
				<tr>
					<td>
						Τύπος Συναλλαγής
					</td>
					<td>
						<select name="typos">
							<option '.($d['pwliseis_tiposSynallagis']=='Πώληση'?'selected="selected"':'').' value="Πώληση">Πώληση</option>
							<option '.($d['pwliseis_tiposSynallagis']=='Παραχώρηση'?'selected="selected"':'').' value="Παραχώρηση">Παραχώρηση</option>';
						$txt.='
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="4" align="center">
						<input type="submit" value="Μεταβολή"/>
						<input type="reset" value="Καθαρισμός"/>
					</td>
				</tr>
			</table>
		</form>
		</div>
	';
	return $txt;
}
function load_paraggeliesPro(){
	GLOBAL $con;
	mysqli_query($con,"SET NAMES utf8");
	$q="SELECT *
		FROM paraggelies
		INNER JOIN biblia ON paraggelies.biblia_id=biblia.biblia_id
		INNER JOIN ekdotikoi ON paraggelies.ekdotikoi_id=ekdotikoi.ekdotikoi_id
		INNER JOIN suggrafeis ON paraggelies.suggrafeis_id=suggrafeis.suggrafeis_id";
	if(!empty($_POST['parSearch']))
		$q.=" WHERE biblia_name LIKE '%".$_POST['parSearch']."%'";
	if(isset($_GET['sortKat']) && isset($_GET['sort']))
		$q.=" ORDER BY ".$_GET['sortKat']." ".$_GET['sort'];
	else
		$q.=" ORDER BY biblia_name ASC";
	$r=mysqli_query($con,$q);
	$txt='
			<div id="paraggeliesProContainer">
				<h1 class="headlines" style="float:left;">Παραγγελίες Βιβλίων</h1>
				<div id="paraggeliesHeader">
					<div id="addParBtn">
						<span id="addBtn">
							<img align="absmiddle" src="images/add_btn.png"/>
							Προσθήκη Νέας Παραγγελίας
						</span>
					</div>
					<div id="omadErg">
						<span id="omadErgBtn">
							Ομαδικές Εργασίες
							<img align="absmiddle" src="images/icon-down.png"/>
						</span>
						<ul id="omadErgList">
							<a href="#"><li>Προς Έγκριση Πληρωμής</li></a>
							<a href="#"><li>Πληρωμή</li></a>
							<a href="#"><li>Διαγραφή</li></a>
							<a href="#"><li>Παραγγελίες Προς Ταμείο</li></a>
						</ul>
					</div>
					<div id="parSearch">
						<form action="paraggelies.php" method="post">
							<input title="Αναζήτηση Τίτλου Βιβλίου" type="text" name="parSearch"/>
							<input type="submit" value="Αναζήτηση"/>
						</form>
					</div>
					<span id="parSynSearch">
						<a href="#">Σύνθετη Αναζήτηση</a>
					</span>
				</div>
			</div>
			<span id="opacityBlack">&nbsp;</span>
			<div id="addParBox">
				<form style="margin-left:25px;" action="paraggelies.php" method="post">
					<h1 class="headlines">Προσθήκη Παραγγελίας</h1>
					<table class="entry_forms">
						<tr>
							<td>
								Ημερομηνία
							</td>
							<td>
								<input type="text"/ name="date" value="'.date('d/m/Y').'"/>
							</td>
						</tr>
						<tr>
							<td>
								Τίτλος Βιβλίου
							</td>
							<td>
								<select name="titlos">
									<option>Επιλέξτε</option>';
									$q2="SELECT *
										FROM biblia
										ORDER BY biblia_name ASC";
									$r2=mysqli_query($con,$q2);
									while($d2=mysqli_fetch_assoc($r2)){
										$txt.='
											<option value="'.$d2['biblia_id'].'">
												'.$d2['biblia_name'].'
											</option>
										';
									}
								$txt.='</select>
							</td>
						</tr>
						<tr>
							<td>
								Εκδοτικός
							</td>
							<td>
								<select name="ekdotikos">
									<option>Επιλέξτε</option>';
									$q1="SELECT *
										FROM ekdotikoi
										ORDER BY ekdotikoi_name ASC";
									$r1=mysqli_query($con,$q1);
									while($d1=mysqli_fetch_assoc($r1)){
										$txt.='
											<option value="'.$d1['ekdotikoi_id'].'">'.$d1['ekdotikoi_name'].'</option>
										';
									}
								$txt.='</select>
							</td>
						</tr>
						<tr>
							<td align="center" colspan="2">
								<input type="submit" value="Προσθήκη">
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div id="titlosTableContainer">
				<form method="post">
				<table id="parTable1" style="width:180px;margin-top:20px;border-right:solid 2px #666;float:left;" class="parTablePro">
					<tr>
						<th>
							<input type="checkbox" id="titlosSygAll" name="titlosSygAll"/>
							<a href="paraggelies.php?sortKat=biblia_name&sort='.(isset($_GET['sort']) && $_GET['sort']=='ASC'?'DESC':'ASC').'">
								<span style="width:120px;float:left;">
									Τίτλος Βιβλίου
									<span style="font-size:11px;">Συγγραφέας</span>
								</span>
								<img style="margin-top:7px;" align="absmiddle" src="images/icon-'.(isset($_GET['sortKat']) && ($_GET['sortKat']=='biblia_name') && ($_GET['sort']=='DESC')?'down':'up').(isset($_GET['sortKat']) && ($_GET['sortKat']=='biblia_name')?'':'-red').'.png"/>
							</a>
						</th>
					</tr>';
					$aa=0; $color="";
					while($d=mysqli_fetch_assoc($r)){
					if($aa++%2==0)
							$color="#e7ecf7";
						else
							$color="#ffffff";
					$txt.='<tr bgcolor="'.$color.'">
						<td>
							<input type="checkbox" class="titlosSyg" name="titlosSyg'.$d['paraggelies_id'].'"/>
							<a href="#">
								<span style="width:140px;float:left;">
								'.$d['biblia_name'].'
								<span style="width:150px;font-size:11px;float:left;">'.$d['suggrafeis_epwnymo'].'&nbsp;'.$d['suggrafeis_onoma'].'</span>
								</span>
							</a>
						</td>
					</tr>';
					}
					mysqli_data_seek($r,0);
				$txt.='</table></form>
			</div>
			<div id="animateTableContainer">
				<span class="animeArrows" style="left:5px;" id="parTableBtnLeft">
					<img id="arrowLeftBtn" src="images/arrow_left_disabled.png"/>
					<img id="arrowLeftBtnStart" src="images/arrow_start_left_disabled.png"/>
				</span>
				<span class="animeArrows" style="right:5px;" id="parTableBtnRight">
					<img id="arrowRightBtn" src="images/arrow_right_disabled.png"/>
					<img id="arrowRightBtnEnd" src="images/arrow_end_right_disabled.png"/>
				</span>
				<table id="parTableAnim" style="position:relative;margin-top:20px;margin-left:0px;width:2120px;float:left;" class="parTablePro">
					<tr>
						<th>
							<a href="paraggelies.php?sortKat=paraggelies_kataxwrisiDate&sort='.(isset($_GET['sort']) && $_GET['sort']=='ASC'?'DESC':'ASC').'">
								Ημερομηνία<img align="absmiddle" src="images/icon-'.(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_kataxwrisiDate') && ($_GET['sort']=='DESC')?'down':'up').(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_kataxwrisiDate')?'':'-red').'.png"/>
							</a>
						</th>
						<th>
							<a href="paraggelies.php?sortKat=ekdotikoi_name&sort='.(isset($_GET['sort']) && $_GET['sort']=='ASC'?'DESC':'ASC').'">
								Εκδοτικός<img align="absmiddle" src="images/icon-'.(isset($_GET['sortKat']) && ($_GET['sortKat']=='ekdotikoi_name') && ($_GET['sort']=='DESC')?'down':'up').(isset($_GET['sortKat']) && ($_GET['sortKat']=='ekdotikoi_name')?'':'-red').'.png"/>
							</a>
						</th>
						<th>
							<a href="paraggelies.php?sortKat=paraggelies_paralaviWordDate&sort='.(isset($_GET['sort']) && $_GET['sort']=='ASC'?'DESC':'ASC').'" title="Παραλαβή Αρχείου Word">
								Παρ. Word<img align="absmiddle" src="images/icon-'.(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_paralaviWordDate') && ($_GET['sort']=='DESC')?'down':'up').(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_paralaviWordDate')?'':'-red').'.png"/>
							</a>
						</th>
						<th>
							<a href="paraggelies.php?sortKat=paraggelies_temaxia&sort='.(isset($_GET['sort']) && $_GET['sort']=='ASC'?'DESC':'ASC').'">
								Τεμάχια<img align="absmiddle" src="images/icon-'.(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_temaxia') && ($_GET['sort']=='DESC')?'down':'up').(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_temaxia')?'':'-red').'.png"/>
							</a>
						</th>
						<th>
							<a href="paraggelies.php?sortKat=paraggelies_apostoliWordEkdDate&sort='.(isset($_GET['sort']) && $_GET['sort']=='ASC'?'DESC':'ASC').'" title="Αποστολή σε Εκδοτικό">
								Προς Εκδ.<img align="absmiddle" src="images/icon-'.(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_apostoliWordEkdDate') && ($_GET['sort']=='DESC')?'down':'up').(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_apostoliWordEkdDate')?'':'-red').'.png"/>
							</a>
						</th>
						<th>
							<a href="paraggelies.php?sortKat=paraggelies_paralaviPdfDate&sort='.(isset($_GET['sort']) && $_GET['sort']=='ASC'?'DESC':'ASC').'" title="Επιστροφή από Εκδοτικό">
								Από Εκδ.<img align="absmiddle" src="images/icon-'.(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_paralaviPdfDate') && ($_GET['sort']=='DESC')?'down':'up').(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_paralaviPdfDate')?'':'-red').'.png"/>
							</a>
						</th>
						<th>
							<a href="paraggelies.php?sortKat=paraggelies_checkSuggrafeaDate&sort='.(isset($_GET['sort']) && $_GET['sort']=='ASC'?'DESC':'ASC').'" title="Έλεγχος από Συγγραφέα">
								Έλεγχ.Συγγ.<img align="absmiddle" src="images/icon-'.(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_checkSuggrafeaDate') && ($_GET['sort']=='DESC')?'down':'up').(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_checkSuggrafeaDate')?'':'-red').'.png"/>
							</a>
						</th>
						<th>
							<a href="paraggelies.php?sortKat=paraggelies_egkrisiPdf&sort='.(isset($_GET['sort']) && $_GET['sort']=='ASC'?'DESC':'ASC').'" title="Έγκριση PDF προς Εκδοτικό">
								Έγκρ.PDF<img align="absmiddle" src="images/icon-'.(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_egkrisiPdf') && ($_GET['sort']=='DESC')?'down':'up').(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_egkrisiPdf')?'':'-red').'.png"/>
							</a>
						</th>
						<th>
							<a href="paraggelies.php?sortKat=paraggelies_paralaviRahis&sort='.(isset($_GET['sort']) && $_GET['sort']=='ASC'?'DESC':'ASC').'" title="Παραλαβή Ράχης">
								Παρ.Ράχης<img align="absmiddle" src="images/icon-'.(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_paralaviRahis') && ($_GET['sort']=='DESC')?'down':'up').(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_paralaviRahis')?'':'-red').'.png"/>
							</a>
						</th>
						<th>
							<a href="paraggelies.php?sortKat=paraggelies_aitisiTypografeioDate&sort='.(isset($_GET['sort']) && $_GET['sort']=='ASC'?'DESC':'ASC').'" title="Αίτηση προς Εθνικό Τυπογραφείο">
								Αίτ. Ε.Τ.<img align="absmiddle" src="images/icon-'.(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_aitisiTypografeioDate') && ($_GET['sort']=='DESC')?'down':'up').(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_aitisiTypografeioDate')?'':'-red').'.png"/>
							</a>
						</th>
						<th>
							<a href="paraggelies.php?sortKat=paraggelies_isbn&sort='.(isset($_GET['sort']) && $_GET['sort']=='ASC'?'DESC':'ASC').'" title="Παραλαβή ISBN">
								Παρ. ISBN<img align="absmiddle" src="images/icon-'.(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_isbn') && ($_GET['sort']=='DESC')?'down':'up').(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_isbn')?'':'-red').'.png"/>
							</a>
						</th>
						<th>
							<a href="paraggelies.php?sortKat=paraggelies_aitisiEksofDate&sort='.(isset($_GET['sort']) && $_GET['sort']=='ASC'?'DESC':'ASC').'" title="Ειδοποίηση Γραφίστα για Εξώφυλλο">
								Ειδ.Γραφ.<br>Εξωφ.<img align="absmiddle" src="images/icon-'.(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_aitisiEksofDate') && ($_GET['sort']=='DESC')?'down':'up').(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_aitisiEksofDate')?'':'-red').'.png"/>
							</a>
						</th>
						<th>
							<a href="paraggelies.php?sortKat=paraggelies_paralaviEksofDate&sort='.(isset($_GET['sort']) && $_GET['sort']=='ASC'?'DESC':'ASC').'" title="Παραλαβή Εξώφυλλου από Γραφίστα">
								Παρ.Εξωφ.<br>Γραφ.<img align="absmiddle" src="images/icon-'.(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_paralaviEksofDate') && ($_GET['sort']=='DESC')?'down':'up').(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_paralaviEksofDate')?'':'-red').'.png"/>
							</a>
						</th>
						<th>
							<a href="paraggelies.php?sortKat=paraggelies_apostoliEksofDate&sort='.(isset($_GET['sort']) && $_GET['sort']=='ASC'?'DESC':'ASC').'" title="Αποστολή Εξώφυλλου σε Εκδοτικό">
								Αποστ. Εξωφ.<br>Εκδ.<img align="absmiddle" src="images/icon-'.(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_apostoliEksofDate') && ($_GET['sort']=='DESC')?'down':'up').(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_apostoliEksofDate')?'':'-red').'.png"/>
							</a>
						</th>
						<th>
							<a href="paraggelies.php?sortKat=paraggelies_paralaviBibDate&sort='.(isset($_GET['sort']) && $_GET['sort']=='ASC'?'DESC':'ASC').'" title="Παραλαβή Βιβλίων στο ΙΙΕΚ">
								Παρ. Βιβ.<br>στο ΙΕΚ<img align="absmiddle" src="images/icon-'.(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_paralaviBibDate') && ($_GET['sort']=='DESC')?'down':'up').(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_paralaviBibDate')?'':'-red').'.png"/>
							</a>
						</th>
						<th>
							<a href="paraggelies.php?sortKat=paraggelies_ektyposiSymfonDate&sort='.(isset($_GET['sort']) && $_GET['sort']=='ASC'?'DESC':'ASC').'" title="Εκτύπωση Συμφωνητικού/Ειδοποίηση Συγγραφέα">
								Εκτ. Συμφ.<br>Ειδ. Συγγ.<img align="absmiddle" src="images/icon-'.(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_ektyposiSymfonDate') && ($_GET['sort']=='DESC')?'down':'up').(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_ektyposiSymfonDate')?'':'-red').'.png"/>
							</a>
						</th>
						<th>
							<a href="paraggelies.php?sortKat=paraggelies_ypografiSuggrafeaDate&sort='.(isset($_GET['sort']) && $_GET['sort']=='ASC'?'DESC':'ASC').'" title="Υπογραφή από Συγγραφέα">
								Υπογρ. Συγγ.<img align="absmiddle" src="images/icon-'.(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_ypografiSuggrafeaDate') && ($_GET['sort']=='DESC')?'down':'up').(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_ypografiSuggrafeaDate')?'':'-red').'.png"/>
							</a>
						</th>
						<th>
							<a href="paraggelies.php?sortKat=paraggelies_egkrisiKarantDate&sort='.(isset($_GET['sort']) && $_GET['sort']=='ASC'?'DESC':'ASC').'" title="Έγκριση απο Κο Καρανταλή">
								Έγκρ. Δ/ντη<img align="absmiddle" src="images/icon-'.(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_egkrisiKarantDate') && ($_GET['sort']=='DESC')?'down':'up').(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_egkrisiKarantDate')?'':'-red').'.png"/>
							</a>
						</th>
						<th>
							<a href="paraggelies.php?sortKat=paraggelies_apostoliLogistDate&sort='.(isset($_GET['sort']) && $_GET['sort']=='ASC'?'DESC':'ASC').'" title="Αποστολή στο Λογιστήριο">
								Προς Λογιστ.<img align="absmiddle" src="images/icon-'.(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_apostoliLogistDate') && ($_GET['sort']=='DESC')?'down':'up').(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_apostoliLogistDate')?'':'-red').'.png"/>
							</a>
						</th>
						<th>
							<a href="paraggelies.php?sortKat=paraggelies_pliromiSuggrafeaDate&sort='.(isset($_GET['sort']) && $_GET['sort']=='ASC'?'DESC':'ASC').'" title="Πληρωμή από Ταμείο">
								Πληρ.Ταμείο.<img align="absmiddle" src="images/icon-'.(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_pliromiSuggrafeaDate') && ($_GET['sort']=='DESC')?'down':'up').(isset($_GET['sortKat']) && ($_GET['sortKat']=='paraggelies_pliromiSuggrafeaDate')?'':'-red').'.png"/>
							</a>
						</th>
					</tr>';
					$aa=0;
					while($d=mysqli_fetch_assoc($r)){
						if($aa++%2==0)
							$color="#e7ecf7";
						else
							$color="#ffffff";
						$txt.='
						<tr bgcolor="'.$color.'">
							<td>
								'.$d['paraggelies_kataxwrisiDate'].'
							</td>
							<td>
								'.$d['ekdotikoi_name'].'
							</td>
							<td>
								<form enctype="multipart/form-data" action="paraggelies.php?file=paralaviWordDate" method="post">'.
									(!empty($d['paraggelies_paralaviWordDate'])?$d['paraggelies_paralaviWordDate'].'&nbsp;&nbsp;&nbsp;
									<a style="float:none;" href="paraggelies.php?del=paralaviWordDate&bibId='.$d['biblia_id'].'">
										<img src="images/deleteButton.png" width="12px" />
									</a>':'<span id="content'.$d['paraggelies_id'].'paralaviWordDate"><input type="button" id="parWord'.$d['paraggelies_id'].'" onClick="setValButton(\''.$d['paraggelies_id'].'\',\'paralaviWordDate\')" name="parWord'.$d['paraggelies_id'].'"/></span>
									<input type="file" onChange="this.form.submit();" id="hidFileWord'.$d['paraggelies_id'].'paralaviWordDate" name="files"/>
									<input type="hidden" value="'.$d['biblia_id'].'" name="filesHid"/>').'
								</form>
							</td>
							<td>
								<input type="text" style="width:30px;color:#999;" value="'.($d['paraggelies_temaxia']==0?'':$d['paraggelies_temaxia']).'"  maxlength="3" id="parText'.$d['paraggelies_id'].'temaxia" onClick="setColor(\''.$d['paraggelies_id'].'\',\'temaxia\')" onBlur="unsetColor(\''.$d['paraggelies_id'].'\',\'temaxia\')" name="temText'.$d['paraggelies_id'].'"/>
								<input type="button" onClick="setValText(\'temaxia\',\''.$d['paraggelies_id'].'\')" value="" id="temCheck'.$d['paraggelies_id'].'" name="temCheck'.$d['paraggelies_id'].'"/>
							</td>
							<td id="content'.$d['paraggelies_id'].'apostoliWordEkdDate">
								'.(!empty($d['paraggelies_apostoliWordEkdDate'])?$d['paraggelies_apostoliWordEkdDate']:'<input type="button" id="prosEkd'.$d['paraggelies_id'].'" onClick="setValButtonLogDial(\''.$d['paraggelies_id'].'\')" class="prosEkd'.$d['paraggelies_id'].'" name="prosEkd'.$d['paraggelies_id'].'"/>
								<div class="wordEkdDial" id="wordEkdDial'.$d['paraggelies_id'].'">
									<h1 class="headlines">Προσθήκη Σχόλιου</h1>
									<textarea rows="5" cols="2" id="wordEkdDial'.$d['paraggelies_id'].'txt" name="wordEkdDial'.$d['paraggelies_id'].'txt"></textarea><br/>
									<input type="button" onClick="setValButtonLog(\''.$d['paraggelies_id'].'\',\'apostoliWordEkdDate\',\'apostoliWordEkdDate\',document.getElementById(\'wordEkdDial'.$d['paraggelies_id'].'txt\').value)"/>
								</div>').'
							</td>
							<td>
								<form enctype="multipart/form-data" action="paraggelies.php?file=paralaviPdfDate" method="post">'.
									(!empty($d['paraggelies_paralaviPdfDate'])?$d['paraggelies_paralaviPdfDate'].'&nbsp;&nbsp;&nbsp;
									<a style="float:none;" href="paraggelies.php?del=paralaviPdfDate&bibId='.$d['biblia_id'].'">
										<img src="images/deleteButton.png" width="12px" />
									</a>':'<span id="content'.$d['paraggelies_id'].'paralaviPdfDate"><input type="button" id="apoEkd'.$d['paraggelies_id'].'" onClick="setValButton(\''.$d['paraggelies_id'].'\',\'paralaviPdfDate\')" class="apoEkd'.$d['paraggelies_id'].'" name="apoEkd'.$d['paraggelies_id'].'"/></span>
									<input type="file" onChange="this.form.submit();" id="hidFileWord'.$d['paraggelies_id'].'paralaviPdfDate" name="files"/>
									<input type="hidden" value="'.$d['biblia_id'].'" name="filesHid"/>').'
								</form>
							</td>
							<td id="content'.$d['paraggelies_id'].'checkSuggrafeaDate">
								'.(!empty($d['paraggelies_checkSuggrafeaDate'])?$d['paraggelies_checkSuggrafeaDate']:'<input type="button" id="elegxSug'.$d['paraggelies_id'].'" onClick="setValButton(\''.$d['paraggelies_id'].'\',\'checkSuggrafeaDate\')" class="elegxSug'.$d['paraggelies_id'].'" name="elegxSug'.$d['paraggelies_id'].'"/>').'
							</td>
							<td id="content'.$d['paraggelies_id'].'egkrisiPdf">
								'.(!empty($d['paraggelies_egkrisiPdf'])?$d['paraggelies_egkrisiPdf']:'<input type="button" id="egkrPdf'.$d['paraggelies_id'].'" onClick="setValButton(\''.$d['paraggelies_id'].'\',\'egkrisiPdf\')" class="egkrPdf'.$d['paraggelies_id'].'" name="egkrPdf'.$d['paraggelies_id'].'"/>').'
							</td>
							<td>
								<input type="text" style="width:40px;color:#999;" value="'.($d['paraggelies_paralaviRahis']==0?'':$d['paraggelies_paralaviRahis']).'" id="parText'.$d['paraggelies_id'].'paralaviRahis" onClick="setColor(\''.$d['paraggelies_id'].'\',\'paralaviRahis\')" onBlur="unsetColor(\''.$d['paraggelies_id'].'\',\'paralaviRahis\')" name="rahiText'.$d['paraggelies_id'].'"/>
								<input type="button" onClick="setValText(\'paralaviRahis\',\''.$d['paraggelies_id'].'\')" value="" id="rahiCheck'.$d['paraggelies_id'].'" name="rahiCheck'.$d['paraggelies_id'].'"/>
							</td>
							<td id="content'.$d['paraggelies_id'].'aitisiTypografeioDate">
								'.(!empty($d['paraggelies_aitisiTypografeioDate'])?$d['paraggelies_aitisiTypografeioDate'].'&nbsp;&nbsp;&nbsp;
									<a style="float:none;" href="paraggelies.php?del=aitisiTypografeioDate&bibId='.$d['biblia_id'].'">
										<img src="images/deleteButton.png" width="12px" />
									</a>':'<input type="button" id="aitTyp'.$d['paraggelies_id'].'" onClick="setValButton(\''.$d['paraggelies_id'].'\',\'aitisiTypografeioDate\')" class="aitTyp'.$d['paraggelies_id'].'" name"aitTyp'.$d['paraggelies_id'].'"/>').'
							</td>
							<td>
								<input type="text" style="width:90px;color:#999;" value="'.($d['paraggelies_isbn']==0?'':$d['paraggelies_isbn']).'" id="parText'.$d['paraggelies_id'].'isbn" onClick="setColor(\''.$d['paraggelies_id'].'\',\'isbn\')" onBlur="unsetColor(\''.$d['paraggelies_id'].'\',\'isbn\')" name="isbnText'.$d['paraggelies_id'].'"/>
								<input type="button" onClick="setValText(\'isbn\',\''.$d['paraggelies_id'].'\')" value="" id="isbnCheck'.$d['paraggelies_id'].'" name="isbnCheck'.$d['paraggelies_id'].'"/>
							</td>
							<td id="content'.$d['paraggelies_id'].'aitisiEksofDate">
								'.(!empty($d['paraggelies_aitisiEksofDate'])?$d['paraggelies_aitisiEksofDate']:'<input type="button" id="aitEks'.$d['paraggelies_id'].'" onClick="setValButtonLog(\''.$d['paraggelies_id'].'\',\'aitisiEksofDate\',\'aitisiEksofDate\',\'\')" class="aitEks'.$d['paraggelies_id'].'" name="aitEks'.$d['paraggelies_id'].'"/>').'
							</td>
							<td>
								<form enctype="multipart/form-data" action="paraggelies.php?file=paralaviEksofDate" method="post">
									'.(!empty($d['paraggelies_paralaviEksofDate'])?$d['paraggelies_paralaviEksofDate'].'&nbsp;&nbsp;&nbsp;
									<a style="float:none;" href="paraggelies.php?del=paralaviEksofDate&bibId='.$d['biblia_id'].'">
										<img src="images/deleteButton.png" width="12px" />
									</a>':'<span id="content'.$d['paraggelies_id'].'paralaviEksofDate"><input type="button" id="parEks'.$d['paraggelies_id'].'" onClick="setValButton(\''.$d['paraggelies_id'].'\',\'paralaviEksofDate\')" class="parEks'.$d['paraggelies_id'].'" name="parEks'.$d['paraggelies_id'].'"/></span>
									<input type="file" onChange="this.form.submit();" id="hidFileWord'.$d['paraggelies_id'].'paralaviEksofDate" name="files"/>
									<input type="hidden" value="'.$d['biblia_id'].'" name="filesHid"/>').'
								</form>
							</td>
							<td id="content'.$d['paraggelies_id'].'apostoliEksofDate">
								'.(!empty($d['paraggelies_apostoliEksofDate'])?$d['paraggelies_apostoliEksofDate']:'<input type="button" id="apostEks'.$d['paraggelies_id'].'" onClick="setValButtonLog(\''.$d['paraggelies_id'].'\',\'apostoliEksofDate\',\'apostoliEksofDate\',\'\')" class="apostEks'.$d['paraggelies_id'].'" name="apostEks'.$d['paraggelies_id'].'"/>').'
							</td>
							<td>
								<form enctype="multipart/form-data" action="paraggelies.php?file=paralaviBibDate" method="post">
									'.(!empty($d['paraggelies_paralaviBibDate'])?$d['paraggelies_paralaviBibDate'].'&nbsp;&nbsp;&nbsp;
									<a style="float:none;" href="paraggelies.php?del=paralaviBibDate&bibId='.$d['biblia_id'].'">
										<img src="images/deleteButton.png" width="12px" />
									</a>':'<span id="content'.$d['paraggelies_id'].'paralaviBibDate"><input type="button" id="parBib'.$d['paraggelies_id'].'" onClick="setValButton(\''.$d['paraggelies_id'].'\',\'paralaviBibDate\')" class="parBib'.$d['paraggelies_id'].'" name="parBib'.$d['paraggelies_id'].'"/></span>
									<input type="file" onChange="this.form.submit();" id="hidFileWord'.$d['paraggelies_id'].'paralaviBibDate" name="files"/>
									<input type="hidden" value="'.$d['biblia_id'].'" name="filesHid"/>').'
								</form>
							</td>
							<td id="content'.$d['paraggelies_id'].'ektyposiSymfonDate">
								'.(!empty($d['paraggelies_ektyposiSymfonDate'])?$d['paraggelies_ektyposiSymfonDate']:'<input type="button" id="ektSymf'.$d['paraggelies_id'].'" onClick="setValButtonLog(\''.$d['paraggelies_id'].'\',\'ektyposiSymfonDate\',\'ektyposiSymfonDate\',\'\')" class="ektSymf'.$d['paraggelies_id'].'" name="ektSymf'.$d['paraggelies_id'].'"/>').'
							</td>
							<td id="content'.$d['paraggelies_id'].'ypografiSuggrafeaDate">
								'.(!empty($d['paraggelies_ypografiSuggrafeaDate'])?$d['paraggelies_ypografiSuggrafeaDate']:'<input type="button" id="ypogSug'.$d['paraggelies_id'].'" onClick="setValButton(\''.$d['paraggelies_id'].'\',\'ypografiSuggrafeaDate\')" class="ypogSug'.$d['paraggelies_id'].'" name="ypogSug'.$d['paraggelies_id'].'"/>').'
							</td>
							<td id="content'.$d['paraggelies_id'].'egkrisiKarantDate">
								'.(!empty($d['paraggelies_egkrisiKarantDate'])?$d['paraggelies_egkrisiKarantDate']:'<input type="button" id="egkrKarant'.$d['paraggelies_id'].'" onClick="setValButton(\''.$d['paraggelies_id'].'\',\'egkrisiKarantDate\')" class="egkrKarant'.$d['paraggelies_id'].'" name="egkrKarant'.$d['paraggelies_id'].'"/>').'
							</td>
							<td id="content'.$d['paraggelies_id'].'apostoliLogistDate">
								'.(!empty($d['paraggelies_apostoliLogistDate'])?$d['paraggelies_apostoliLogistDate']:'<input type="button" id="apostLog'.$d['paraggelies_id'].'" onClick="setValButtonLog(\''.$d['paraggelies_id'].'\',\'apostoliLogistDate\',\'apostoliLogistDate\',\'\')" class="apostLog'.$d['paraggelies_id'].'" name="apostLog'.$d['paraggelies_id'].'"/>').'
							</td>
							<td id="content'.$d['paraggelies_id'].'pliromiSuggrafeaDate">
								'.(!empty($d['paraggelies_pliromiSuggrafeaDate'])?$d['paraggelies_pliromiSuggrafeaDate']:'<input type="button" id="plirSyg'.$d['paraggelies_id'].'" onClick="setValButton(\''.$d['paraggelies_id'].'\',\'pliromiSuggrafeaDate\')" class="plirSyg'.$d['paraggelies_id'].'" name="plirSyg'.$d['paraggelies_id'].'"/>').'
							</td>
							</form>
						</tr>';
					}
				$txt.='</table>
			</div>
	';
	return $txt;
}
function load_paraggeliesReg(){
	GLOBAL $con;
	$txt='
		<div class="container_sample">
			<h1 class="headlines">Εισαγωγή Παραγγελίας Βιβλίου</h1>
			<form action="paraggelies.php?mode=reg" method="post">
				<table class="entry_forms">
					<tr>
						<td>
							Τίτλος Βιβλίου
						</td>
						<td>
							<input type="text" name="titlos" value="'.(isset($_POST['titlos'])?$_POST['titlos']:'').'"/>
						</td>
						<td>
							Ημερομηνία
						</td>
						<td>
							<input type="text" name="date" value="'.(isset($_POST['date'])?$_POST['date']:'').'"/>
						</td>
					</tr>
					<tr>
						<td>
							Εκδοτικός Οίκος
						</td>
						<td>
							<select name="ekdotikoi"/>
								<option>Επιλέξτε</option>';
								mysqli_query($con,"SET NAMES utf8");
								$q="SELECT * FROM ekdotikoi
									ORDER BY ekdotikoi_name";
								$r=mysqli_query($con,$q);						
								while($d=mysqli_fetch_assoc($r)){
									$sel="";
									if((isset($_POST['ekdotikoi'])) && ($d['ekdotikoi_id']==$_POST['ekdotikoi']))
										$sel="selected=\"selected\"";
									$txt.='
										<option '.$sel.' value="'.$d['ekdotikoi_id'].'">'.$d['ekdotikoi_name'].'</option>
									';
								}
					$txt.='</select>
						</td>
						<td>
							Barcode
						</td>
						<td>
							<input type="text" name="barcode" value="'.(isset($_POST['barcode'])?$_POST['barcode']:'').'"/>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="checkbox" name="paralaviWord"/>
							Παραλαβή αρχείου Word
						</td>
						<td colspan="2">
							<input type="checkbox" name="apostoliWord"/>
							Αποστολή σε Εκδοτικό
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="checkbox" name="epistrofiSePdf"/>
							Επιστροφή απο Εκδοτικό σε PDF
						</td>
						<td colspan="2">
							<input type="checkbox" name="checkSuggrafea"/>
							Check απο Συγγραφέα
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="checkbox" name="egkrisiPdfSeEkdotiko"/>
							Έγκριση PDF προς Εκδοτικό
						</td>
						<td colspan="2">
							<input type="checkbox" name="paralaviRaxis"/>
							Παραλαβή Ράχης
						</td>
					</tr>
				</table>
			</form>
		</div>
	';
	return $txt;
}
?>