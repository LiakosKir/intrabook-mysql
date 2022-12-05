<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if (!empty($_POST)){
		mysqli_query($con,"SET NAMES utf8");
		$q="UPDATE xwros SET xwros_name='".$_POST['xwros_name']."' WHERE xwros_id=".$_GET['id']."";
		mysqli_query($con,$q);
		header('Location:xwros.php');
	}
	echo head();
?>
	<body>
	<?=load_header()?>
		<div id="container">
			<div id="head_container">
				<h1>Επεξεργασία Χώρου</h1>
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
				<span id="footer_txt">Επεξεργασία Χώρου</span>
				<form action="xwros_edit.php?id=<?php echo $_GET['id']; ?>" method="post">
					&nbspΕπωνυμία:<input type="text" name="xwros_name" size="50" value="<?php mysqli_query($con,"SET NAMES utf8");
						$q="SELECT xwros_name FROM xwros WHERE xwros_id='".$_GET['id']."'";	
						$r=mysqli_query($con,$q);
						$d=mysqli_fetch_assoc($r);
							echo $d['xwros_name'];?>"/><br/><br/>
					<input type="submit" value="ΑΛΛΑΓΗ"/>
				</form>
			</div>
		</div>
		<?=load_footer()?>
	</body>
</html>