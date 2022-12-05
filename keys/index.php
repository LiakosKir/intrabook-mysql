<?php
echo "c:\\serverfiles\\OCX_reg-".date("Y")."-".date("m").".txt";
$handle=fopen("c:\\serverfiles\\OCX_reg-".date("Y")."-".date("m").".txt","r") or die("Error");
while($row=fgets($handle,1024))
	echo $row."<br />";
fclose($handle);
?>