<?php
require 'database.php';

$user = $_POST['newuser'];
$pwd = $_POST['password'];
$pwd_hashed = password_hash($pwd, PASSWORD_BCRYPT);

$stmt = $mysqli->prepare("insert into users (username, hashed_password) values (?, ?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('ss', htmlentities($user), $pwd_hashed);

$stmt->execute();

$stmt->close();

echo "Your account has been created. Will redirect to Login Page in 3 seconds.";
Header("Refresh: 3; login_main.php");

?>