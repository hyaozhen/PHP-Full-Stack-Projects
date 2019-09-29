<link href= 'sitestyle.css'  type='text/css'  rel='stylesheet'>

<?php

session_start();
require 'database.php';

$user_id = $_GET['user_id'];

$stmt = $mysqli->prepare("select title, story_id from stories join users on (stories.author = users.id) where author = ".htmlentities($user_id));

if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$stmt->bind_result($title, $story_id);

echo "<p class='ft1' lang='en'>Your Stories:</p>";

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
		echo "<li><a href=\"story.php?story_id=".htmlentities($story_id)."\">".$title."</a></li>"; //Referenced from TA William
			
}
echo "</ul>\n";
echo '</div>';

$stmt->close();


//////////////////////
echo "<hr>";

//$stmt = $mysqli->prepare("select comment, story_id from stories join cmnts on (stories.story_id = cmnts.story) where cmnts.author = ".htmlentities($user_id));
$stmt = $mysqli->prepare("select comment, story from cmnts where cmnts.author = ".htmlentities($user_id));

if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$stmt->bind_result($comment, $story_id);

echo "<p class='ft1' lang='en'>Your Comments:</p>";

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
		echo "<li><a href=\"story.php?story_id=".htmlentities($story_id)."\">".$comment."</a></li>"; //Referenced from TA William
			
}
echo "</ul>\n";
echo '</div>';

$stmt->close();

//////////////////////
echo "<hr>";

$stmt = $mysqli->prepare("select comment, story from stories join cmnts on (stories.story_id = cmnts.story) where stories.author = ".htmlentities($user_id));

if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$stmt->bind_result($comment, $story_id);

echo "<p class='ft1' lang='en'>Comments You Received:</p>";

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
		echo "<li><a href=\"story.php?story_id=".htmlentities($story_id)."\">".$comment."</a></li>"; //Referenced from TA William
			
}
echo "</ul>\n";
echo '</div>';
$stmt->close();

?>

<br>

<hr>
<h2><p class="ft3" lang="en">Reset Your Password</p></h2>
</head>
<body>
<form action="reset_pass.php" method="POST">
<div id="box">
	<p class="ft1" lang="en">
		<label for="oldpassword">Old Password</label><br>
		<input type="password" name="oldpassword" id="oldpassword" required/><br>
		<label for="newpassword">New Password</label><br>
		<input type="password" name="newpassword" id="newpassword" required/><br>
		<label for="newpassword">(Limit in 30 Characters/Numbers)</label>
		<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
	</p>
	<p class="ft4" lang="en">
		<input type="submit" value="Confirm"/>
		<input type="reset" value="Reset"/>
	</p>
	</div>

<hr>

	<a href="http://ec2-18-188-126-127.us-east-2.compute.amazonaws.com/~yz/module3/example.php"><p class="ft6" lang="en">Go back to Home Page</p></a>







