<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if (!empty($_POST)){
		mysqli_query($con,"SET NAMES utf8");
			$q="INSERT INTO tomeis (tomeis_name)VALUES ('".$_POST['tom_name']."')";
			mysqli_query($con,$q);				
	}
	echo head();
?>
	<body>
		<?=load_viv_header()?>
		<div id="container">
			<div id="head_container">
				<h1>Τομείς</h1>
			</div>
			<div id="middle_container">
				<ol>
					<?php
						mysqli_query($con,"SET NAMES utf8");
						$q="SELECT * FROM tomeis";	
						$r=mysqli_query($con,$q);
						while($d=mysqli_fetch_assoc($r)){
							echo '<li>
									<span id="prom_name">'.$d['tomeis_name'].'</span><span id="pro_del"><a href="tomeis_del.php?id='.$d['tomeis_id'].'"><img src="images/deleteButton.png"/></a><a href="tomeis_edit.php?id='.$d['tomeis_id'].'"><img src="images/edit_foto.png"/></a></span>
								</li>';
						}
					?>
				</ol>
			</div>
			<div id="footer_container">
				<span id="footer_txt">Εισαγωγή Τομέα</span>
				<form action="tomeis.php" method="post">
					&nbspΟνομασία:<input type="text" name="tom_name" size="50"/><br/><br/>
					<input type="submit" value="ΕΙΣΑΓΩΓΗ"/>
				</form>
			</div>
		</div>
		<?=load_footer()?>
	</body>
</html>