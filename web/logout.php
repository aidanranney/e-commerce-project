<?php
session_start();
$currentpage = 'logout';
$title = 'Login Page';
include ('connection.php');
include ('header.php');

session_destroy();

echo "<p>You are now logged out. Thanks for visiting.</p>";
echo "<script>setTimeout(function() {
  window.location='index.php';
}, 2000)</script>";

// header("location:index.php");

include ('footer.php');
?>
