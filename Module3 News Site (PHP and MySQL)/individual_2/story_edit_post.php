<link href= 'sitestyle.css'  type='text/css'  rel='stylesheet'>

<?php
session_start();

require 'database.php';

$story_id = $_GET['story_id'];


$stmt = $mysqli->prepare("select title, body, id, URL, username from stories join users on (stories.author = users.id) where story_id = ".htmlentities($story_id));

if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$stmt->bind_result($title, $body, $id, $URL, $username);

echo "<ul>\n";
while($stmt->fetch()){
// 	printf("\t<li>%s %s %s %s</li>\n",
// 		htmlspecialchars($title),
// 		htmlspecialchars($story_id),
// 		htmlspecialchars($id),
// 		htmlspecialchars($username)
// 		
// 	);	
		$_SESSION['story_id_edit'] = $story_id;
		echo "<h2><p class='ft3' lang='en'>Edit your post</p></h2>";
		echo "<form action='story_edit.php' method='POST'>";
		echo "<p class='ft1' lang='en'>Title: <input style='width:500px; height:15px;' type='text' name='title' id='title' value =".htmlentities($title)." required/></p>";
		echo "<br>";
		echo "<p class='ft1' lang='en'>URL: <input style='width:500px; height:15px;' type='text' name='URL' id='URL' value =".htmlentities($URL)."></p>";
		echo "<br>";
		echo "<p class='ft1' lang='en'>Story: <br><textarea rows='50' cols='60' name = 'story'>".htmlentities($body)."</textarea></p>"; //Referenced from: https://www.w3schools.com/tags/tag_textarea.asp
		echo "<input type='hidden' name='token' value=".htmlentities($_SESSION['token'])." />";
		echo "<p class='ft4' lang='en'>";
		echo "<input type='submit' value='Post'/>";
		echo "<input type='reset' value='Clear'/>";
		echo "</p>";
		

}
echo "</ul>\n";

$stmt->close();

echo "<li><a href=\"story.php?story_id=".$story_id."\">Go back to Story</a></li>"; //Referenced from TA William

?>