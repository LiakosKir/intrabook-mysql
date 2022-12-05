<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	echo head();
?>
<body>
	<?=load_header()?>
	<div id="eidos_edit">
		<h1 class="headlines">Προβολή / Εισαγωγή Εικόνας</h1>
		<form style="margin:10px 0 5px 0;" action="eidos_edit.php" method="post">
			<input type="text" name="eidos" id="eidos" value="" AUTOCOMPLETE="off"/>
			<input type="submit" name="search_btn" id="search_btn" value="Αναζήτηση"/>
		</form>
		<table class="tables">
			<tr>
				<th>Κωδικός Είδους</th>
				<th>Τύπος Εξοπλισμού</th>
				<th>Χαρακτηριστικά</th>
				<th>Θέση/Χρήστης</th>
				<th>Κτίριο</th>
				<th>Ποσότητα</th>
				<th>Χώρος</th>
				<th>Τομέας</th>
                <th>Ημερομηνία Καταχώρησης</th>
				<th>&nbsp;</th>
			</tr>
			<?php
				mysqli_query($con,"SET NAMES utf8");
				if (!empty($_POST['eidos'])){
					$q="SELECT * FROM eidos 
					INNER JOIN typos ON eidos.typos_id=typos.typos_id
					INNER JOIN ktirio ON eidos.ktirio_id=ktirio.ktirio_id
					INNER JOIN xwros ON eidos.xwros_id=xwros.xwros_id
					INNER JOIN tomeas ON eidos.tomeas_id=tomeas.tomeas_id 
					WHERE eidos_id LIKE '%".$_POST['eidos']."%'
					order by hmer_kataxwrisis DESC limit 0,100";
				}
				else{
					$q="SELECT * FROM eidos 
					INNER JOIN typos ON eidos.typos_id=typos.typos_id
					INNER JOIN ktirio ON eidos.ktirio_id=ktirio.ktirio_id
					INNER JOIN xwros ON eidos.xwros_id=xwros.xwros_id
					INNER JOIN tomeas ON eidos.tomeas_id=tomeas.tomeas_id
					order by hmer_kataxwrisis DESC limit 0,100";
				}
				$r=mysqli_query($con,$q);
				while($d=mysqli_fetch_assoc($r)){
					echo '
						<tr>
							<td>'.$d['eidos_id'].'</td>
							<td>'.$d['typos_name'].'</td>
							<td>'.$d['eidos_xaraktiristika'].'</td>
							<td>'.$d['eidos_thesi_xristis'].'</td>
							<td>'.$d['ktirio_name'].'</td>
							<td>'.$d['eidos_posotita'].'</td>
							<td>'.$d['xwros_name'].'</td>
							<td>'.$d['tomeas_name'].'</td>
							<td>'.date("d/m/Y",$d['hmer_kataxwrisis']).'</td>
							<td ><a style="text-decoration:none;color:#000;" href="add_pic.php?id='.$d['eidos_id'].'"><img title="Εισαγωγή Εικόνας" src="images/edit_foto.png"/></a></td>
						</tr>
					';
				}
			?>
		</table>
	</div>
	<?=load_footer()?>
</body>
</html>
