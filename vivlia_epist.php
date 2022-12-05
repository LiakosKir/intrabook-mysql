<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	echo head();
?>
<body>
	<?=load_viv_header()?>
	<div id="eidos_view">
		<h1 class="headlines">Επιστροφή</h1>
		<form action="vivlia_epist.php" method="post">
			<input type="text" name="titlos" id="titlos" value="" AUTOCOMPLETE="off"/>
			<input type="submit" name="search_btn" id="search_btn" value="Αναζήτηση"/>
		</form>
		<table class="tables">
			<tr>
				<th>Κωδικός</th>
				<th>Τίτλος</th>
				<th>Μέλος</th>
				<th>Ημερομηνία Δανεισμού</th>
				<th>Επιστροφή</th>
			</tr>
			<?php
				mysqli_query($con,"SET NAMES utf8");
				if (empty($_POST)){
					$q="SELECT * FROM (vivlia
					INNER JOIN daneismos ON vivlia.vivlia_id=daneismos.vivlia_id)
					INNER JOIN melh ON daneismos.melh_id=melh.melh_id
					WHERE daneismos_hmer_epistrofis is null
					order by daneismos.daneismos_hmer_daneismou DESC";
				}
				else{
					$q="SELECT * FROM (vivlia
					INNER JOIN daneismos ON vivlia.vivlia_id=daneismos.vivlia_id)
					INNER JOIN melh ON daneismos.melh_id=melh.melh_id
					WHERE ((daneismos_hmer_epistrofis IS NULL) AND ((vivlia_name LIKE '%".$_POST['titlos']."%') OR (daneismos.vivlia_id LIKE '%".$_POST['titlos']."%')))
					order by daneismos.daneismos_hmer_daneismou DESC";
				}
				$r=mysqli_query($con,$q);
				while($d=mysqli_fetch_assoc($r)){
					echo '
						<tr>
							<td>'.$d['vivlia_id'].'</td>
							<td>'.$d['vivlia_name'].'</td>
							<td>'.$d['melh_onoma'].'&nbsp;'.$d['melh_epwnymo'].'</td>
							<td>'.date('d/m/Y',$d['daneismos_hmer_daneismou']).'</td>
							<td><input type="button" value="Επιστροφή" onclick="location.href=\'vivlio_back.php?id='.$d['daneismos_id'].'\'"/></td>
						</tr>
					';
				}
			?>
		</table>
	</div>
	<?=load_footer()?>
</body>
</html>
