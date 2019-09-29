<?php
	session_start();
	$username = $_POST["username"];
//Check if file contains a word: https://stackoverflow.com/questions/38644063/how-to-check-if-a-txt-file-contain-a-word	
//I learned how to open file and write string to txt file from: https://stackoverflow.com/questions/1768894/how-to-write-into-a-file-in-php		
	if (strpos(file_get_contents("/home/yz/loginfo/user.txt"),$username) !== false){
	
		$record = fopen("/home/yz/loginfo/record.txt","a");
		fwrite($record,"record\n");
		fclose($record);
	
		$_SESSION['username']= $_POST["username"];
		if(isset($_SESSION["username"])){
			Header("Location:control.php");
			exit;
		}
		
	}else{
			echo "User '".$username."' does not exist.";
			echo "<br>";
			echo '<a href="http://project.hyaozhen.com/~yz/f-n-site/login_main.php">Go back to Login Page</a>';

	}
?>
