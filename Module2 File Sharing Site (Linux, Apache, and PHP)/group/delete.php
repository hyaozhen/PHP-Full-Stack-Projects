<?php

//reference:https://paulund.co.uk/php-delete-directory-and-files-in-directory
//from above article I learned how to build a function to delete directory and files in a directory
//following part is the function
function delete_directory($dirname) {
         if (is_dir($dirname))
           $dir_handle = opendir($dirname);
     if (!$dir_handle)
          return false;
     while($file = readdir($dir_handle)) {
           if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file))
                     unlink($dirname."/".$file);
                else
                     delete_directory($dirname.'/'.$file);
           }
     }
     closedir($dir_handle);
     rmdir($dirname);
     return true;
}
//


session_start();
 	$username = $_SESSION["username"];
	$click = $_POST["click"];
	
	if (htmlentities($click) == "Confirm"){
// 	I use next two lines to replace strings in the user.txt file with help from 
//  https://stackoverflow.com/questions/11901521/replace-string-in-text-file-using-php/24240869
	$newtext=str_replace("$username", "",file_get_contents("/home/yz/loginfo/user.txt"));
	file_put_contents("/home/yz/loginfo/user.txt", $newtext);
//  
	delete_directory('/home/yz/user/'.$username);//implementing the function
	//rmdir('/home/yz/user/'.$username."/");
	echo "User '".$username."' has been deleted. Redirect to Login Page in 5 sec";
	Header("Refresh: 5; login_main.php");
	exit;
	} elseif (htmlentities($click) == "Go back"){
	Header("Location:control.php");
	exit;
	}
?>