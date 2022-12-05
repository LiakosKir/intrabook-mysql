<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if (!empty($_POST)){
		mysqli_query($con,"SET NAMES utf8");
		$q="UPDATE katigories SET katigories_name='".$_POST['kat_name']."' WHERE katigories_id=".$_GET['id']."";
		mysqli_query($con,$q);
		header('Location:katigories.php');
	}
	echo head();
?>
	<body>
		<?=load_viv_header()?>
		<div id="container">
			<div id="head_container">
				<h1>Επεξεργασία Κατηγορίας</h1>
			</div>
			<div id="middle_container">
				<ol>
					<?php
						mysqli_query($con,"SET NAMES utf8");
						$q="SELECT * FROM katigories";	
						$r=mysqli_query($con,$q);
						while($d=mysqli_fetch_assoc($r)){
							echo '<li>
									<span id="prom_name">'.$d['katigories_name'].'</span><span id="pro_del"><a href="katigories_del.php?id='.$d['katigories_id'].'"><img src="images/deleteButton.png"/></a><a href="katigories_edit.php?id='.$d['katigories_id'].'"><img src="images/edit_foto.png"/></a></span>
								</li>';
						}
					?>
				</ol>
			</div>
			<div id="footer_container">
				<span id="footer_txt">Επεξεργασία Κατηγορίας</span>
				<form action="katigories_edit.php?id=<?php echo $_GET['id']; ?>" method="post">
					&nbspΕπωνυμία:<input type="text" name="kat_name" size="50" value="<?php mysqli_query($con,"SET NAMES utf8");
						$q="SELECT katigories_name FROM katigories WHERE katigories_id='".$_GET['id']."'";	
						$r=mysqli_query($con,$q);
						$d=mysqli_fetch_assoc($r);
							echo $d['katigories_name'];?>"/><br/><br/>
					<input type="submit" value="ΑΛΛΑΓΗ"/>
				</form>
			</div>
		</div>
		<?=load_footer()?>
	</body>
</html>