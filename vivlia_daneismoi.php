<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	echo head();
?>
	<body>
		<?=load_viv_header()?>
		<?php
			mysqli_query($con,"SET NAMES utf8");
			$q="SELECT *
				FROM daneismos
				INNER JOIN melh ON daneismos.melh_id=melh.melh_id
				INNER JOIN vivlia ON daneismos.vivlia_id=vivlia.vivlia_id
				WHERE daneismos.vivlia_id LIKE '".$_GET['id']."'";
			$r=mysqli_query($con,$q);
			$d=mysqli_fetch_assoc($r);
		?>
		<div id="viv_dan_cont">
			<h1 class="headlines">Δανεισμοί Βιβλίου</h1>
			<table class="tables2">
				<tr>
					<th colspan="3"><?=$d['vivlia_name']?></th>
				</tr>
				<tr>
					<th>Μέλος</th>
					<th>Ημερομηνία Δανεισμού</th>
					<th>Ημερομηνία Επιστροφής</th>
				</tr>
			<?php
				while($d=mysqli_fetch_assoc($r)){
					echo '
					<tr>
						<td><a class="links" href="deltio_melous.php?id='.$d['melh_id'].'">'.$d['melh_epwnymo'].'&nbsp;'.$d['melh_onoma'].'</a></td>
						<td>'.date('d/m/y',$d['daneismos_hmer_daneismou']).'</td>
						<td>'.date('d/m/y',$d['daneismos_hmer_epistrofis']).'</td>
					</tr>';
				}
			?>
			</table>
		</div>
	</body>