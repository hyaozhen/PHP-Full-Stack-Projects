<?php
session_start();
echo '<p> Do you want to delete this comment? </p>';
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
$story_id_cmnt = $_SESSION['story_id_cmnt'];
$click = $_POST["click"];

if (htmlentities($click) == "Delete"){

$cmnt_id = $_GET['cmnt_id'];

if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}

$stmt = $mysqli->prepare("delete from cmnts where cmnt_id=?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('i', $cmnt_id);

$stmt->execute();

$stmt->close();


echo "Your story has been edited. Will redirect to Story Page in 5 seconds.";
Header("Refresh: 3; story.php?story_id=".$story_id_cmnt);
echo "<li><a href=\"story.php?story_id=".$story_id_cmnt."\">Go back to Story</a></li>"; //Referenced from TA William

}else{
	echo "<li><a href=\"story.php?story_id=".$story_id_cmnt."\">Go back to Story</a></li>"; //Referenced from TA William
}
}

?>