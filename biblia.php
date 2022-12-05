<?php
	require_once("bibliopoleioCon.php");
	require_once("lib.php");
	$alrt='';
	$tomeas=array();
	echo bib_login_validation();
	if(!empty($_GET)){
		if(!empty($_POST['titlos'])){
			if(!empty($_POST['tomeas']))
				$tomeas=implode("_",$_POST['tomeas']);
			if(($_GET['mode'])=='reg'){
				mysqli_query($con,"SET NAMES utf8");
				$bookId=md5(time().session_id().$_POST['titlos']);
				$q="INSERT INTO biblia (biblia_id,biblia_periodos,biblia_hmeromhnia,biblia_isbn,biblia_name,biblia_xrwma,biblia_diastaseis,biblia_selides,suggrafeis_id,tomeisEidikotites_id,biblia_sxolia,biblia_eidosTitlou,biblia_eikonografimeno)
					VALUES ('".$bookId."','".$_POST['periodos']."','".$_POST['date']."','".$_POST['isbn']."','".$_POST['titlos']."','".((($_POST['xrwma'])=='Επιλέξτε')?(''):($_POST['xrwma']))."','".$_POST['diastaseis']."','".$_POST['selides']."','".$_POST['suggrafeas']."','".((!empty($_POST['tomeas']))?($tomeas):(''))."','".$_POST['sxolia']."','".$_POST['eidosTitlou']."','".(isset($_POST['eikonografimeno'])?('1'):('0'))."')";
					mysqli_query($con,$q)or die($mysql->error());
					mkdir('bibliaDocs/'.$bookId);
					chmod('bibliaDocs/'.$bookId,0777);
					$alrt='<script>alert("Η καταχώρηση ολοκληρώθηκε")</script>';
					unset ($_POST);
			}
			if(($_GET['mode'])=='edit'){
				mysqli_query($con,"SET NAMES utf8");
				$q="UPDATE biblia
					SET biblia_periodos='".$_POST['periodos']."',biblia_hmeromhnia='".$_POST['date']."',biblia_isbn='".$_POST['isbn']."',biblia_name='".$_POST['titlos']."',biblia_xrwma='".((($_POST['xrwma'])=='Επιλέξτε')?(null):($_POST['xrwma']))."',biblia_diastaseis='".$_POST['diastaseis']."',biblia_selides='".$_POST['selides']."',suggrafeis_id='".$_POST['suggrafeas']."',tomeisEidikotites_id='".((!empty($_POST['tomeas']))?($tomeas):(null))."',biblia_sxolia='".$_POST['sxolia']."',biblia_eidosTitlou='".$_POST['eidosTitlou']."',biblia_eikonografimeno='".(isset($_POST['eikonografimeno'])?('1'):('0'))."'
					WHERE biblia_id LIKE '".$_GET['id']."'";
				mysqli_query($con,$q);
				$alrt='<script>alert("Η μεταβολή ολοκληρώθηκε")</script>';
				unset ($_POST);
			}
		}
	}
	echo head();
?>
	<body>
		<?=load_bibliopoleioHeader()?>
		<?php
			if(empty($_GET))
				echo load_bibliaPro();
			else{
				if(($_GET['mode'])=='reg')
					echo load_bibliaReg().$alrt;
				if(($_GET['mode'])=='edit')
					echo load_bibliaEdit().$alrt;
			}
		?>
		<?=load_footer()?>
	</body>
</html>