<?php
	$newuser = $_POST["newuser"];
	$file = fopen("user.txt","w");
	$file = fwrite($file,$newuser);
	fclose($file);
	echo "New user "+$newuser+" is created".
?>