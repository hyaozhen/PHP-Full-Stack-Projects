<?php
require 'database.php';
header("Content-Type: application/json");

$user = $_POST['newuser'];
$pwd = $_POST['newpassword'];
$pics = $_POST['pics_url'];

$pwd_hashed = password_hash($pwd, PASSWORD_BCRYPT);
//if input is not a valid email address, return false
//referenced from: https://stackoverflow.com/questions/12026842/how-to-validate-an-email-address-in-php
if (!filter_var($user, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(array("success" => false));
}else{
$stmt = $mysqli->prepare("insert into users (username, hashed_password, pics) values (?, ?, ?)");
$stmt->bind_param('sss', htmlentities($user), htmlentities($pwd_hashed), htmlentities($pics));
$stmt->execute();
$stmt->close();

//Get user's id in order to record his/her birthday
$stmt = $mysqli->prepare("SELECT id FROM users WHERE username=?");
// Bind the parameter
$stmt->bind_param('s', $user);
$stmt->execute();
// Bind the results
$stmt->bind_result($user_id);
$stmt->fetch();
$stmt->close();


//Record user's birthday
$event_area = htmlentities("It's your birthday! Happy Birthday!");
$date_area = htmlentities($_POST['birthday']);
$time_area = htmlentities("00:00:00");

$stmt = $mysqli->prepare("insert into events (user_id,date,time,event) values (?, ?, ?, ?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('isss', htmlentities($user_id),htmlentities($date_area),htmlentities($time_area),htmlentities($event_area));

$stmt->execute();

$stmt->close();

echo json_encode(array("success" => true));
}
?>




