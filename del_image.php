<?php
	require_once("connection.php");
	require_once("lib.php");
	echo head();
	if(is_dir('images/'.$_GET['id'])){
		if ($handle = opendir('images/'.$_GET['id'])) {								
			while (false !== ($file = readdir($handle))) {
				if(is_image("images/".$_GET['id']."/".$file))
					unlink('images/'.$_GET['id'].'/'.$_GET['pic']);
			}
			closedir($handle);
		}
	}
	header('Location:add_pic.php?id='.$_GET['id'].'');
?>