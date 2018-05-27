<?php
$currentpage = 'registration';
$title = 'Registration';
include ('header.php');
include ('connection.php');

$USEREMAIL = mysqli_real_escape_string($link, $_REQUEST['USEREMAIL']);
$firstName = mysqli_real_escape_string($link, $_REQUEST['firstName']);
$lastName = mysqli_real_escape_string($link, $_REQUEST['lastName']);
$DOB = $_POST['DOB'];
$password = $_POST['password'];
$MAILADDRESS = mysqli_real_escape_string($link, $_REQUEST['MAILADDRESS']);
$SHIPADDRESS = mysqli_real_escape_string($link, $_REQUEST['SHIPADDRESS']);
$phoneNumber = mysqli_real_escape_string($link, $_REQUEST['phoneNumber']);

$query = "INSERT INTO USER_ACCOUNT (USEREMAIL, firstName, lastName, DOB, password, MAILADDRESS, SHIPADDRESS, phoneNumber) VALUES
('$USEREMAIL', '$firstName', '$lastName', '$DOB', '$password', '$MAILADDRESS', '$SHIPADDRESS', '$phoneNumber')";

if(mysqli_query($link, $query)){
  echo "Records inserted successfully.";
} else {
  echo "Error: Could not execute $query." . mysqli_error($link);
}
