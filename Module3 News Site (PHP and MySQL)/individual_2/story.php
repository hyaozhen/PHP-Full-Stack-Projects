<link href= 'sitestyle.css'  type='text/css'  rel='stylesheet'>

<?php
session_start();

//echo $_SESSION['user_id'];
require 'database.php';

echo "<br>";
$story_id = $_GET['story_id'];

$stmt = $mysqli->prepare("select title, body, id, URL, pics, username from stories join users on (stories.author = users.id) where story_id = ".htmlentities($story_id));

if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$stmt->bind_result($title, $body, $id, $URL, $pics, $username);

echo "<ul>\n";
while($stmt->fetch()){
// 	printf("\t<li>%s %s %s %s</li>\n",
// 		htmlspecialchars($title),
// 		htmlspecialchars($story_id),
// 		htmlspecialchars($id),
// 		htmlspecialchars($username)
// 		
// 	);
	echo "<h2><p class='ft1' lang='en'>".htmlentities($title)."</p></h2>";
	echo "<br>";
	echo "<a href=".htmlentities($URL)."><p class='ft6' lang='en'>Link to Full Story</p></a>";
	echo "<br>";
	if (!empty(htmlentities($pics))) {
		echo "<img src=".htmlentities($pics)." width='300' alt='icon' class='center' />"; //Referenced from: https://www.w3schools.com/howto/howto_css_image_center.asp
		}
	echo "<h3><p class='ft1' lang='en'>".htmlentities($body)."</p></h3>";

	if (isset($_SESSION['user_id'])){
		if ($_SESSION['user_id']==$id) {
			echo "<li><a href=\"story_edit_post.php?story_id=".$story_id."\"> Edit </a></li>"; //Referenced from TA William
			echo "<li><a href=\"story_delete.php?story_id=".$story_id."\"> Delete </a></li>"; //Referenced from TA William
			}
	}
}
echo "</ul>\n";

$stmt->close();


echo "<hr>";
///////////////////////////////////////
echo "<br>";
echo "<h2><p class='ft8' lang='en'>Commnets:</p></h2>";


$stmt = $mysqli->prepare("select cmnt_id, comment, username, author from cmnts join users on (cmnts.author = users.id) where story = ".htmlentities($story_id));

if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$stmt->bind_result($cmnt_id, $comment, $username, $author);


echo "<ul>\n";
echo '<div id="box">';
while($stmt->fetch()){
// 	printf("\t<li>%s %s %s %s</li>\n",
// 		htmlspecialchars($title),
// 		htmlspecialchars($story_id),
// 		htmlspecialchars($id),
// 		htmlspecialchars($username)
// 		
// 	);
	echo "<br>";
	echo "<p class='ft8' lang='en'>".htmlentities($comment)."	----------	By User: ".$username."</p>";
	echo "<br>";
	//echo $_SESSION['user_id'];
	//echo $author;
	if (isset($_SESSION['user_id'])){
	if ($_SESSION['user_id']==htmlentities($author)) {
	$_SESSION['story_id_cmnt'] = htmlentities($story_id);
	echo "<li><a href=\"cmnt_edit_post.php?cmnt_id=".$cmnt_id."\"> Edit </a></li>"; //Referenced from TA William
	echo "<li><a href=\"cmnt_delete.php?cmnt_id=".$cmnt_id."\"> Delete </a></li>"; //Referenced from TA William
	echo "</p>";
	}
	}
}
echo "</ul>\n";
echo '</div">';
$stmt->close();


echo "<hr>";
///////////////////////////////////
echo "<br>";

		if (!empty($_SESSION['user_id'])) {
		$_SESSION['story_id_cmnt'] = $story_id;
		echo "<h2><p class='ft3' lang='en'>Post your commnet here</p></h2>";
		echo "<form action='post_cmnt.php' method='POST'>";
		echo "<p class='ft1' lang='en'>Your Comment: <br><textarea rows='20' cols='50' name = 'comment'></textarea></p>"; //Referenced from: https://www.w3schools.com/tags/tag_textarea.asp
		echo "<input type='hidden' name='token' value=".$_SESSION['token']." />";
		echo "<p class='ft4' lang='en'>";
		echo "<input type='submit' value='Post'/>";
		echo "<input type='reset' value='Clear'/>";
		echo "</p>";
		}else{
			echo "You need to login before add comment";
			echo "<br>";
			echo '<a href="http://ec2-18-188-126-127.us-east-2.compute.amazonaws.com/~yz/module3/login_main.php">Go to Login Page</a>';
			}

echo '<a href="http://ec2-18-188-126-127.us-east-2.compute.amazonaws.com/~yz/module3/example.php"><p class="ft6" lang="en">Go back to Home Page</p></a>';

?>









