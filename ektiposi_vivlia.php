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
		<h3	class="aln_mdll">ΚΑΤΑΛΟΓΟΣ ΒΙΒΛΙΩΝ</h3>
		<?php
			mysqli_query($con,"SET NAMES utf8");
			$q="SELECT * FROM vivlia
						INNER JOIN ekdoseis ON vivlia.ekdoseis_id=ekdoseis.ekdoseis_id
						INNER JOIN epipeda ON vivlia.epipeda_id=epipeda.epipeda_id
						INNER JOIN katigories ON vivlia.katigories_id=katigories.katigories_id";		
			$r=mysqli_query($con,$q);
			echo '<table  id="ekt_provoli">
					<tr>
						<th>A/A</th>
						<th>Κωδικός</th>
						<th>Τίτλος</th>
						<th>Συγραφέας</th>
						<th>Εκδόσεις</th>
						<th>Επίπεδο</th>
						<th>Κατηγορία</th>
					</tr>';
			$aa=1;
			while($d=mysqli_fetch_assoc($r)){
				echo '<tr>
						<td>'.$aa.'</td>
						<td>'.$d['vivlia_id'].'</td>
						<td>'.$d['vivlia_name'].'</td>
						<td>'.$d['vivlia_sygrafeas'].'</td>
						<td>'.$d['ekdoseis_name'].'</td>
						<td>'.$d['epipeda_name'].'</td>
						<td>'.$d['katigories_name'].'</td>
					</tr>';
				$aa++;
			}
			echo '</table>';
		
		?>
	</div>
</body>
</html>