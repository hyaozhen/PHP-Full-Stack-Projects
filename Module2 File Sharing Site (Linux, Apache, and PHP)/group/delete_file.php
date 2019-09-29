<?php
session_start();
$filename = $_GET['file'];
$username = $_SESSION['username'];
$full_path = sprintf("/home/yz/user/%s/%s", $username, $filename);
if (unlink($full_path)){ //reference: https://www.w3schools.com/php/func_filesystem_unlink.asp
	echo "File has been deleted successfully. Redirect in 3 sec.";
	Header("Refresh: 3;control.php");
	
}else {
	echo "Something wrong, file has not been deleted. Redirect in 3 sec.";
	Header("Refresh: 3;control.php");
}
?>