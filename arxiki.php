<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	echo head();
?>
	<body style="width:100% !important;">
		<?=load_general_header()?>
		<ul id="epiloges_container">
			<li>
				<a href="apografi_start.php"><img src="images/apo_button.png"/></a>
			</li>
			<li>
				<a href="vivliothiki_start.php"><img src="images/viv_button.png"/></a>
			</li>
			<li>
				<a href="user_management.php"><img src="images/user_tool_button.png"/></a>
			</li>
			<li>
				<a href="bibliopwleio_start.php"><img src="images/vivliopwleio_button.png"/></a>
			</li>
		</ul>
		<?=load_footer()?>
    </body>
</html>