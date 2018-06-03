<?php
$currentpage = 'logout';
$title = 'Login Page';
include ('header.php');
include ('connection.php');

session_destroy();
header("location:index.php");

include ('footer.php');
?>
