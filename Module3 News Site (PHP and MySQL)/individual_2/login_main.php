<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<link href= 'sitestyle.css'  type='text/css'  rel='stylesheet'>
<title> Login Page </title></head>
<body>
<hr>
<h2><p class="ft3" lang="en">Sign in to share your story</p></h2>
<form action="login.php" method="POST">
	<div id="box">
	<p class="ft1" lang="en">
		<label for="username">User Name</label><br>
		<input type="text" name="username" id="username" required/><br>
		<label for="newuser">Password</label><br>
		<input type="password" name="password" id="password" required/>
	</p>
	<p class="ft4" lang="en">
		<input type="submit" value="Sign In"/>
		<input type="reset" value="Reset"/>
	</p>
	</div>
</form>
<hr>
<h2><p class="ft3" lang="en">Sign up to create your account</p></h2>
</head>
<body>
<form action="signup.php" method="POST">
<div id="box">
	<p class="ft1" lang="en">
		<label for="newuser">New User Name</label><br>
		<input type="text" name="newuser" id="newuser" required/><br>
		<label for="Password">Password</label><br>
		<input type="password" name="password" id="password" required/><br>
		<label for="Password">(Limit in 30 Characters/Numbers)</label>
	</p>
	<p class="ft4" lang="en">
		<input type="submit" value="Sign Up"/>
		<input type="reset" value="Reset"/>
	</p>
	</div>
<hr>
	<br>
		<a href="http://ec2-18-188-126-127.us-east-2.compute.amazonaws.com/~yz/module3/example.php"><p class="ft6" lang="en">Go back to Home Page</p></a>

		

</form>
</body>
</html>

