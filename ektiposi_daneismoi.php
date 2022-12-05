<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	echo head();
?>
<body>
	<div id="ekt_container">
		<img class="img_width" src="images/logo_black.png"/>
		<h3 class="aln_mdll"></h3>
		<h3 class="aln_mdll">ΔΑΝΕΙΣΤΙΚΗ ΒΙΒΛΙΟΘΗΚΗ</h3>
		<h3	class="aln_mdll">ΚΑΤΑΛΟΓΟΣ ΔΑΝΕΙΣΜΕΝΩΝ ΒΙΒΛΙΩΝ</h3>
		<?php
			mysqli_query($con,"SET NAMES utf8");
			$q="SELECT * FROM daneismos
				INNER JOIN melh ON daneismos.melh_id=melh.melh_id
				INNER JOIN vivlia ON daneismos.vivlia_id=vivlia.vivlia_id
				WHERE daneismos_hmer_epistrofis IS NULL";		
			$r=mysqli_query($con,$q);
			echo '<table id="ekt_provoli">
					<tr>
						<th>A/A</th>
						<th>Κωδικός Βιβλίου</th>
						<th>Τίτλος Βιβλίου</th>
						<th>Κωδικός Μέλους</th>
						<th>Ονομ/νυμο Μέλους</th>
						<th>Ημερομηνία Δανεισμού</th>
					</tr>';
			$aa=1;
			while($d=mysqli_fetch_assoc($r)){
				echo '<tr>
						<td>'.$aa.'</td>
						<td>'.$d['vivlia_id'].'</td>
						<td>'.$d['vivlia_name'].'</td>
						<td>'.$d['melh_id'].'</td>
						<td>'.$d['melh_epwnymo'].'&nbsp;'.$d['melh_onoma'].'</td>
						<td>'.date('d/m/Y',$d['daneismos_hmer_daneismou']).'</td>
					</tr>';
				$aa++;
			}
			echo '</table>';
		
		?>
	</div>
</body>
</html>