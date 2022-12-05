<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if (!empty($_POST)){
		mysqli_query($con,"SET NAMES utf8");
			$q="INSERT INTO epipeda (epipeda_name)VALUES ('".$_POST['lvl_name']."')";
			mysqli_query($con,$q);				
	}
	echo head();
?>
	<body>
		<?=load_viv_header()?>
		<div id="container">
			<div id="head_container">
				<h1>Επίπεδα</h1>
			</div>
			<div id="middle_container">
				<ol>
					<?php
						mysqli_query($con,"SET NAMES utf8");
						$q="SELECT * FROM epipeda";	
						$r=mysqli_query($con,$q);
						while($d=mysqli_fetch_assoc($r)){
							echo '<li>
									<span id="prom_name">'.$d['epipeda_name'].'</span><span id="pro_del"><a href="epipeda_del.php?id='.$d['epipeda_id'].'"><img src="images/deleteButton.png"/></a><a href="epipeda_edit.php?id='.$d['epipeda_id'].'"><img src="images/edit_foto.png"/></a></span>
								</li>';
						}
					?>
				</ol>
			</div>
			<div id="footer_container">
				<span id="footer_txt">Εισαγωγή Επιπέδου</span>
				<form action="epipeda.php" method="post">
					&nbspΟνομασία:<input type="text" name="lvl_name" size="50"/><br/><br/>
					<input type="submit" value="ΕΙΣΑΓΩΓΗ"/>
				</form>
			</div>
		</div>
		<?=load_footer()?>
	</body>
</html>