<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if (!empty($_POST)){
		mysqli_query($con,"SET NAMES utf8");
		$q="UPDATE eidikothtes SET eidikothtes_name='".$_POST['eid_name']."' WHERE eidikothtes_id=".$_GET['id']."";
		mysqli_query($con,$q);
		header('Location:eidikothtes.php');
	}
	echo head();
?>
	<body>
		<?=load_viv_header()?>
		<div id="container">
			<div id="head_container">
				<h1>Επεξεργασία Ειδικότητας</h1>
			</div>
			<div id="middle_container">
				<ol>
					<?php
						mysqli_query($con,"SET NAMES utf8");
						$q="SELECT * FROM eidikothtes";	
						$r=mysqli_query($con,$q);
						while($d=mysqli_fetch_assoc($r)){
							echo '<li>
									<span id="prom_name">'.$d['eidikothtes_name'].'</span><span id="pro_del"><a href="eidikothtes_del.php?id='.$d['eidikothtes_id'].'"><img src="images/deleteButton.png"/></a><a href="eidikothtes_edit.php?id='.$d['eidikothtes_id'].'"><img src="images/edit_foto.png"/></a></span>
								</li>';
						}
					?>
				</ol>
			</div>
			<div id="footer_container">
				<span id="footer_txt">Επεξεργασία Ειδικότητας</span>
				<form action="eidikothtes_edit.php?id=<?php echo $_GET['id']; ?>" method="post">
					&nbspΕπωνυμία:<input type="text" name="eid_name" size="50" value="<?php mysqli_query($con,"SET NAMES utf8");
						$q="SELECT eidikothtes_name FROM eidikothtes WHERE eidikothtes_id='".$_GET['id']."'";	
						$r=mysqli_query($con,$q);
						$d=mysqli_fetch_assoc($r);
							echo $d['eidikothtes_name'];?>"/><br/><br/>
					<input type="submit" value="ΑΛΛΑΓΗ"/>
				</form>
			</div>
		</div>
		<?=load_footer()?>
	</body>
</html>