<?php
session_start();
$currentpage = 'logout';
$title = 'Login Page';
include ('connection.php');
include ('header.php');

session_destroy();
header("location:index.php");

include ('footer.php');
?>
