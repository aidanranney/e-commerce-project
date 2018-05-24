<?php

session_start();

include ('header.html');
include ('connection.php');

$artist = mysqli_real_escape_string($link, $_REQUEST['artist']);
$albumTitle = mysqli_real_escape_string($link, $_REQUEST['albumTitle']);
$genre = mysqli_real_escape_string($link, $_REQUEST['genre']);
$PRICE = $_POST['PRICE'];
$RELEASEDATE = $_POST['RELEASEDATE'];
$quality = mysqli_real_escape_string($link, $_REQUEST['quality']);
$recordQuantity = $_POST['recordQuantity'];
$EDITIONNUMBER = $_POST['EDITIONNUMBER'];
$albumArtwork = mysqli_real_escape_string($link, $_REQUEST['albumArtwork']);

$query = "INSERT INTO RECORD (artist, albumTitle, genre, PRICE, RELEASEDATE, quality, recordQuantity, EDITIONNUMBER, albumArtwork) VALUES
('$artist', '$albumTitle', '$genre', '$PRICE', '$RELEASEDATE', '$quality', '$recordQuantity', '$EDITIONNUMBER', '$albumArtwork')";

if(mysqli_query($link, $query)){
  echo "Records inserted successfully.";
} else {
  echo "Error: Could not execute $query." . mysqli_error($link);
}


/*mysqli_query($link, 'INSERT INTO (itemNumber)');
$last_id = mysqli_insert_id($link);

$artist = $_POST['artist'];
$artist = mysqli_escape_string($link, $artist);
$result = mysqli_query($link, 'INSERT INTO RECORD (artist) VALUES ("'.$artist.'")');

$albumTitle = $_POST['albumTitle'];
$albumTitle = mysqli_escape_string($link, $albumTitle);
$result = mysqli_query($link, 'INSERT INTO RECORD (albumTitle) VALUES ("'.$albumTitle.'")');

$genre = $_POST['genre'];
$genre = mysqli_escape_string($link, $genre);
$result = mysqli_query($link, 'INSERT INTO RECORD (genre) VALUES ("'.$genre.'")');

$PRICE = $_POST['PRICE'];
$PRICE = mysqli_escape_string($link, $PRICE);
$result = mysqli_query($link, 'INSERT INTO RECORD (PRICE) VALUES ("'.$PRICE.'")');

$RELEASEDATE = $_POST['RELEASEDATE'];
$RELEASEDATE = mysqli_escape_string($link, $RELEASEDATE);
$result = mysqli_query($link, 'INSERT INTO RECORD (RELEASEDATE) VALUES ("'.$RELEASEDATE.'")');

$quality = $_POST['quality'];
$quality = mysqli_escape_string($link, $quality);
$result = mysqli_query($link, 'INSERT INTO RECORD (quality) VALUES ("'.$quality.'")');

$EDITIONNUMBER = $_POST['EDITIONNUMBER'];
$EDITIONNUMBER = mysqli_escape_string($link, $EDITIONNUMBER);
$result = mysqli_query($link, 'INSERT INTO RECORD (EDITIONNUMBER) VALUES ("'.$EDITIONNUMBER.'")');

$albumArtwork = $_POST['albumArtwork'];
$albumArtwork = mysqli_escape_string($link, $albumArtwork);
$result = mysqli_query($link, 'INSERT INTO RECORD (albumArtwork) VALUES ("'.$albumArtwork.'")');

if ($result) {
  echo 'Data successfully inserted' .
        mysqli_affected_rows($link) . ' rows, id_buku: ' . mysqli_insert_id($link);
      } else {
        die('Failed to insert the data: ' . mysqli_error() . );
}

/*include ('connection.php');


//mysql_select_db($link, $con);

mysql_select_db($link, "INSERT INTO RECORD (artist, albumTitle, genre, PRICE, RELEASEDATE, quality, recordQuantity, EDITIONNUMBER, albumArtwork) VALUES ('$_POST[$artist]', '$_POST[albumTitle]', '$_POST[genre]', '$_POST[PRICE]', '$_POST[RELEASEDATE]', '$_POST[quality]', '$_POST[recordQuanitity]', '$_POST[EDITIONNUMBER]', '$_POST[albumArtwork]')");

  /*  if (!mysql_query($sql,$con))

      {

      die('Error: ' . mysql_error());

      }

    echo "Records added successfully.";



    mysql_close($con)

*/
    include ('footer.php');

?>
