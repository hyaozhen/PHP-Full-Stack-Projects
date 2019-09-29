<?php
require 'database.php';
session_start();

$user_id = $_SESSION['user_id'];
$title =  $_POST['title'];
$story =  $_POST['story'];
$URL =  $_POST['URL'];
$pics = $_POST['pics'];

if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}

$stmt = $mysqli->prepare("insert into stories (title, body, URL, pics, author) values (?, ?, ?, ?, ?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('ssssi', htmlentities($title), htmlentities($story), htmlentities($URL), htmlentities($pics), $user_id);

$stmt->execute();

$stmt->close();

echo "Your story has been posted. Will redirect to Home Page in 5 seconds.";
Header("Refresh: 3; login_main.php");
echo '<a href="http://ec2-18-188-126-127.us-east-2.compute.amazonaws.com/~yz/module3/example.php"><p class="ft6" lang="en">Go back to Home Page</p></a>';

?>