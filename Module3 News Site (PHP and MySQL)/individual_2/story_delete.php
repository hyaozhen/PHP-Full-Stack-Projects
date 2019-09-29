<?php
session_start();
echo '<p> Do you want to delete this story? </p>';
echo '<form method="POST">';
echo '<p>';
echo "<input type='hidden' name='token' value=".$_SESSION['token']." />";
echo '<input type="submit" name="click" value="Delete"/>';
echo '<input type="submit" name="click" value="Go back"/>';
echo '</p>';
echo '</form>';
?>

<?php
require 'database.php';

if (isset($_POST["click"])){
$story_id = $_GET["story_id"];
$click = $_POST["click"];

if (htmlentities($click) == "Delete"){


if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}

//////First delete the story's comments
$stmt = $mysqli->prepare("delete from cmnts where story=?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('i', htmlentities($story_id));

$stmt->execute();

$stmt->close();

//////Next delete the story
$stmt = $mysqli->prepare("delete from stories where story_id=?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('i', htmlentities($story_id));

$stmt->execute();

$stmt->close();


echo "Your story has been deleted. Will redirect to Home Page Page in 5 seconds.";
Header("Refresh: 5; example.php");
echo '<a href="http://ec2-18-188-126-127.us-east-2.compute.amazonaws.com/~yz/module3/example.php"><p class="ft6" lang="en">Go back to Home Page</p></a>';

}else{
	echo "<li><a href=\"story.php?story_id=".$story_id."\">Go back to Story</a></li>"; //Referenced from TA William
}
}

?>