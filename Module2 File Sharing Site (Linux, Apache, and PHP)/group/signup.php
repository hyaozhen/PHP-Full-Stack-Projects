<?php
	$newuser = $_POST["newuser"];
//Check if file contains a word: https://stackoverflow.com/questions/38644063/how-to-check-if-a-txt-file-contain-a-word	
//I learned how to open file and write string to txt file from: https://stackoverflow.com/questions/1768894/how-to-write-into-a-file-in-php
if (strpos(file_get_contents("/home/yz/loginfo/user.txt"),$newuser) !== false){
	echo "User '".$newuser."' already exists.";
	echo "<br>";
	echo '<a href="http://project.hyaozhen.com/~yz/f-n-site/signup.html">Go Back</a>';
	}else{
	$file = fopen("/home/yz/loginfo/user.txt","a");
	fwrite($file,trim($newuser)."\n");
	fclose($file);
//I learned how to make directory and change its permissions from: http://php.net/manual/en/function.mkdir.php
	mkdir("/home/yz/user/".$newuser);chmod('/home/yz/user/'.$newuser,0777);
	echo "New user '".$newuser."' is created.";
	echo "<br>";
	echo '<a href="http://project.hyaozhen.com/~yz/f-n-site/login_main.php">Go back to Login Page</a>';
	}
?>