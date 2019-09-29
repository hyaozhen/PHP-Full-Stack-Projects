<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<link href= 'sitestyle.css'  type='text/css'  rel='stylesheet'>
<title> Login Page </title></head>
<body>
<h1><p class="ft3" lang="en">This is a File-Share Platform</p></h1>
<h3><p class="ft3" lang="en">Login to upload, view and delete your files</p></h3>
<hr>
<form action="login.php" method="POST">
	<div id="box">
	<p class="ft1" lang="en">
		<label for="username">User Name</label><br>
		<input type="text" name="username" id="username" required/>
	</p>
	<p class="ft4" lang="en">
		<input type="submit" value="Sign In"/>
		<input type="reset" value="Reset"/>
	</p>
	</div>
</form>

<a href="http://project.hyaozhen.com/~yz/f-n-site/signup.html"><p class="ft2" lang="en">Sign Up</p></a>

	<?php
// 	I learned how to count number of words in a file from: https://www.w3schools.com/php/func_string_str_word_count.asp
	$alluser = file_get_contents("/home/yz/loginfo/user.txt");
	echo "<p class='ft5' lang='en'>Total number of users: ".str_word_count($alluser)."</p>";
	$numbercurrent = file_get_contents("/home/yz/loginfo/record.txt");
	echo "<p class='ft5' lang='en'>Total number of users online: ".str_word_count($numbercurrent)."</p>";
	?>


</body>
</html>

