<?php
require 'database.php';
session_start();

if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}

$user_id = $_SESSION['user_id'];
$cmnt_id_edit= $_SESSION['cmnt_id_edit'];
$comment = $_POST['comment'];
$story_id_cmnt = $_SESSION['story_id_cmnt'];

$stmt = $mysqli->prepare("update cmnts set comment =? where cmnt_id=$cmnt_id_edit");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('s', htmlentities($comment));

$stmt->execute();

$stmt->close();

echo "Your story has been edited. Will redirect to Story Page in 5 seconds.";
Header("Refresh: 3; story.php?story_id=".$story_id_cmnt); //Referenced from TA William
echo "<li><a href=\"story.php?story_id=".$story_id_cmnt."\">Go back to Story</a></li>"; //Referenced from TA William

?>