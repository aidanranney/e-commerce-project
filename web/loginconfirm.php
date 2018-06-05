<?php
session_start();
$currentpage = 'login';
$title = "Login";
include ('connection.php');
include ('header.php');

$useremail = $_POST['useremail'];
$password = $_POST['password'];
$salted = "456y45rghtrhfgr23441ldk3".$password."32490ffsll33";
$hashed = hash('sha1', $salted);
//create query
$query = "SELECT * from USER_ACCOUNT WHERE USEREMAIL='$useremail' AND password='$hashed'";
$adminquery = "SELECT admin from USER_ACCOUNT WHERE USEREMAIL='$useremail' AND password='$hashed'";
//run query. the @ symbol suppresses errors
$row = @mysqli_query($link, $query);
$admin = @mysqli_query($link, $adminquery);
//check the result
if (mysqli_num_rows($row) == 1) {
        $addLog = "UPDATE USER_ACCOUNT SET last_login = CURDATE() WHERE USEREMAIL = '$useremail'";
		mysqli_query($link, $addLog);
	echo "<p>You have logged in successfully</p>";
	$_SESSION['useremail']=$useremail;
	$r = mysqli_fetch_array($admin);
	$_SESSION['admin']= $r['admin'];
	if (isset($_GET['itemNumber'])) {
			$item = $_GET['itemNumber'];
			$addItem = "INSERT INTO SHOPPING_CART (quantityOrdered, RECORD_itemNumber, USER_ACCOUNT_USEREMAIL)
			VALUES (1, '$item', '$useremail')";
			mysqli_query($link, $addItem);
		}
	echo "<script>setTimeout(function() {
		window.location='index.php';
	}, 2000)</script>";
} else {
	echo "<p>Invalid login credentials. Please <a href='login.php'>try again</a></p>";
}

include ('footer.php');

?>
