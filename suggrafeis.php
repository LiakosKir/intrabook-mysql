<?php
	require_once("bibliopoleioCon.php");
	require_once("lib.php");
	$alrt='';
	echo bib_login_validation();
	if(!empty($_GET)){
		if((!empty($_POST['epwnymo'])) && (!empty($_POST['onoma']))){
			mysqli_query($con,"SET NAMES utf8");
			if(($_GET['mode'])=='reg'){
				$q="INSERT INTO suggrafeis (suggrafeis_id,suggrafeis_epwnymo,suggrafeis_onoma,suggrafeis_dieuthinsi,suggrafeis_tk,suggrafeis_poli,suggrafeis_perioxi,suggrafeis_stathero,suggrafeis_kinito,suggrafeis_afm,suggrafeis_doy,suggrafeis_fylo,suggrafeis_email,suggrafeis_hmer_gennisis)
					VALUES ('".md5($_POST['epwnymo'])."','".$_POST['epwnymo']."','".$_POST['onoma']."','".$_POST['dieuthinsi']."','".$_POST['tk']."','".$_POST['poli']."','".$_POST['perioxi']."','".$_POST['stathero']."','".$_POST['kinito']."','".$_POST['afm']."','".$_POST['doy']."','".((($_POST['fyllo'])=='Επιλέξτε')?(null):($_POST['fyllo']))."','".$_POST['email']."','".$_POST['hmer_gennisis']."')";
				if(mysqli_num_rows(mysqli_query($con,"SELECT suggrafeis_id from suggrafeis WHERE suggrafeis_id LIKE '".md5($_POST['epwnymo'])."'"))<1){
					mysqli_query($con,$q);
					$alrt='<script>alert("Η καταχώρηση ολοκληρώθηκε")</script>';
					unset ($_POST);
				}
				else
					$alrt='<script>alert("Ο κωδικός υπάρχει")</script>';
			}
			if(($_GET['mode'])=='edit'){
				$q="UPDATE suggrafeis
					SET suggrafeis_epwnymo='".$_POST['epwnymo']."',suggrafeis_onoma='".$_POST['onoma']."',suggrafeis_dieuthinsi='".$_POST['dieuthinsi']."',suggrafeis_tk='".$_POST['tk']."',suggrafeis_poli='".$_POST['poli']."',suggrafeis_perioxi='".$_POST['perioxi']."',suggrafeis_stathero='".$_POST['stathero']."',suggrafeis_kinito='".$_POST['kinito']."',suggrafeis_afm='".$_POST['afm']."',suggrafeis_doy='".$_POST['doy']."',suggrafeis_fylo='".$_POST['fyllo']."',suggrafeis_email='".$_POST['email']."',suggrafeis_hmer_gennisis='".$_POST['hmer_gennisis']."'
					WHERE suggrafeis_id LIKE '".$_GET['id']."'";
				if(mysqli_num_rows(mysqli_query($con,"SELECT suggrafeis_id from suggrafeis WHERE suggrafeis_id LIKE '".md5($_POST['epwnymo'])."'"))<2){
					mysqli_query($con,$q);
					$alrt='<script>alert("Η επεξεργασία ολοκληρώθηκε")</script>';
					unset ($_POST);
				}
				else
					$alrt='<script>alert("Ο κωδικός υπάρχει")</script>';
			}
		}
	}
	echo head();
?>
	<body>
		<?=load_bibliopoleioHeader()?>
		<?php
			if(empty($_GET))
				echo load_suggrafeisPro();
			else{
				if(($_GET['mode'])=='reg')
					echo load_suggrafeisReg().$alrt;
				if(($_GET['mode'])=='edit')
					echo load_suggrafeisEdit().$alrt;
			}
		?>
		<?=load_footer()?>
	</body>
</html>