<?php
$currentpage = 'logout';
$title = 'Login Page';
include ('header.php');
include ('connection.php');

session_destroy();
echo "You are now logged out. Redirecting to home page...";
echo "<script>setTimeout(function() {
  window.location='index.php';
}, 2000)</script>";

include ('footer.php');
?>
