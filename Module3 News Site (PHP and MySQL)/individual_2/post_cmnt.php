<?php
require 'database.php';
session_start();

$user_id = $_SESSION['user_id'];
$comment =  $_POST['comment'];
$story_id_cmnt = $_SESSION['story_id_cmnt'];


if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}

$stmt = $mysqli->prepare("insert into cmnts (comment, author, story) values (?, ?, ?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('sii', htmlentities($comment), $user_id, $story_id_cmnt);

$stmt->execute();

$stmt->close();

echo "Your comment has been posted. Will redirect to Story Page in 5 seconds.";
Header("Refresh: 3; story.php?story_id=".$story_id_cmnt);
echo "<li><a href=\"story.php?story_id=".$story_id_cmnt."\">Go back to Story</a></li>";  //Referenced from TA William

?>