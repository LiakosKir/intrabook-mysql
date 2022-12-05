<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if (!empty($_POST)){
		mysqli_query($con,"SET NAMES utf8");
			$q="INSERT INTO ktirio (ktirio_name)VALUES ('".$_POST['ktir_name']."')";
			mysqli_query($con,$q);				
	}
	echo head();
?>
	<body>
	<?=load_header()?>
		<div id="container">
			<div id="head_container">
				<h1>Κτίρια</h1>
			</div>
			<div id="middle_container">
				<ol>
					<?php
						mysqli_query($con,"SET NAMES utf8");
						$q="SELECT * FROM ktirio";	
						$r=mysqli_query($con,$q);
						while($d=mysqli_fetch_assoc($r)){
							echo '<li>
									<span id="prom_name">'.$d['ktirio_name'].'</span><span id="pro_del"><a href="ktirio_del.php?id='.$d['ktirio_id'].'"><img src="images/deleteButton.png"/></a><a href="ktirio_edit.php?id='.$d['ktirio_id'].'"><img src="images/edit_foto.png"/></a></span>
								</li>';
						}
					?>
				</ol>
			</div>
			<div id="footer_container">
				<span id="footer_txt">Εισαγωγή Κτιρίου</span>
				<form action="ktirio.php" method="post">
					&nbspΕπωνυμία:<input type="text" name="ktir_name" size="50"/><br/><br/>
					<input type="submit" value="ΕΙΣΑΓΩΓΗ"/>
				</form>
			</div>
		</div>
		<?=load_footer()?>
	</body>
</html>