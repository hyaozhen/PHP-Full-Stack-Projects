<?php
session_start();

$click = $_POST["click"];
	
if (htmlentities($click) == "Logout"){
	session_unset(); //remove all session variables, reference: https://www.w3schools.com/php/php_sessions.asp
	session_destroy();
// 	I use next two lines to replace strings in the user.txt file with help from 
//  https://stackoverflow.com/questions/11901521/replace-string-in-text-file-using-php/24240869
	$newrecord=preg_replace("/record/", "",file_get_contents("/home/yz/loginfo/record.txt"),1);
  	file_put_contents("/home/yz/loginfo/record.txt", $newrecord);
	echo "Successfully Logout. Redirect to Login in 3 sec";
	Header("Refresh: 3; login_main.php");
} elseif (htmlentities($click) == "Go back"){
	Header("Location:control.php");
}
?>

