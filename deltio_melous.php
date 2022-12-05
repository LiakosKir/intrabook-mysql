<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	echo head();
?>
	<body>
		<?=load_viv_header()?>
		<div id="deltio_tables">
			<div id="deltio_stoixeia">
				<h1 class="headlines">Ατομικό Δελτίο Μέλους</h1>
				<?php
					mysqli_query($con,"SET NAMES utf8");
					$q="SELECT * FROM daneismos
						INNER JOIN melh ON daneismos.melh_id=melh.melh_id
						INNER JOIN vivlia ON daneismos.vivlia_id=vivlia.vivlia_id
						INNER JOIN tomeis ON melh.tomeis_id=tomeis.tomeis_id
						WHERE daneismos.melh_id LIKE '".$_GET['id']."'";
					$r=mysqli_query($con,$q);
					$d=mysqli_fetch_assoc($r);
					echo "
					<table>
						<tr>
							<th colspan='2'>Στοιχεία Μέλους</th>
						</tr>
						<tr>
							<td style='text-align:right !important;'>Κωδικός:</td><td style='text-align:left !important;color:#b1b1b1;'>".$d['melh_id']."</td>
						</tr>
						<tr>
							<td style='text-align:right !important;'>Ονομ/πώνυμο:</td><td style='text-align:left !important;color:#b1b1b1;'>".$d['melh_epwnymo']."&nbsp;".$d['melh_onoma']."</td>
						</tr>
						<tr>
							<td style='text-align:right !important;'>Τηλέφωνο:</td><td style='text-align:left !important;color:#b1b1b1;'>".$d['melh_thlefwno']."</td>
						</tr>
						<tr>
							<td style='text-align:right !important;'>Email:</td><td style='text-align:left !important;color:#b1b1b1;'>".$d['melh_email']."</td>
						</tr>
						<tr>
							<td style='text-align:right !important;'>Τομέας:</td><td style='text-align:left !important;color:#b1b1b1;'>".$d['tomeis_name']."</td>
						</tr>
					</table>";
				?>
			</div>
			<div id='deltio_vivlia'>
				<h1 class='headlines'>Βιβλία που δανείστηκε</h1>
				<table>
					<tr>
						<th>Κωδικός</th>
						<th>Βιβλίο</th>
						<th>Ημερομηνία Δανεισμού</th>
						<th>Ημερομηνία Επιστροφής</th>
					</tr>
					<?php
						while($d=mysqli_fetch_assoc($r)){
							echo '
							<tr>
								<td>'.$d['vivlia_id'].'</td>
								<td style="text-align:left !important;"><a class="links" href="provoli_vivlia.php?id='.$d['vivlia_id'].'"><img src="images/icon-right.png"/>'.$d['vivlia_name'].'</a></td>
								<td>'.date("d/m/Y",$d['daneismos_hmer_daneismou']).'</td>
								<td>'.(empty($d['daneismos_hmer_epistrofis'])?('&nbsp;'):date("d/m/Y",$d['daneismos_hmer_epistrofis'])).'</td>
							</tr>';
						}
					?>
				</table>
			</div>
		</div>
		<?=load_footer()?>
	</body>