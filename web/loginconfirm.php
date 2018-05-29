<?php
$currentpage = 'login';
$title = "Login";
include ('header.php');
include ('connection.php');
$useremail = $_POST['useremail'];
$password = $_POST['password'];
//create query
$query = "SELECT * from USER_ACCOUNT WHERE USEREMAIL='$useremail' AND password='$password'";
$adminquery = "SELECT admin from USER_ACCOUNT WHERE USEREMAIL='$useremail' AND password='$password'";
//run query. the @ symbol suppresses errors
$row = @mysqli_query($link, $query);
$admin = @mysqli_query($link, $adminquery);
//check the result
if (mysqli_num_rows($row) == 1) {
	echo "<p>You have logged in successfully</p>";
	$_SESSION['useremail']=$useremail;
	$r = mysqli_fetch_array($admin);
	$_SESSION['admin']= $r['admin'];
	echo "<script>setTimeout(function() {
		window.location='index.php';
	}, 2000)</script>";
} else {
	echo "<p>Invalid login credentials. Please <a href='login.php'>try again</a></p>";
}
include ('footer.php');

?>
