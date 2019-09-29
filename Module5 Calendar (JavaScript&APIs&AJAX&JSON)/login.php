<?php
// This is a *good* example of how you can implement password-based user authentication in your web application.

ini_set("session.cookie_httponly", 1);
session_start();
require 'database.php';
header("Content-Type: application/json");

// Use a prepared statement
$stmt = $mysqli->prepare("SELECT COUNT(*), id, hashed_password, pics FROM users WHERE username=?");

// Bind the parameter
$user = htmlentities($_POST['username']);
$stmt->bind_param('s', $user);
$stmt->execute();

// Bind the results
$stmt->bind_result($cnt, $user_id, $pwd_hash, $pics);
$stmt->fetch();

$pwd_guess = $_POST['password'];
// Compare the submitted password to the actual password hash

if($cnt == 1 && password_verify($pwd_guess, $pwd_hash)){

	$_SESSION['username'] = $user;
	$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32)); 
	//Referenced from: https://www.w3schools.com/php/php_cookies.asp
	$cookie_name = "user_id";
	$cookie_value = $user_id;
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
	setcookie("CSRF", $_SESSION['token'], time() + (86400 * 30), "/");
	echo json_encode(array(
		"success" => true,
		"pics" => htmlentities($pics)
	));
	exit;
	}else{
	echo json_encode(array(
		"success" => false,
		"message" => "Incorrect Username or Password"
	));
	exit;
	}
?>