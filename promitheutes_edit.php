<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if (!empty($_POST)){
		mysqli_query($con,"SET NAMES utf8");
		$q="UPDATE promitheutis SET promitheutis_name='".$_POST['prom_name']."' WHERE promitheutis_id=".$_GET['id']."";
		mysqli_query($con,$q);
		header('Location:promitheutes.php');
	}
	echo head();
?>
	<body>
		<?=load_header()?>
		<div id="container">
			<div id="head_container">
				<h1>Επεξεργασία Προμηθευτή</h1>
			</div>
			<div id="middle_container">
				<ol>
					<?php
						mysqli_query($con,"SET NAMES utf8");
						$q="SELECT * FROM promitheutis";	
						$r=mysqli_query($con,$q);
						while($d=mysqli_fetch_assoc($r)){
							echo '<li>
									<span id="prom_name">'.$d['promitheutis_name'].'</span><span id="pro_del"><a href="promitheutes_del.php?id='.$d['promitheutis_id'].'"><img src="images/deleteButton.png"/></a><a href="promitheutes_edit.php?id='.$d['promitheutis_id'].'"><img src="images/edit_foto.png"/></a></span>
								</li>';
						}
					?>
				</ol>
			</div>
			<div id="footer_container">
				<span id="footer_txt">Επεξεργασία Προμηθευτή</span>
				<form action="promitheutes_edit.php?id=<?php echo $_GET['id']; ?>" method="post">
					&nbspΕπωνυμία:<input type="text" name="prom_name" size="50" value="<?php mysqli_query($con,"SET NAMES utf8");
						$q="SELECT promitheutis_name FROM promitheutis WHERE promitheutis_id='".$_GET['id']."'";	
						$r=mysqli_query($con,$q);
						$d=mysqli_fetch_assoc($r);
							echo $d['promitheutis_name'];?>"/><br/><br/>
					<input type="submit" value="ΑΛΛΑΓΗ"/>
				</form>
			</div>
		</div>
		<?=load_footer()?>
	</body>
</html>