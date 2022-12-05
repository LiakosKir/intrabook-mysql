<?php
	require("connection.php");
	require("lib.php");
	echo login_validation();
	echo head();
?>
	<body>
		<?=load_header()?>
		<?=load_footer()?>
    </body>
</html>