<?php
	require_once("connection.php");
	require_once("lib.php");
	if(!empty($_POST)){
		$q="SELECT * FROM admin WHERE admin_name='".$_POST['username']."' AND admin_desc='".$_POST['password']."'" or die($mysqli->error());
		$r=mysqli_query($con,$q);
		$d=mysqli_fetch_assoc($r);
		if(mysqli_num_rows($r)==0){
			$msg='<div id="wrong_login"><tr><td>Λάθος στα στοιχεία εισόδου. Παρακαλούμε δοκιμάστε ξανά</td></tr></div>';
		}
		else{
		header('location:index.php');
		}
	}
	echo head();
?>
<body>
	<div id="login">
		<h1>Login</h1>
            <form action="login.php" method="post">
            	<table>
                	<?php 	
						if(!empty($msg)){
							echo $msg;
							$msg='';
						}
					?>
                    <tr>
                    	<td>Username:</td><td><input type="text" name="username"/></td>
                    </tr>
                    <tr>
                    	<td>Password:</td><td><input type="password" name="password"/></td>
                    </tr>
                    <tr>
                    	<td colspan="2"><input type="submit" value="login"/></td>
                    </tr>
                </table>
            </form>
    </div>
</body>
</html>