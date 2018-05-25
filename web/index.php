<?php
$currentpage = 'home';
include ('header.php');
include ('connection.php');
?>


<?php
 $result = mysqli_query($link,'select * from RECORD');

 if ($result)   {

     $row_count = mysqli_num_rows($result);

     print 'Retreived '. $row_count . ' rows from the <b> RECORD </b> table<BR><BR>';

     while ($row = mysqli_fetch_array($result)) {

         print $row['itemNumber'] . '. ' . $row['artist'] . ', ' . $row['albumTitle'] .', ' .
         $row['genre'] .', ' . ' $'. $row['PRICE'] .', ' . $row['RELEASEDATE'] .', ' . $row['quality'] . ', ' . $row['EDITIONNUMBER'] . ', ' . $row['albumArtwork'] . '<br>';

     }

 }

 include ('footer.php');
?>
