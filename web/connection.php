<?php


$server = 'localhost';
$user = 'cst161';
$pswd = '427021';
$db='ICS199Group08_prod';

$link = mysqli_connect($server,$user,$pswd,$db);

if (!$link) {
    die ('MySQL Error:' . mysqli_connect_error());
}

?>
