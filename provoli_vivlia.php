<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	echo head();
?>
	<body>
		<?=load_viv_header()?>
		<div style="margin:10px 0 0 10px;">
			<h1 class="headlines">Λίστα Βιβλίων</h1>
			<form style="margin:10px 0 5px 0;" action="provoli_vivlia.php" method="post" id="apo_form">
				<input type="text" name="vivlio" id="vivlio" value="" AUTOCOMPLETE="off"/>
				<input type="submit" name="search_btn" id="search_btn" value="Αναζήτηση"/>
				<span style="color:#ff0000;">
			<?php
				if (isset($_GET['edit']))
					echo 'Η επεξεργασία βιβλίου έγινε.';
				else if (isset($_GET['del']))
					echo 'Το βιβλίο διαγράφηκε';
			?>
			</span>
			</form>
			<table class="tables">
				<tr>
					<th>Κωδικός</th>
					<th>Τίτλος</th>
					<th>Συγραφέας</th>
					<th>Εκδόσεις</th>
					<th>Επίπεδο</th>
					<th>Κατηγορία</th>
					<th>Κατάσταση</th>
					<th>Δανεισμοί</th>
					<th>Ημερομηνία Καταχώρησης</th>
					<th>Ενέργειες</th>
				</tr>
				<?php
					mysqli_query($con,"SET NAMES utf8");
					$q="SELECT * FROM vivlia
						INNER JOIN ekdoseis ON vivlia.ekdoseis_id=ekdoseis.ekdoseis_id
						INNER JOIN epipeda ON vivlia.epipeda_id=epipeda.epipeda_id
						INNER JOIN katigories ON vivlia.katigories_id=katigories.katigories_id
						LEFT JOIN (SELECT * FROM daneismos INNER JOIN (SELECT MAX( daneismos_id ) as dan_id FROM daneismos
						GROUP BY vivlia_id) AS dan ON daneismos.daneismos_id= dan.dan_id) AS daneismosbooks ON vivlia.vivlia_id=daneismosbooks.vivlia_id";
						if (!empty($_GET['id'])){
							$q.=" WHERE vivlia.vivlia_id LIKE '".$_GET['id']."'";
						}
						elseif (!empty($_POST)){
							$q.=" WHERE vivlia_name LIKE '%".$_POST['vivlio']."%'";
						}
					$q.=" order by vivlia_name ASC limit 0,100";
					$r=mysqli_query($con,$q);
					while($d=mysqli_fetch_array($r)){
						$q1="SELECT daneismos_id
							FROM daneismos
							WHERE vivlia_id LIKE '".$d[0]."'";
						$r1=mysqli_query($con,$q1);
						$d1=mysqli_fetch_assoc($r1);
						echo
							'<tr id="seira_melous">
								<td>'.$d[0].'</td>
								<td>'.$d['vivlia_name'].'</td>
								<td>'.$d['vivlia_sygrafeas'].'</td>
								<td>'.$d['ekdoseis_name'].'</td>
								<td>'.$d['epipeda_name'].'</td>
								<td>'.$d['katigories_name'].'</td>
								<td>'.(($d['daneismos_hmer_epistrofis'])=='' && $d['vivlia_id']!=""?('Μη Διαθέσιμο'):('Διαθέσιμο')).'</td>
								<td><a class="links" href="vivlia_daneismoi.php?id='.$d[0].'">'.mysqli_num_rows($r1).'</a></td>
								<td>'.date("d/m/Y",$d['vivlia_hmer_kataxwrisis']).'</td>
								<td class="pro_btn">
									<a title="Επεξεργασία Βιβλίου" href="vivlia_edit.php?id='.$d[0].'"><img width="25px" src="images/edit_foto.png"/></a>
									<a title="Διαγραφή Βιβλίου" href="vivlia_del.php?id='.$d[0].'"><img width="25px;" src="images/deleteButton.png"/></a>
								</td>
							</tr>';
					}
				?>
			</table>
		</div>
		<?=load_footer()?>
	</body>
</html>