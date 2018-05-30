<?php

DEFINE ('DB_USER', 'cst138');
DEFINE ('DB_PASSWORD', '444998');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'ICS199Group08_prod');

// Make the connection:
$link = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

// Set the encoding...
mysqli_set_charset($link, 'utf8');

/*$server = 'localhost';
$user = 'cst138';
$pswd = '444998';
$db='ICS199Group08_prod';

$link = mysqli_connect($server,$user,$pswd,$db);

if (!$link) {
    die ('MySQL Error:' . mysqli_connect_error());
}
 else {
     print "Connecting to database <BR>" ;
 }*/

?>
