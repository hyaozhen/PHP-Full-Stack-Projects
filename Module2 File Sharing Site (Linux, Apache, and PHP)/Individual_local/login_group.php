<?php
	$username = $_POST["username"];
	
	if (strpos(file_get_contents("user.txt"),$username) !== false){
	
		session_start();
		$_SESSION['username']= $_POST["username"];
		if(isset($_SESSION["username"])){
			Header("Location:example.html");
		}// else{
// 			Header("Location:login.html");
// 		}
	}else{ 
			Header("Location:login.html");
	
	}
?>
