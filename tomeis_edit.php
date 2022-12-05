<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if (!empty($_POST)){
		mysqli_query($con,"SET NAMES utf8");
		$q="UPDATE tomeis SET tomeis_name='".$_POST['tom_name']."' WHERE tomeis_id=".$_GET['id']."";
		mysqli_query($con,$q);
		header('Location:tomeis.php');
	}
	echo head();
?>
	<body>
		<?=load_viv_header()?>
		<div id="container">
			<div id="head_container">
				<h1>Επεξεργασία Τομέα</h1>
			</div>
			<div id="middle_container">
				<ol>
					<?php
						mysqli_query($con,"SET NAMES utf8");
						$q="SELECT * FROM tomeis";	
						$r=mysqli_query($con,$q);
						while($d=mysqli_fetch_assoc($r)){
							echo '<li>
									<span id="prom_name">'.$d['tomeis_name'].'</span><span id="pro_del"><a href="tomeis_del.php?id='.$d['tomeis_id'].'"><img src="images/deleteButton.png"/></a><a href="tomeis_edit.php?id='.$d['tomeis_id'].'"><img src="images/edit_foto.png"/></a></span>
								</li>';
						}
					?>
				</ol>
			</div>
			<div id="footer_container">
				<span id="footer_txt">Επεξεργασία Τομέα</span>
				<form action="tomeis_edit.php?id=<?php echo $_GET['id']; ?>" method="post">
					&nbspΕπωνυμία:<input type="text" name="tom_name" size="50" value="<?php mysqli_query($con,"SET NAMES utf8");
						$q="SELECT tomeis_name FROM tomeis WHERE tomeis_id='".$_GET['id']."'";	
						$r=mysqli_query($con,$q);
						$d=mysqli_fetch_assoc($r);
							echo $d['tomeis_name'];?>"/><br/><br/>
					<input type="submit" value="ΑΛΛΑΓΗ"/>
				</form>
			</div>
		</div>
		<?=load_footer()?>
	</body>
</html>