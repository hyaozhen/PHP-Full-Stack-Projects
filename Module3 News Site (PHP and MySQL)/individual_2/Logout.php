<?php
session_start();

$click = $_POST["click"];
	
if (htmlentities($click) == "Logout"){
	session_unset(); //remove all session variables, reference: https://www.w3schools.com/php/php_sessions.asp
	session_destroy();

	echo "Successfully Logout. Redirect to Login in 3 sec";
	Header("Refresh: 3; example.php");
	} elseif (htmlentities($click) == "Go back"){
	Header("Location:example.php");
	}
?>

