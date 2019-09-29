<?php

require 'database.php';
header("Content-Type: application/json");


//$user_id = htmlentities($_POST['user_id']);
// Use a prepared statement
// Use a prepared statement
$stmt = $mysqli->prepare("SELECT COUNT(*), id, hashed_password, pics FROM users WHERE id=?");

// Bind the parameter
$user = htmlentities($_POST['user_id']);
$stmt->bind_param('s', $user);
$stmt->execute();

// Bind the results
$stmt->bind_result($cnt, $user_id, $pwd_hash, $pics);
$stmt->fetch();
$stmt->close();

//$newpics = str_replace("\\","",$pics);

// Compare the submitted password to the actual password hash

	echo json_encode(array(
		"success" => true,
		"pics" => htmlentities($pics)
	));
	exit;
?>