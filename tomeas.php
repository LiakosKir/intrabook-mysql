<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if (!empty($_POST)){
		mysqli_query($con,"SET NAMES utf8");
			$q="INSERT INTO tomeas (tomeas_name)VALUES ('".$_POST['tom_name']."')";
			mysqli_query($con,$q);				
	}
	echo head();
?>
	<body>
	<?=load_header()?>
		<div id="container">
			<div id="head_container">
				<h1>Τομέας</h1>
			</div>
			<div id="middle_container">
				<ol>
					<?php
						mysqli_query($con,"SET NAMES utf8");
						$q="SELECT * FROM tomeas";	
						$r=mysqli_query($con,$q);
						while($d=mysqli_fetch_assoc($r)){
							echo '<li>
									<span id="prom_name">'.$d['tomeas_name'].'</span><span id="pro_del"><a href="tomeas_del.php?id='.$d['tomeas_id'].'"><img src="images/deleteButton.png"/></a><a href="tomeas_edit.php?id='.$d['tomeas_id'].'"><img src="images/edit_foto.png"/></a></span>
								</li>';
						}
					?>
				</ol>
			</div>
			<div id="footer_container">
				<span id="footer_txt">Εισαγωγή Τομέα</span>
				<form action="tomeas.php" method="post">
					&nbspΕπωνυμία:<input type="text" name="tom_name" size="50"/><br/><br/>
					<input type="submit" value="ΕΙΣΑΓΩΓΗ"/>
				</form>
			</div>
		</div>
		<?=load_footer()?>
	</body>
</html>