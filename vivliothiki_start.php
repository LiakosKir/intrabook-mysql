<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	echo head();
?>
	<body>
		<?=load_viv_header()?>
		<div style="margin:50px 0 0 40px;">
			<h1 class="headlines">Δανεισμοί άνω των 15 ημερών</h1>
		<?php
			mysqli_query($con,"SET NAMES utf8");
			$q="SELECT * FROM (vivlia
				INNER JOIN daneismos ON vivlia.vivlia_id=daneismos.vivlia_id)
				INNER JOIN melh ON daneismos.melh_id=melh.melh_id
				WHERE (daneismos_hmer_daneismou < ".((time())-(60*60*24*15)).") AND (daneismos_hmer_epistrofis is null)
				order by daneismos.daneismos_hmer_daneismou DESC";
			$r=mysqli_query($con,$q);
			if(mysqli_num_rows($r)>0){
				echo '<table class="tables">
					<tr>
						<th>Κωδικός Βιβλίου</th>
						<th>Τίτλος Βιβλίου</th>
						<th>Κωδικός Μέλους</th>
						<th>Ονοματεπώνυμο Μέλους</th>
						<th>Διάρκεια Δανεισμού<span style="font-size:10px;">(Ημέρες)</span></th>
						<th>Ημερομηνία Δανεισμού</th>
					</tr>';
			while($d=mysqli_fetch_assoc($r)){
				echo '<tr>
						<td>'.$d['vivlia_id'].'</td>
						<td>'.$d['vivlia_name'].'</td>
						<td>'.$d['melh_id'].'</td>
						<td>'.$d['melh_epwnymo'].'&nbsp;'.$d['melh_onoma'].'</td>
						<td>'.ceil((time()-$d['daneismos_hmer_daneismou'])/86400).'</td>
						<td>'.date('d/m/Y',$d['daneismos_hmer_daneismou']).'</td>
					</tr>';
			}
			echo '</table>';
			}
			else
			echo 'Δεν υπάρχουν..';
		?>
		</div>
		<?=load_footer()?>
    </body>
</html>