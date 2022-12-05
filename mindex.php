<?php require_once('/iekdeltajobs.php'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link rel="shortcut icon"  href="/jobs/favicon.ico" />
	<link rel="stylesheet" href="m_jobs.css" type="text/css"/>
	</head>
	<body>
		<div id="container">
			<div id="content">
				<div id="header">
				<img src="/jobs/images/m_jobs.png"/>
				</div>
				<div id="middle_container">
					<div id="middle">
						<?php 
							if(isset($_GET["kat_thesi_id"]) && !isset($_GET['eidikotita_id'])) {
							mysqli_select_db($database_iekdeltajobs, $iekdeltajobs);
							$q="SELECT eidikotites.eidikotita_desc,eidikotites.eidikotita_id, aggelies.eidikotita_id, count( aggelies.eidikotita_id ) AS eidik_count FROM aggelies INNER JOIN eidikotites ON aggelies.eidikotita_id = eidikotites.eidikotita_id WHERE `katigoria_thesis_id` =".$_GET['kat_thesi_id']." GROUP BY aggelies.eidikotita_id ORDER BY eidikotites.eidikotita_desc";
							mysqli_query($con,'SET character_set_results="utf8"');
							mysqli_query($con,"SET CHARACTER SET utf8");
							mysqli_query($con,"SET NAMES 'utf8'");
							$r = mysqli_query($con,$q, $iekdeltajobs) or die($mysql->error());														
							while($d=mysqli_fetch_array($r))	{
							echo '<a class="zitounte_agg" href="jobs.php?kat_thesi_id='.$_GET["kat_thesi_id"].'&eidikotita_desc='.$d['eidikotita_desc'].'&eidikotita_id='.$d['eidikotita_id'].'&kat_thesis_desc='.$_GET['kat_thesis_desc'].'"><span class="navigation4">'.$d['eidikotita_desc'].'</span>&nbsp;&nbsp; (<strong>'.$d['eidik_count'].'</strong>'.$d['eidik_count']<2?' Αγγελία ':' Αγγελίες '.'</span>)</a>';
							}
							}
							else {
						?>
						<div class="btn"><a href="mindex.php?id=agggelies"> Αγγελίες <div class="agg_nm">(720)</div></a></div>
						<div class="btn" style="margin-left:2.5%;"><a href="mindex.php?id=agggelies_ana_eidikotita">Αγγελίες ανα <br/>ειδικότητα</a></div>
						<ul id="aggelies">
							<?php
								if(isset($_GET['id'])){
									if($_GET['id']=='agggelies'){
									mysqli_query($con,"SET NAMES utf8");
									$q="SELECT katigories_thesis . * , sum_thesis . *
										FROM katigories_thesis
										LEFT JOIN (
										SELECT Count( katigoria_thesis_id ) AS sum_thesis_num, katigoria_thesis_id AS kat_thesi_id
										FROM aggelies
										GROUP BY katigoria_thesis_id
										) AS sum_thesis ON katigories_thesis.katigoria_thesis_id = sum_thesis.kat_thesi_id
										WHERE kat_thesi_id IS NOT NULL";	
										$r=mysqli_query($con,$q);
										while($d=mysqli_fetch_assoc($r)){
										echo'<li onclick="location.href=\'jobs.php?kat_thesi_id=\'"><span class="agg_desc">
											<a href="mindex.php?kat_thesi_id='. urlencode($d['katigoria_thesis_id']).'&amp;kat_thesis_desc='.urlencode($d['katigoria_thesis_desc']).'"><span>'.$d['katigoria_thesis_desc'].'</span></a>
											</span>
											<span class="agg_num">'.$d['sum_thesis_num'].'</span>
											</li>';
										}
									}
									if($_GET['id']=='agggelies_ana_eidikotita'){
									mysqli_query($con,"SET NAMES utf8");
									$q="SELECT eidikotites . * , sum_eidikotites . *
										FROM eidikotites
										INNER JOIN (
										SELECT  Count( eidikotita_id ) AS sum_thesis_num, eidikotita_id, katigories_thesis.katigoria_thesis_id, katigories_thesis.katigoria_thesis_desc
										FROM aggelies
										INNER JOIN katigories_thesis
										ON aggelies.katigoria_thesis_id=katigories_thesis.katigoria_thesis_id
										GROUP BY eidikotita_id
										) AS sum_eidikotites ON eidikotites.eidikotita_id = sum_eidikotites.eidikotita_id
										WHERE sum_thesis_num IS NOT NULL";	
										$r=mysqli_query($con,$q);
										while($d=mysqli_fetch_assoc($r)){
										echo'<li onclick="location.href=\'jobs.php?kat_thesi_id=\'"><span class="agg_desc">
											<a href="mindex.php?kat_thesi_id='. urlencode($d['katigoria_thesis_id']).'&amp;kat_thesis_desc='.urlencode($d['eidikotita_desc']).'&amp;eidikotita_id='.$d['eidikotita_id'].'&amp;kat_thesis_desc='.urlencode($d['katigoria_thesis_desc']).'&amp;eidikotita_desc='.urlencode($d['eidikotita_desc']).'"><span>'.$d['eidikotita_desc'].'</span></a>
											</span>
											<span class="agg_num">'.$d['sum_thesis_num'].'</span>
											</li>';
										}
									}
								}
								else{
									mysqli_query($con,"SET NAMES utf8");
									$q="SELECT katigories_thesis . * , sum_thesis . *
										FROM katigories_thesis
										LEFT JOIN (
										SELECT Count( katigoria_thesis_id ) AS sum_thesis_num, katigoria_thesis_id AS kat_thesi_id
										FROM aggelies
										GROUP BY katigoria_thesis_id
										) AS sum_thesis ON katigories_thesis.katigoria_thesis_id = sum_thesis.kat_thesi_id
										WHERE kat_thesi_id IS NOT NULL";	
										$r=mysqli_query($con,$q);
										while($d=mysqli_fetch_assoc($r)){
										echo'<li onclick="location.href=\'jobs.php?kat_thesi_id=\'"><span class="agg_desc">
											<a href="mindex.php?kat_thesi_id='. urlencode($d['katigoria_thesis_id']).'&amp;kat_thesis_desc='.urlencode($d['katigoria_thesis_desc']).'"><span>'.$d['katigoria_thesis_desc'].'</span></a>
											</span>
											<span class="agg_num">'.$d['sum_thesis_num'].'</span>
											</li>';
										}
								}
							?>
						</ul>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>