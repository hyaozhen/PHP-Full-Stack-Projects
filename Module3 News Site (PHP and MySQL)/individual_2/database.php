<?php
// Content of database.php

$mysqli = new mysqli('localhost', 'yz', '123456', 'module3');

if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>