<?php
session_start();
require 'database.php';
header("Content-Type: application/json");

if(!hash_equals($_SESSION['token'], $_POST['CSRF'])){
	die("Request forgery detected");
}


$user_id = htmlentities($_POST['user_id']);

$event_id = htmlentities($_POST['event_id']);

$stmt = $mysqli->prepare("delete from events where event_id=?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('i', htmlentities($event_id));

$stmt->execute();

$stmt->close();

echo json_encode(array("success" => true));

?>