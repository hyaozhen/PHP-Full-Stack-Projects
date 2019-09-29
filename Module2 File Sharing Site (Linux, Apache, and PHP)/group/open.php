<?php
session_start();
$filename = $_GET['file'];
$username = $_SESSION['username'];
$full_path = sprintf("/home/yz/user/%s/%s", $username, $filename);
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->file($full_path);
header("Content-Type: ".$mime);
header('Content-Disposition: attachment; filename="'.$filename.'"');
readfile($full_path);
?>
