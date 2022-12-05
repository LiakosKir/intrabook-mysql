<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if (!empty($_POST)){
		mysqli_query($con,"SET NAMES utf8");
		$q="UPDATE tomeas SET tomeas_name='".$_POST['tom_name']."' WHERE tomeas_id=".$_GET['id']."";
		mysqli_query($con,$q);
		header('Location:tomeas.php');
	}
	echo head();
?>
	<body>
	<?=load_header()?>
		<div id="container">
			<div id="head_container">
				<h1>Επεξεργασία Τομέα</h1>
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
				<span id="footer_txt">Επεξεργασία Τομέα</span>
				<form action="tomeas_edit.php?id=<?php echo $_GET['id']; ?>" method="post">
					&nbspΕπωνυμία:<input type="text" name="tom_name" size="50" value="<?php mysqli_query($con,"SET NAMES utf8");
						$q="SELECT tomeas_name FROM tomeas WHERE tomeas_id='".$_GET['id']."'";	
						$r=mysqli_query($con,$q);
						$d=mysqli_fetch_assoc($r);
							echo $d['tomeas_name'];?>"/><br/><br/>
					<input type="submit" value="ΑΛΛΑΓΗ"/>
				</form>
			</div>
		</div>
		<?=load_footer()?>
	</body>
</html>