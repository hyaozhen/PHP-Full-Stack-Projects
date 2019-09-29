<?php
require 'database.php';
session_start();


$user_id = $_SESSION['user_id'];
$title =  $_POST['title'];
$story =  $_POST['story'];
$URL =  $_POST['URL'];
$story_id_edit= $_SESSION['story_id_edit'];

if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}

$stmt = $mysqli->prepare("update stories set title=?, body=?, URL=? where story_id=".htmlentities($story_id_edit));
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('sss', htmlentities($title), htmlentities($story), htmlentities($URL));

$stmt->execute();

$stmt->close();

echo "Your story has been edited. Will redirect to Story Page in 5 seconds.";
Header("Refresh: 3; story.php?story_id=".$story_id_edit);
echo "<li><a href=\"story.php?story_id=".$story_id_edit."\">Go back to Story</a></li>"; //Referenced from TA William

?>