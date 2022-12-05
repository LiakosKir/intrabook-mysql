<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	echo head();
?>
<body>
<?=load_header()?>
	<div id="view_container">
	<h1 class="headlines">
		ΠΡΟΒΟΛΗ ΕΞΟΠΛΙΣΜΟΥ
	</h1>
	<div id="content">
        <?php
				if(!empty($_GET)){
					$q2="SELECT * FROM eidos 
						INNER JOIN xwros ON eidos.xwros_id=xwros.xwros_id
						WHERE eidos.ktirio_id LIKE '".$_GET['ktirio']."' AND eidos.tomeas_id LIKE '".$_GET['tomeas']."' 
						GROUP BY xwros.xwros_name";
					$r2=mysqli_query($con,$q2);
					echo '
					<div id="TabbedPanels1" class="TabbedPanels">
 						 <ul class="TabbedPanelsTabGroup">';
					$tab_ids=array();
					while($d2=mysqli_fetch_assoc($r2)){
						echo '<li class="TabbedPanelsTab" tabindex="0">'.$d2['xwros_name'].'</li>';
						$tab_ids[]=$d2['xwros_id'];
					}
				echo '</ul><div class="TabbedPanelsContentGroup">';
					foreach($tab_ids as $id=>$data){				
						$tabs_data=mysqli_query($con,"SELECT * FROM eidos 
					INNER JOIN typos ON eidos.typos_id=typos.typos_id
					INNER JOIN ktirio ON eidos.ktirio_id=ktirio.ktirio_id
					INNER JOIN xwros ON eidos.xwros_id=xwros.xwros_id
					INNER JOIN tomeas ON eidos.tomeas_id=tomeas.tomeas_id WHERE eidos.xwros_id LIKE '".$data."'");						
						echo '<div class="TabbedPanelsContent"><table class="tables">
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
								</tr>';
						while($d3=mysqli_fetch_assoc($tabs_data)){
							echo '<tr>
							<td>'.$d3['eidos_id'].'</td>
							<td>'.$d3['typos_name'].'</td>
							<td>'.$d3['eidos_xaraktiristika'].'</td>
							<td>'.$d3['eidos_thesi_xristis'].'</td>
							<td>'.$d3['ktirio_name'].'</td>
							<td>'.$d3['eidos_posotita'].'</td>
							<td>'.$d3['xwros_name'].'</td>
							<td>'.$d3['tomeas_name'].'</td>
							<td>'.date("d/m/Y",$d3['hmer_kataxwrisis']).'</td>
						</tr>';
						}
						echo '</table>
								</div>';
					}
  				echo '</div></div>';
				}
			?>
     <script type="text/javascript">
		<!--
		var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
		//-->
	</script>
    </div>
	<?=load_footer()?>
</body>
</html>
