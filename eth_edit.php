<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if (!empty($_POST)){
		mysqli_query($con,"SET NAMES utf8");
		$q="UPDATE eth SET eth_name='".$_POST['etos_name']."' WHERE eth_id=".$_GET['id']."";
		mysqli_query($con,$q);
		header('Location:eth.php');
	}
	echo head();
?>
	<body>
		<?=load_viv_header()?>
		<div id="container">
			<div id="head_container">
				<h1>Επεξεργασία Έτους</h1>
			</div>
			<div id="middle_container">
				<ol>
					<?php
						mysqli_query($con,"SET NAMES utf8");
						$q="SELECT * FROM eth";	
						$r=mysqli_query($con,$q);
						while($d=mysqli_fetch_assoc($r)){
							echo '<li>
									<span id="prom_name">'.$d['eth_name'].'</span><span id="pro_del"><a href="eth_del.php?id='.$d['eth_id'].'"><img src="images/deleteButton.png"/></a><a href="eth_edit.php?id='.$d['eth_id'].'"><img src="images/edit_foto.png"/></a></span>
								</li>';
						}
					?>
				</ol>
			</div>
			<div id="footer_container">
				<span id="footer_txt">Επεξεργασία Έτους</span>
				<form action="eth_edit.php?id=<?php echo $_GET['id']; ?>" method="post">
					&nbspΕπωνυμία:<input type="text" name="etos_name" size="50" value="<?php mysqli_query($con,"SET NAMES utf8");
						$q="SELECT eth_name FROM eth WHERE eth_id='".$_GET['id']."'";	
						$r=mysqli_query($con,$q);
						$d=mysqli_fetch_assoc($r);
							echo $d['eth_name'];?>"/><br/><br/>
					<input type="submit" value="ΑΛΛΑΓΗ"/>
				</form>
			</div>
		</div>
		<?=load_footer()?>
	</body>
</html>