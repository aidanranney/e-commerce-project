<?php
$currentpage = 'login';
$title = "Login";
include ('header.php');
include ('connection.php');
$useremail = $_POST['useremail'];
$password = $_POST['password'];
//create query
$query = "SELECT * from USER_ACCOUNT WHERE USEREMAIL='$useremail' AND password='$password'";
//run query. the @ symbol suppresses errors
$row = @mysqli_query($link, $query);
//check the result
if (mysqli_num_rows($row) == 1) {
	echo "<p>You have logged in successfully</p>";
	$_SESSION['useremail']=$useremail;
} else {
	echo "<p>Invalid login credentials. Please <a href='login.php'>try again</a></p>";
}
include ('footer.php');
?>
