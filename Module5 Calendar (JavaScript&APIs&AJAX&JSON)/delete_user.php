<?php
session_start();
require 'database.php';
header("Content-Type: application/json");

if(!hash_equals($_SESSION['token'], $_POST['CSRF'])){
	die("Request forgery detected");
}



$user_id = htmlentities($_POST['user_id']);

$stmt = $mysqli->prepare("delete from events where user_id=?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('i', htmlentities($user_id));

$stmt->execute();

$stmt->close();



$stmt = $mysqli->prepare("delete from users where id=?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('i', htmlentities($user_id));

$stmt->execute();

$stmt->close();

echo json_encode(array("success" => true));

?>