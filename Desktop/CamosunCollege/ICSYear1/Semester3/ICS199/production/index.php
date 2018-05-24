<?php

session_start();

include ('header.html');
include ('connection.php');



 $result = mysqli_query($link,'select * from RECORD');
 if ($result)   {
     $row_count = mysqli_num_rows($result);
     print 'Retreived '. $row_count . ' rows from the <b> RECORD </b> table<BR><BR>';

     while ($row = mysqli_fetch_array($result)) {
         print '<b>Item Number: </b>' . $row['itemNumber'] . '<b> Artist: </b>' . $row['artist'] . '<b> Album Title: </b>' . $row['albumTitle'] . '<b> Genre: </b>' . $row['genre'] . '<b> Price: </b>$' . $row['PRICE'] . '<b> Release Date: </b>' . $row['RELEASEDATE'] . '<b> Quality: </b>' . $row['quality'] . '<b> Edition Number: </b>' . $row['EDITIONNUMBER'] . '<b> Album Artwork: </b>' . $row['albumArtwork'] . '<br>';
     }

 }


    include ('footer.php');

?>
