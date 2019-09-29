<link href= 'sitestyle.css'  type='text/css'  rel='stylesheet'>

<?php
		session_start();
		
		if (!empty($_SESSION['user_id'])) {
		//echo $_SESSION['user_id'];
		echo "<h2><p class='ft3' lang='en'>Share your story here</p></h2>";
		echo "<form action='post.php' method='POST'>";
		echo "<p class='ft1' lang='en'>Title: <input style='width:500px; height:15px;' type='text' name='title' id='title' required/></p>";
		echo "<br>";
		echo "<p class='ft1' lang='en'>URL: <input style='width:500px; height:15px;' type='text' name='URL' id='URL'></p>";
		echo "<br>";
		echo "<p class='ft1' lang='en'>Your Pics' url: <input style='width:500px; height:15px;' type='text' name='pics' id='pics'></p>";		
		echo "<br>";
		echo "<p class='ft1' lang='en'>Story: <br><textarea rows='50' cols='60' name = 'story'></textarea></p>"; //Referenced from: https://www.w3schools.com/tags/tag_textarea.asp
		echo "<input type='hidden' name='token' value=".$_SESSION['token']." />";
		echo "<p class='ft4' lang='en'>";
		echo "<input type='submit' value='Post'/>";
		echo "<input type='reset' value='Clear'/>";
		echo "</p>";
		echo '<a href="http://ec2-18-188-126-127.us-east-2.compute.amazonaws.com/~yz/module3/example.php"><p class="ft6" lang="en">Go back to Home Page</p></a>';

		}else{
			echo "You need to login before posting";
			echo "<br>";
			echo '<a href="http://ec2-18-188-126-127.us-east-2.compute.amazonaws.com/~yz/module3/login_main.php">Go to Login Page</a>';
			}

?>

