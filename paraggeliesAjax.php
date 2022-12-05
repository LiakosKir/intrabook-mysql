<?php
	require_once("bibliopoleioCon.php");
	//require_once("lib.php");
	//echo bib_login_validation();
	mysqli_query($con,"SET NAMES utf8");
	$q1="SELECT *
		FROM paraggelies
		WHERE paraggelies_id LIKE '".$_GET['id']."'";
	$r1=mysqli_query($con,$q1);
	$d1=mysqli_fetch_assoc($r1);
	$q="UPDATE paraggelies";
	if(isset($_GET['log'])){
		$mkf='bibliaDocs/'.$d1['biblia_id'].'/mailLog.txt';
		if(file_exists($mkf))
			$f=fopen('bibliaDocs/'.$d1['biblia_id'].'/mailLog.txt','a');	
		else
			$f=fopen('bibliaDocs/'.$d1['biblia_id'].'/mailLog.txt','w');
		if($_GET['log']=="apostoliWordEkdDate")
			$cont=date("d.m.Y")."| �������� �� ������ Word ���� �������� ���� email ����� ��� �� �������� ������:
		".$_POST['post']."
";
		if($_GET['log']=="aitisiEksofDate")
			$cont=date("d.m.Y")."| �������� ���������� ���� �������� ��� �� ������� ��� �������
";
		if($_GET['log']=="apostoliEksofDate")
			$cont=date("d.m.Y")."| �������� �� �������� ��� ������� ���� ��������� ���� email
";
		if($_GET['log']=="ektyposiSymfonDate")
			$cont=date("d.m.Y")."| ���������� �� ����������� ��� �������� ���������� ���� ���������
";
		if($_GET['log']=="apostoliLogistDate")
			$cont=date("d.m.Y")."| �������� ����������� ��� ����������
";
		fwrite($f,$cont);
		fclose($f);
	}
	if($_GET['col']=='temaxia' || $_GET['col']=='paralaviRahis' || $_GET['col']=='isbn')
		$q.=" SET paraggelies_".$_GET['col']."=".(empty($_GET['value'])?'0':$_GET['value']);
	else
		$q.=" SET paraggelies_".$_GET['col']."='".date('d/m/'.substr('y',-2,2))."'";
	$q.=" WHERE paraggelies_id='".$_GET['id']."'";
	$r=mysqli_query($con,$q);
	if($_GET['col']=='paralaviWordDate' || $_GET['col']=='apostoliWordEkdDate' || $_GET['col']=='paralaviPdfDate' || $_GET['col']=='checkSuggrafeaDate' || $_GET['col']=='egkrisiPdf' || $_GET['col']=='aitisiTypografeioDate' || $_GET['col']=='aitisiEksofDate' || $_GET['col']=='paralaviEksofDate' || $_GET['col']=='apostoliEksofDate' || $_GET['col']=='paralaviBibDate' || $_GET['col']=='ektyposiSymfonDate' || $_GET['col']=='ypografiSuggrafeaDate' || $_GET['col']=='egkrisiKarantDate' || $_GET['col']=='apostoliLogistDate' || $_GET['col']=='pliromiSuggrafeaDate')
		echo date('d/m/'.substr('y',-2,2));
?>