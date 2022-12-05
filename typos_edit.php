<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if (!empty($_POST)){
		mysqli_query($con,"SET NAMES utf8");
		$q="UPDATE typos SET typos_name='".$_POST['typos_name']."' WHERE typos_id=".$_GET['id']."";
		mysqli_query($con,$q);
		header('Location:typos.php');
	}
	echo head();
?>
	<body>
	<?=load_header()?>
		<div id="container">
			<div id="head_container">
				<h1>Επεξεργασία Τύπου Εξοπλισμού</h1>
			</div>
			<div id="middle_container">
				<ol>
					<?php
						mysqli_query($con,"SET NAMES utf8");
						$q="SELECT * FROM typos";	
						$r=mysqli_query($con,$q);
						while($d=mysqli_fetch_assoc($r)){
							echo '<li>
									<span id="prom_name">'.$d['typos_name'].'</span><span id="pro_del"><a href="typos_del.php?id='.$d['typos_id'].'"><img src="images/deleteButton.png"/></a><a href="typos_edit.php?id='.$d['typos_id'].'"><img src="images/edit_foto.png"/></a></span>
								</li>';
						}
					?>
				</ol>
			</div>
			<div id="footer_container">
				<span id="footer_txt">Επεξεργασία Τύπου Εξοπλισμού</span>
				<form action="typos_edit.php?id=<?php echo $_GET['id']; ?>" method="post">
					&nbspΕπωνυμία:<input type="text" name="typos_name" size="50" value="<?php mysqli_query($con,"SET NAMES utf8");
						$q="SELECT typos_name FROM typos WHERE typos_id='".$_GET['id']."'";	
						$r=mysqli_query($con,$q);
						$d=mysqli_fetch_assoc($r);
							echo $d['typos_name'];?>"/><br/><br/>
					<input type="submit" value="ΑΛΛΑΓΗ"/>
				</form>
			</div>
		</div>
		<?=load_footer()?>
	</body>
</html>