<?php
session_start();

$filename = basename($_FILES['uploadedfile']['name']);
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo "Invalid filename or No file selected. Redirect in 3 sec";
	Header("Refresh: 3;control.php");
	exit;
}

$username = $_SESSION['username'];

//Reference: https://www.w3schools.com/php/func_filesystem_file_exists.asp
if(file_exists(sprintf("/home/yz/user/%s/%s", $username, $filename))){
	echo "Same file exits. Redirect in 3 sec";
	Header("Refresh: 3;control.php");
	exit;
}

$full_path = sprintf("/home/yz/user/%s/%s", $username, $filename);

if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
	header("Location: control.php");
	exit;
}else{
	echo "Something wrong, file has not been uploaded. Redirect in 3 sec.";
	Header("Refresh: 3;control.php");
	exit;
}

?>