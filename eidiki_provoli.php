<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	echo head();
?>
<body>
	<?=load_header()?>
  	<?php
	 if (!empty($_GET['xwros']) && ($_GET['eidos'])){
		mysqli_query($con,"SET NAMES utf8");
		$q="SELECT * 
			FROM eidos 
			INNER JOIN typos ON eidos.typos_id=typos.typos_id
			INNER JOIN ktirio ON eidos.ktirio_id=ktirio.ktirio_id
			INNER JOIN xwros ON eidos.xwros_id=xwros.xwros_id
			INNER JOIN tomeas ON eidos.tomeas_id=tomeas.tomeas_id
			WHERE xwros.xwros_name LIKE '".$_GET['xwros']."' AND typos.typos_name LIKE '".$_GET['eidos']."'";		
		$r=mysqli_query($con,$q);
		echo '<div style="margin:0 0 0 40px;">
			<h1 class="headlines">'.$_GET['xwros'].'</h1>
			<table  class="tables">
				<tr>
					<th>Κωδικός Είδους</th>
					<th>Τύπος Εξοπλισμού</th>
					<th>Χαρακτηριστικά</th>
					<th>Θέση/Χρήστης</th>
					<th>Κτίριο</th>
					<th>Ποσότητα</th>
					<th>Τομέας</th>
					<th>Ημερομηνία Καταχώρησης</th>
				</tr>';
		while($d=mysqli_fetch_assoc($r)){
			echo '<tr>
					<td>'.$d['eidos_id'].'</td>
					<td>'.$d['typos_name'].'</td>
					<td>'.$d['eidos_xaraktiristika'].'</td>
					<td>'.$d['eidos_thesi_xristis'].'</td>
					<td>'.$d['ktirio_name'].'</td>
					<td>'.$d['eidos_posotita'].'</td>
					<td>'.$d['tomeas_name'].'</td>
					<td>'.date("d/m/Y",$d['hmer_kataxwrisis']).'</td>
				</tr>';
		}
		echo '</table>';
	}
	?>
	<?=load_footer()?>
</body>
</html>