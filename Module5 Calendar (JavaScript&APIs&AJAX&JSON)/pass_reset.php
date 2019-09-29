<?php
session_start();
require 'database.php';
header("Content-Type: application/json");

if(!hash_equals($_SESSION['token'], $_POST['CSRF'])){
	die("Request forgery detected");
}
$user_id = htmlentities($_POST['user_id']);
$old_pwd = htmlentities($_POST['old_password']);
$old_pwd_hashed = password_hash(htmlentities($old_pwd), PASSWORD_BCRYPT); //FIEO
$new_pwd = htmlentities($_POST['new_password']);
$new_pwd_hashed = password_hash(htmlentities($new_pwd), PASSWORD_BCRYPT); //FIEO


$stmt = $mysqli->prepare("select hashed_password from users where id =?");

if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('i', htmlentities($user_id));

$stmt->execute();

$stmt->bind_result($password);

$stmt->fetch();

$stmt->close();

if(password_verify($old_pwd, $password)){

$stmt = $mysqli->prepare("update users set hashed_password =? where id=?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('si', htmlentities($new_pwd_hashed),htmlentities($user_id));

$stmt->execute();

$stmt->close();

echo json_encode(array("success" => true));
}

?>