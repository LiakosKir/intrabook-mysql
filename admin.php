<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	if (!empty($_POST)){
		mysqli_query($con,"SET NAMES utf8");
			$q="INSERT INTO admin(admin_name,admin_desc,etairia_id)VALUES ('".$_POST['admin_name']."','".$_POST['admin_desc']."','".$_POST['etairia']."')";
			mysqli_query($con,$q);				
	}
	echo head();
?>
	<body>
		<div id="container">
			<div id="head_container">
				<h1>Χρήστες</h1>
			</div>
			<div id="middle_container">
				<ol>
					<?php
						mysqli_query($con,"SET NAMES utf8");
						$q="SELECT * FROM admin";	
						$r=mysqli_query($con,$q);
						while($d=mysqli_fetch_assoc($r)){
							echo '<li>
									<span id="prom_name">'.$d['admin_name'].'</span><span id="pro_del"><a href="admin_del.php?id='.$d['admin_id'].'"><img src="images/deleteButton.png"/></a><a href="admin_edit.php?id='.$d['admin_id'].'"><img src="images/edit_foto.png"/></a></span>
								</li>';
						}
					?>
				</ol>
			</div>
			<div id="footer_container">
				<span id="footer_txt">Εισαγωγή Χρήστη</span>
				<form action="admin.php" method="post">
					&nbspUsername:<input type="text" name="admin_name" size="50"/><br/><br/>
                    &nbspPassword:<input type="password" name="admin_desc" size="50"/><br/><br/>
                    <select name="etairia">
                    	<option>Θεσσαλονίκη</option>
                        <option>Αθήνα</option>
                    </select>
					<input type="submit" value="ΕΙΣΑΓΩΓΗ"/>
				</form>
			</div>
            <?=load_back()?>
		</div>
		<?=load_footer()?>
	</body>
</html>