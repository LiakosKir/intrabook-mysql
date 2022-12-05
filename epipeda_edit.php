<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if (!empty($_POST)){
		mysqli_query($con,"SET NAMES utf8");
		$q="UPDATE epipeda SET epipeda_name='".$_POST['lvl_name']."' WHERE epipeda_id=".$_GET['id']."";
		mysqli_query($con,$q);
		header('Location:epipeda.php');
	}
	echo head();
?>
	<body>
		<?=load_viv_header()?>
		<div id="container">
			<div id="head_container">
				<h1>Επεξεργασία Επιπέδου</h1>
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
				<span id="footer_txt">Επεξεργασία Επιπέδου</span>
				<form action="epipeda_edit.php?id=<?php echo $_GET['id']; ?>" method="post">
					&nbspΕπωνυμία:<input type="text" name="lvl_name" size="50" value="<?php mysqli_query($con,"SET NAMES utf8");
						$q="SELECT epipeda_name FROM epipeda WHERE epipeda_id='".$_GET['id']."'";	
						$r=mysqli_query($con,$q);
						$d=mysqli_fetch_assoc($r);
							echo $d['epipeda_name'];?>"/><br/><br/>
					<input type="submit" value="ΑΛΛΑΓΗ"/>
				</form>
			</div>
		</div>
		<?=load_footer()?>
	</body>
</html>