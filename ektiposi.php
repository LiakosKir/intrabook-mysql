<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	echo head();
?>
<body>
	<div id="ekt_container">
		<img class="img_width" src="images/logo_black.png"/>
		<?php
		 if (!empty($_GET['xwros']) && ($_GET['ktirio'])){
			mysqli_query($con,"SET NAMES utf8");
			$q1="SELECT *
				FROM eidos 
				INNER JOIN ktirio ON eidos.ktirio_id=ktirio.ktirio_id
				INNER JOIN xwros ON eidos.xwros_id=xwros.xwros_id
				INNER JOIN tomeas ON eidos.tomeas_id=tomeas.tomeas_id
				WHERE xwros.xwros_id LIKE '".$_GET['xwros']."' AND ktirio.ktirio_id LIKE '".$_GET['ktirio']."'";
			$r1=mysqli_query($con,$q1);
			$d1=mysqli_fetch_assoc($r1);
			echo '<h3 class="aln_mdll">'.$d1['xwros_name'].'</h3>
				<h3 class="aln_mdll">'.$d1['ktirio_name'].'</h3>
				<h3	class="aln_mdll">'.$d1['tomeas_name'].'</h3>';
			mysqli_query($con,"SET NAMES utf8");
			$q="SELECT *, SUM( eidos.eidos_posotita ) AS posotita
				FROM eidos 
				INNER JOIN typos ON eidos.typos_id=typos.typos_id
				INNER JOIN ktirio ON eidos.ktirio_id=ktirio.ktirio_id
				INNER JOIN xwros ON eidos.xwros_id=xwros.xwros_id
				INNER JOIN tomeas ON eidos.tomeas_id=tomeas.tomeas_id
				WHERE xwros.xwros_id LIKE '".$_GET['xwros']."' AND ktirio.ktirio_id LIKE '".$_GET['ktirio']."' GROUP BY typos.typos_id";		
			$r=mysqli_query($con,$q);
			echo '<table  id="ekt_provoli">
					<tr>
						<th>A/A</th>
						<th>Περιγραφή</th>
						<th>Ποσότητα</th>
					</tr>';
			$aa=1;
			while($d=mysqli_fetch_assoc($r)){
				echo '<tr>
						<td>'.$aa.'</td>
						<td>'.$d['typos_name'].'</td>
						<td>'.$d['posotita'].'</td>
					</tr>';
				$aa++;
			}
			echo '</table>';
		}
		?>
	</div>
</body>
</html>