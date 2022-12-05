<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if (!empty($_POST)){
		mysqli_query($con,"SET NAMES utf8");
		$q="UPDATE ktirio SET ktirio_name='".$_POST['ktir_name']."' WHERE ktirio_id=".$_GET['id']."";
		mysqli_query($con,$q);
		header('Location:ktirio.php');
	}
	echo head();
?>
	<body>
	<?=load_header()?>
		<div id="container">
			<div id="head_container">
				<h1>Επεξεργασία Κτιρίου</h1>
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
				<span id="footer_txt">Επεξεργασία Κτιρίου</span>
				<form action="ktirio_edit.php?id=<?php echo $_GET['id']; ?>" method="post">
					&nbspΕπωνυμία:<input type="text" name="ktir_name" size="50" value="<?php mysqli_query($con,"SET NAMES utf8");
						$q="SELECT ktirio_name FROM ktirio WHERE ktirio_id='".$_GET['id']."'";	
						$r=mysqli_query($con,$q);
						$d=mysqli_fetch_assoc($r);
							echo $d['ktirio_name'];?>"/><br/><br/>
					<input type="submit" value="ΑΛΛΑΓΗ"/>
				</form>
			</div>
		</div>
		<?=load_footer()?>
	</body>
</html>