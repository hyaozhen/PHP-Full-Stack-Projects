<?php
session_start();

require 'database.php';

$user_id = $_SESSION['user_id'];
$old_pwd = $_POST['oldpassword'];
$old_pwd_hashed = password_hash(htmlentities($old_pwd), PASSWORD_BCRYPT); //FIEO
$new_pwd = $_POST['newpassword'];
$new_pwd_hashed = password_hash(htmlentities($new_pwd), PASSWORD_BCRYPT); //FIEO

if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}

////////
$stmt = $mysqli->prepare("select hashed_password from users where id = ".$user_id);

if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$stmt->bind_result($password);

$stmt->fetch();

$stmt->close();

if(password_verify($old_pwd, $password)){

$stmt = $mysqli->prepare("update users set hashed_password =? where id=".$user_id);
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('s', htmlentities($new_pwd_hashed));

$stmt->execute();

$stmt->close();

	echo "Password Reset Successfully. Will redirect to your profile in 5 seconds.";
	Header("Refresh: 3; control.php?user_id=".$user_id);
} else{
	echo "Wrong Password. Check your username or password or both. Will redirect in 5 seconds";
	Header("Refresh: 3; control.php?user_id=".$user_id);
}
?>






