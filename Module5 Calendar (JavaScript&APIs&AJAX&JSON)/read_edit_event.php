<?php

session_start();
require 'database.php';
header("Content-Type: application/json");


$user_id = htmlentities($_POST['user_id']);


$stmt = $mysqli->prepare("select event_id, date, time, event from events where user_id=? order by time asc");

$stmt->bind_param('s', $user_id);
$stmt->execute();


if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$stmt->bind_result($event_id, $date, $time, $event);


$array = array();

while($stmt->fetch()){

//Referenced from: http://www.w3school.com.cn/php/func_array_push.asp
array_push($array,array("event"=>htmlentities($event), "date"=>htmlentities($date), "time"=>htmlentities($time), "event_id"=>htmlentities($event_id)));

}

$stmt->close();
echo json_encode($array);
exit;

?>