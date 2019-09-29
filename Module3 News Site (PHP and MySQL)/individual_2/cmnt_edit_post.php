<link href= 'sitestyle.css'  type='text/css'  rel='stylesheet'>

<?php
session_start();

require 'database.php';

$cmnt_id = $_GET['cmnt_id'];
$story_id_cmnt = $_SESSION['story_id_cmnt'];


$stmt = $mysqli->prepare("select comment from cmnts join users on (cmnts.author = users.id) where cmnt_id = ".htmlentities($cmnt_id));

if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$stmt->bind_result($comment);

echo "<ul>\n";
while($stmt->fetch()){
// 	printf("\t<li>%s %s %s %s</li>\n",
// 		htmlspecialchars($title),
// 		htmlspecialchars($story_id),
// 		htmlspecialchars($id),
// 		htmlspecialchars($username)
// 		
// 	);	
		$_SESSION['cmnt_id_edit'] = $cmnt_id;
		echo "<h2><p class='ft3' lang='en'>Edit your comment</p></h2>";
		echo "<form action='cmnt_edit.php' method='POST'>";
		echo "<p class='ft1' lang='en'>Your Comment: <br><textarea rows='20' cols='30' name = 'comment'>".$comment."</textarea></p>"; //Referenced from: https://www.w3schools.com/tags/tag_textarea.asp
		echo "<input type='hidden' name='token' value=".$_SESSION['token']." />";// CSRF
		echo "<p class='ft4' lang='en'>";
		echo "<input type='submit' value='Post'/>";
		echo "<input type='reset' value='Clear'/>";
		echo "</p>";
		echo "</p>";
		

}
echo "</ul>\n";

$stmt->close();

echo "<li><a href=\"story.php?story_id=".$story_id_cmnt."\">Go back to Story</a></li>"; //Referenced from TA William

?>