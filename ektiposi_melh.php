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
		<h3	class="aln_mdll">ΚΑΤΑΛΟΓΟΣ ΜΕΛΩΝ</h3>
		<?php
			mysqli_query($con,"SET NAMES utf8");
			$q="SELECT * FROM melh
					INNER JOIN eth ON melh.eth_id=eth.eth_id";		
			$r=mysqli_query($con,$q);
			echo '<table  id="ekt_provoli">
					<tr>
						<th>A/A</th>
						<th>Κωδικός</th>
						<th>Ονοματεπώνυμο</th>
						<th>Τμήμα</th>
						<th>Τηλέφωνο</th>
						<th>e-mail</th>
						<th>Έτος Κατάρτησης</th>
					</tr>';
			$aa=1;
			while($d=mysqli_fetch_assoc($r)){
				echo '<tr>
						<td>'.$aa.'</td>
						<td>'.$d['melh_id'].'</td>
						<td>'.$d['melh_epwnymo'].'&nbsp;'.$d['melh_onoma'].'</td>
						<td>'.$d['melh_tmhma'].'</td>
						<td>'.$d['melh_thlefwno'].'</td>
						<td>'.$d['melh_email'].'</td>
						<td>'.$d['eth_name'].'</td>
					</tr>';
				$aa++;
			}
			echo '</table>';
		
		?>
	</div>
</body>
</html>