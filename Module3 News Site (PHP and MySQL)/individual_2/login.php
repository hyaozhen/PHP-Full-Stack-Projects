<?php
// This is a *good* example of how you can implement password-based user authentication in your web application.

session_start();
require 'database.php';

// Use a prepared statement
$stmt = $mysqli->prepare("SELECT COUNT(*), id, hashed_password FROM users WHERE username=?");

// Bind the parameter
$user = $_POST['username'];
$stmt->bind_param('s', $user);
$stmt->execute();

// Bind the results
$stmt->bind_result($cnt, $user_id, $pwd_hash);
$stmt->fetch();

$pwd_guess = $_POST['password'];
// Compare the submitted password to the actual password hash

if($cnt == 1 && password_verify($pwd_guess, $pwd_hash)){
	// Login succeeded!
	//$_SESSION['loggedin'] = true;
	$_SESSION['user_id'] = $user_id;
	$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));

	// Redirect to your target page
	//echo $_SESSION['user_id'];
	Header('Location:example.php');
} else{
	// Login failed; redirect back to the login screen
	echo "Login failed. Check your username or password or both. Will redirect in 5 seconds";
	Header('Refresh: 5; login_main.php');
}
?>