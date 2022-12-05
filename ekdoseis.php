<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if (!empty($_POST)){
		mysqli_query($con,"SET NAMES utf8");
			$q="INSERT INTO ekdoseis (ekdoseis_name)VALUES ('".$_POST['ekd_name']."')";
			mysqli_query($con,$q);				
	}
	echo head();
?>
	<body>
		<?=load_viv_header()?>
		<div id="container">
			<div id="head_container">
				<h1>Εκδοτικοί Οίκοι</h1>
			</div>
			<div id="middle_container">
				<ol>
					<?php
						mysqli_query($con,"SET NAMES utf8");
						$q="SELECT * FROM ekdoseis";	
						$r=mysqli_query($con,$q);
						while($d=mysqli_fetch_assoc($r)){
							echo '<li>
									<span id="prom_name">'.$d['ekdoseis_name'].'</span><span id="pro_del"><a href="ekdoseis_del.php?id='.$d['ekdoseis_id'].'"><img src="images/deleteButton.png"/></a><a href="ekdoseis_edit.php?id='.$d['ekdoseis_id'].'"><img src="images/edit_foto.png"/></a></span>
								</li>';
						}
					?>
				</ol>
			</div>
			<div id="footer_container">
				<span id="footer_txt">Εισαγωγή Έκδοτικού Οίκου</span>
				<form action="ekdoseis.php" method="post">
					&nbspΟνομασία:<input type="text" name="ekd_name" size="50"/><br/><br/>
					<input type="submit" value="ΕΙΣΑΓΩΓΗ"/>
				</form>
			</div>
		</div>
		<?=load_footer()?>
	</body>
</html>