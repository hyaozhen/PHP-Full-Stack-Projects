<?php
session_start();
require 'database.php';
header("Content-Type: application/json");

if(!hash_equals($_SESSION['token'], $_POST['CSRF'])){
	die("Request forgery detected");
}


//compare two $user_id and cookie?
$user_id = $_POST['user_id'];

$event_area = htmlentities($_POST['event_area']);
$date_area = htmlentities($_POST['date_area']);
$time_area = htmlentities($_POST['time_area']);
$event_id = htmlentities($_POST['event_id']);

$stmt = $mysqli->prepare("update events set event =?, date =?, time =? where event_id=$event_id");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('sss', htmlentities($event_area),htmlentities($date_area),htmlentities($time_area));

$stmt->execute();

$stmt->close();

echo json_encode(array("success" => true));

?>