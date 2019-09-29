<?php
session_start();
require 'database.php';
header("Content-Type: application/json");

if(!hash_equals($_SESSION['token'], $_POST['CSRF'])){
	die("Request forgery detected");
}

$event_area = htmlentities($_POST['event_area']);
$date_area = htmlentities($_POST['date_area']);
$time_area = htmlentities($_POST['time_area']);
$user_id = htmlentities($_POST['user_id']);
//$start_time = $date_area." ".$time_area;

$stmt = $mysqli->prepare("insert into events (user_id,date,time,event) values (?, ?, ?, ?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('isss', htmlentities($user_id),htmlentities($date_area),htmlentities($time_area),htmlentities($event_area));

$stmt->execute();

$stmt->close();

echo json_encode(array("success" => true));
?>