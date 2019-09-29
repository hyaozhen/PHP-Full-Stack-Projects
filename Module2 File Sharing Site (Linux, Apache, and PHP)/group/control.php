<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<link href= 'sitestyle.css'  type='text/css'  rel='stylesheet'>
<title> Login Page </title></head>
<body>


<?php
session_start();
?>

<div id="box">
<form enctype="multipart/form-data" action="upload.php" method="POST">
	<p class="ft1" lang="en">
		<input type="hidden" name="MAX_FILE_SIZE" value="20000000" required/>
		<label for="uploadfile_input">Upload Your File:</label> <br><input name="uploadedfile" type="file" id="uploadfile_input" />
	</p>
	<p class="ft4" lang="en">
		<input type="submit" value="Upload File" />
	</p>
</form>
</div>

<br>
<hr>
<br>

<?php
$username = $_SESSION["username"];
//reference: https://www.w3schools.com/html/html_form_elements.asp
//& https://stackoverflow.com/questions/18140270/how-to-write-html-code-inside-php
echo '<div id="box">';
echo '<p class="ft1" lang="en">View Your File:</p>';
echo '<form action="open.php" method="get">';
echo '<p class="ft4" lang="en">';
echo'<select name="file">';
//reference: http://www.flydigital.com.au/blog/2011/01/20/how-to-loop-through-files-in-a-folder-in-php-the-quick-way/
$full_path = sprintf("/home/yz/user/%s/*", $username);
foreach(glob($full_path) as $file){
	$name = basename($file);
	echo '<option value='.$name.'>'.$name.'</option>';
}
echo '</select>';
echo'<input type="submit" value="Open">';
echo '</form>';
echo '</div>';
echo '</p>';
?>

<br>
<hr>
<br>

<?php
$username = $_SESSION["username"];
//reference: https://www.w3schools.com/html/html_form_elements.asp
//& https://stackoverflow.com/questions/18140270/how-to-write-html-code-inside-php
echo '<div id="box">';
echo '<p class="ft1" lang="en">Delete Your File</p>';
echo '<form action="delete_file.php" method="get">';
echo '<p class="ft4" lang="en">';
echo '<select name="file">';
//reference: http://www.flydigital.com.au/blog/2011/01/20/how-to-loop-through-files-in-a-folder-in-php-the-quick-way/
$full_path = sprintf("/home/yz/user/%s/*", $username);
foreach(glob($full_path) as $file){
	$name = basename($file);
	echo '<option value='.$name.'>'.$name.'</option>';
}
echo '</select>';
echo '<input type="submit" value="Delete">';
echo '</form>';
echo '</div>';
echo '</p>';
?>

<br>
<hr>
<br>

<a href="http://project.hyaozhen.com/~yz/f-n-site/Logout.html"><p class="ft6" lang="en">Logout</p></a>
<a href="http://project.hyaozhen.com/~yz/f-n-site/delete.html"><p class="ft6" lang="en">Delete This User</p></a>

</body>
</html>

