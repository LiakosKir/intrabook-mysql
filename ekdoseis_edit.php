<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if (!empty($_POST)){
		mysqli_query($con,"SET NAMES utf8");
		$q="UPDATE ekdoseis SET ekdoseis_name='".$_POST['ekd_name']."' WHERE ekdoseis_id=".$_GET['id']."";
		mysqli_query($con,$q);
		header('Location:ekdoseis.php');
	}
	echo head();
?>
	<body>
		<?=load_viv_header()?>
		<div id="container">
			<div id="head_container">
				<h1>Επεξεργασία Εκδοτικού Οίκου</h1>
			</div>
			<div id="middle_container">
				<ol>
					<?php
						mysqli_query($con,"SET NAMES utf8");
						$q="SELECT * FROM ekdoseis";	
						$r=mysqli_query($con,$q);
						while($d=mysqli_fetch_assoc($r)){
							echo '<li>
									<span id="prom_name">'.$d['ekdoseis_name'].'</span><span id="pro_del"><a href="ekdoseis_del.php?id='.$d['ekdoseis_id'].'"><img src="images/deleteButton.png"/></a><a href="ekdoseis_edit.php?id='.$d['ekdoseis_id'].'"><img src="images/edit_foto.png"/></a></span>
								</li>';
						}
					?>
				</ol>
			</div>
			<div id="footer_container">
				<span id="footer_txt">Επεξεργασία Εκδοτικού Οίκου</span>
				<form action="ekdoseis_edit.php?id=<?php echo $_GET['id']; ?>" method="post">
					&nbspΕπωνυμία:<input type="text" name="ekd_name" size="50" value="<?php mysqli_query($con,"SET NAMES utf8");
						$q="SELECT ekdoseis_name FROM ekdoseis WHERE ekdoseis_id='".$_GET['id']."'";	
						$r=mysqli_query($con,$q);
						$d=mysqli_fetch_assoc($r);
							echo $d['ekdoseis_name'];?>"/><br/><br/>
					<input type="submit" value="ΑΛΛΑΓΗ"/>
				</form>
			</div>
		</div>
		<?=load_footer()?>
	</body>
</html>