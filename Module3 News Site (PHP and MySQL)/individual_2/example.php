<link href= 'sitestyle.css'  type='text/css'  rel='stylesheet'>

<?php
session_start();

require 'database.php';
//echo $_SESSION['user_id'];


if(isset($_SESSION['user_id'])){

echo "<li><a href=\"control.php?user_id=".$_SESSION['user_id']."\">Your Profile</a></li>";

}

echo "<hr>";

$stmt = $mysqli->prepare("select title, story_id from stories join users on (stories.author = users.id) order by story_id desc");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$stmt->bind_result($title, $story_id);

echo '<div id="box">';
echo "<h2><p class='ft1' lang='en'>Stories: </p></h2>";
echo "<ul>\n";
while($stmt->fetch()){
// 	printf("\t<li>%s %s %s %s</li>\n",
// 		htmlspecialchars($title),
// 		htmlspecialchars($story_id),
// 		htmlspecialchars($id),
// 		htmlspecialchars($username)
// 		
// 	);
	echo "<br>";
	echo "<li><a href=\"story.php?story_id=".$story_id."\">".$title."</a></li>"; //Referenced from TA William
}
echo "</ul>\n";

$stmt->close();
echo '</div>';


echo "<hr>";

if (!isset($_SESSION['user_id'])) {
	echo '<a href="http://ec2-18-188-126-127.us-east-2.compute.amazonaws.com/~yz/module3/login_main.php"><p class="ft6" lang="en">Login</p></a>	';
	}else{
	echo '<a href="http://ec2-18-188-126-127.us-east-2.compute.amazonaws.com/~yz/module3/Logout.html"><p class="ft6" lang="en">Log out</p></a>';
	}
echo '<a href="http://ec2-18-188-126-127.us-east-2.compute.amazonaws.com/~yz/module3/post_main.php"><p class="ft6" lang="en">Post Story</p></a>';
	
?>

