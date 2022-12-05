<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if (!empty($_POST)){
		mysqli_query($con,"SET NAMES utf8");
			$q="INSERT INTO eidikothtes (eidikothtes_name,tomeis_id)VALUES ('".$_POST['eid_name']."','".$_POST['tom_id']."')";
			mysqli_query($con,$q);				
	}
	echo head();
?>
	<body>
		<?=load_viv_header()?>
		<div id="container">
			<div id="head_container">
				<h1>Ειδικότητες</h1>
			</div>
			<div id="middle_container">
				<ol>
					<?php
						mysqli_query($con,"SET NAMES utf8");
						$q="SELECT * FROM eidikothtes";	
						$r=mysqli_query($con,$q);
						while($d=mysqli_fetch_assoc($r)){
							echo '<li>
									<span id="prom_name">'.$d['eidikothtes_name'].'</span><span id="pro_del"><a href="eidikothtes_del.php?id='.$d['eidikothtes_id'].'"><img src="images/deleteButton.png"/></a><a href="eidikothtes_edit.php?id='.$d['eidikothtes_id'].'"><img src="images/edit_foto.png"/></a></span>
								</li>';
						}
					?>
				</ol>
			</div>
			<div id="footer_container">
				<span id="footer_txt">Εισαγωγή Ειδικότητας</span>
				<form action="eidikothtes.php" method="post">
					&nbspΕιδικότητα:<input type="text" name="eid_name" size="50"/><br/>
					Τομέας:<select name="tom_id">
					<?php
					mysqli_query($con,"SET NAMES utf8");
						$q="SELECT * FROM tomeis";	
						$r=mysqli_query($con,$q);
						while($d=mysqli_fetch_assoc($r)){
							echo '<option value="'.$d['tomeis_id'].'">'.$d['tomeis_name'].'</option>';
						}
					?>
					</select>
					<br/><br/>
					<input type="submit" value="ΕΙΣΑΓΩΓΗ"/>
				</form>
			</div>
		</div>
		<?=load_footer()?>
	</body>
</html>