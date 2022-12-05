<?php
	require_once("bibliopoleioCon.php");
	require_once("lib.php");
	$alrt='';
	echo bib_login_validation();
	if(!empty($_GET)){
		if ((!empty($_POST['epwnymia']))){
			if(($_GET['mode'])=='reg'){
				mysqli_query($con,"SET NAMES utf8");
				$q="INSERT INTO ekdotikoi (ekdotikoi_id,ekdotikoi_name,ekdotikoi_epwnymo,ekdotikoi_onoma,ekdotikoi_dieuthinsi,ekdotikoi_tk,ekdotikoi_poli,ekdotikoi_stathero,ekdotikoi_kinito,ekdotikoi_email,ekdotikoi_afm,ekdotikoi_doy,ekdotikoi_sxolia)
					VALUES ('".md5($_POST['epwnymia'])."','".$_POST['epwnymia']."','".$_POST['epwnymo']."','".$_POST['onoma']."','".$_POST['dieuthinsi']."','".$_POST['tk']."','".$_POST['poli']."','".$_POST['stathero']."','".$_POST['kinito']."','".$_POST['email']."','".$_POST['afm']."','".$_POST['doy']."','".$_POST['sxolia']."')";
				if(mysqli_num_rows(mysqli_query($con,"SELECT ekdotikoi_id from ekdotikoi WHERE ekdotikoi_id LIKE '".md5($_POST['epwnymia'])."'"))<1){
						mysqli_query($con,$q);
					$alrt='<script>alert("Η καταχώρηση ολοκληρώθηκε")</script>';
					unset ($_POST);
				}
				else
					$alrt='<script>alert("Ο κωδικός υπάρχει")</script>';
			}
			if(($_GET['mode'])=='edit'){
				mysqli_query($con,"SET NAMES utf8");
				$q="UPDATE ekdotikoi
					SET ekdotikoi_epwnymo='".$_POST['epwnymo']."',ekdotikoi_onoma='".$_POST['onoma']."',ekdotikoi_dieuthinsi='".$_POST['dieuthinsi']."',ekdotikoi_tk='".$_POST['tk']."',ekdotikoi_poli='".$_POST['poli']."',ekdotikoi_stathero='".$_POST['stathero']."',ekdotikoi_kinito='".$_POST['kinito']."',ekdotikoi_email='".$_POST['email']."',ekdotikoi_afm='".$_POST['afm']."',ekdotikoi_doy='".$_POST['doy']."',ekdotikoi_sxolia='".$_POST['sxolia']."'
					WHERE ekdotikoi_id LIKE '".$_GET['id']."'";
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
				echo load_ekdotikoiPro();
			else{
				if(($_GET['mode'])=='reg')
					echo load_ekdotikoiReg().$alrt;
				if(($_GET['mode'])=='edit')
					echo load_ekdotikoiEdit().$alrt;
			}
		?>
		<?=load_footer()?>
	</body>
</html>