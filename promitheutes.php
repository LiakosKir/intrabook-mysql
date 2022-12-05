<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if (!empty($_POST)){
		mysqli_query($con,"SET NAMES utf8");
			$q="INSERT INTO promitheutis (promitheutis_name)VALUES ('".$_POST['prom_name']."')";
			mysqli_query($con,$q);				
	}
	echo head();
?>
	<body>
		<?=load_header()?>
		<div id="container">
			<div id="head_container">
				<h1>Προμηθευτές</h1>
			</div>
			<div id="middle_container">
				<ol>
					<?php
						mysqli_query($con,"SET NAMES utf8");
						$q="SELECT * FROM promitheutis";	
						$r=mysqli_query($con,$q);
						while($d=mysqli_fetch_assoc($r)){
							echo '<li>
									<span id="prom_name">'.$d['promitheutis_name'].'</span><span id="pro_del"><a href="promitheutes_del.php?id='.$d['promitheutis_id'].'"><img src="images/deleteButton.png"/></a><a href="promitheutes_edit.php?id='.$d['promitheutis_id'].'"><img src="images/edit_foto.png"/></a></span>
								</li>';
						}
					?>
				</ol>
			</div>
			<div id="footer_container">
				<span id="footer_txt">Εισαγωγή Προμηθευτή</span>
				<form action="promitheutes.php" method="post">
					&nbspΕπωνυμία:<input type="text" name="prom_name" size="50"/><br/><br/>
					<input type="submit" value="ΕΙΣΑΓΩΓΗ"/>
				</form>
			</div>
		</div>
		<?=load_footer()?>
	</body>
</html>