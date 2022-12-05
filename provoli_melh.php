<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	echo head();
?>
	<script language="javascript">
	<!--
	function validate(URL){
		if(confirm("Διαγραφή στοιχείου Ν/Ο"))
			location.href=URL;
	}
	-->
	</script>
	<body>
		<?=load_viv_header()?>
			<div style="margin:20px 0 0 10px;">
				<h1 class="headlines">Λίστα Μελών</h1>
				<form style="margin:10px 0 5px 0;" action="provoli_melh.php" method="post" id="apo_form">
					<input type="text" name="melos" id="melos" value="" AUTOCOMPLETE="off"/>
					<input type="submit" name="search_btn" id="search_btn" value="Αναζήτηση"/>
					<span style="color:#ff0000;">
					<?php
						if (isset($_GET['edit']))
							echo 'Η επεξεργασία μέλους έγινε.';
						else if (isset($_GET['xreos']))
							echo '<script>alert(\'Η διαγραφή απέτυχε.Υπάρχουν εκκρεμότητες.\')</script>';
						else if (isset($_GET['del']))
							echo 'Το μέλος διαγράφηκε';
					?>
					</span>
				</form>
			<table class="tables">
				<tr>
					<th>Κωδικός</th>
					<th>Επώνυμο</th>
					<th>Όνομα</th>
					<th>Τμήμα</th>
					<th>Τηλέφωνο</th>
					<th>e-mail</th>
					<th>Τομέας</th>
					<th>Ειδικότητα</th>
					<th>Έτος Κατάρτησης</th>
					<th>Δανεισμοί Βιβλίων</th>
					<th>Ημερομηνία Καταχώρησης</th>
					<th>Ενέργειες</th>
				</tr>
				<?php
					mysqli_query($con,"SET NAMES utf8");
					if (!empty($_POST)){
						$q="SELECT * FROM melh
						INNER JOIN tomeis ON melh.tomeis_id=tomeis.tomeis_id
						INNER JOIN eidikothtes ON melh.eidikothtes_id=eidikothtes.eidikothtes_id
						INNER JOIN eth ON melh.eth_id=eth.eth_id
						WHERE melh_onoma LIKE '%".$_POST['melos']."%' OR melh_epwnymo LIKE '%".$_POST['melos']."%'
						order by melh_epwnymo ASC limit 0,100";
					}
					else{
						$q="SELECT * FROM melh
						INNER JOIN tomeis ON melh.tomeis_id=tomeis.tomeis_id
						INNER JOIN eidikothtes ON melh.eidikothtes_id=eidikothtes.eidikothtes_id
						INNER JOIN eth ON melh.eth_id=eth.eth_id
						order by melh_epwnymo ASC limit 0,100";
					}
					$r=mysqli_query($con,$q);
					while($d=mysqli_fetch_assoc($r)){
						$q1="SELECT count(daneismos_hmer_daneismou) as daneismoi
							FROM daneismos
							GROUP BY melh_id
							HAVING melh_id LIKE '".$d['melh_id']."'";
						$r1=mysqli_query($con,$q1);
						$d1=mysqli_fetch_assoc($r1);
						echo '
							<tr id="seira_melous">
								<td>'.$d['melh_id'].'</td>
								<td>'.$d['melh_epwnymo'].'</td>
								<td>'.$d['melh_onoma'].'</td>
								<td>'.$d['melh_tmhma'].'</td>
								<td>'.$d['melh_thlefwno'].'</td>
								<td>'.$d['melh_email'].'</td>
								<td>'.$d['tomeis_name'].'</td>
								<td>'.$d['eidikothtes_name'].'</td>
								<td>'.$d['eth_name'].'</td>
								<td>'.$d1['daneismoi'].'</td>
								<td>'.date("d/m/Y",$d['melh_hmer_kataxwrisis']).'</td>
								<td class="pro_btn">
									<a title="Δελτίο Μέλους" href="deltio_melous.php?id='.$d['melh_id'].'"><img width="30px" src="images/deltio_melous.png"/></a>
									<a title="Επεξεργασία Μέλους" href="melh_edit.php?id='.$d['melh_id'].'"><img width="25px" src="images/edit_foto.png"/></a>
									<a title="Διαγραφή Μέλους" href="javascript:validate(\'melh_del.php?id='.$d['melh_id'].'\')"><img width="25px;" src="images/deleteButton.png"/></a>
								</td>
							</tr>
						';
					}
				?>
			</table>
			</div>
			<?=load_footer()?>
	</body>
</html>