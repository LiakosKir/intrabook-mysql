<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if (!empty($_POST)){
		mysqli_query($con,"SET NAMES utf8");
			$q="INSERT INTO xwros(xwros_name)VALUES ('".$_POST['xwros_name']."')";
			mysqli_query($con,$q);				
	}
	echo head();
?>
	<body>
	<?=load_header()?>
		<div id="container">
			<div id="head_container">
				<h1>Χώρος</h1>
			</div>
			<div id="middle_container">
				<ol>
					<?php
						mysqli_query($con,"SET NAMES utf8");
						$q="SELECT * FROM xwros";	
						$r=mysqli_query($con,$q);
						while($d=mysqli_fetch_assoc($r)){
							echo '<li>
									<span id="prom_name">'.$d['xwros_name'].'</span><span id="pro_del"><a href="xwros_del.php?id='.$d['xwros_id'].'"><img src="images/deleteButton.png"/></a><a href="xwros_edit.php?id='.$d['xwros_id'].'"><img src="images/edit_foto.png"/></a></span>
								</li>';
						}
					?>
				</ol>
			</div>
			<div id="footer_container">
				<span id="footer_txt">Εισαγωγή Χώρου</span>
				<form action="xwros.php" method="post">
					&nbsp;Επωνυμία:<input type="text" name="xwros_name" size="50"/><br/><br/>
                    <input type="submit" value="ΕΙΣΑΓΩΓΗ"/>
				</form>
			</div>
		</div>
		<?=load_footer()?>
	</body>
</html>