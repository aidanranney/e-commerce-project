<?php


$server = 'localhost';

$user = 'cst106';

$pswd = '344994';

$db='ICS199Group08_prod';


$link = mysqli_connect($server,$user,$pswd,$db);

if (!$link) {

    die ('MySQL Error:' . mysqli_connect_error());

}

 else {

    print "Connecting to database <BR>" ;

 }



?>
