<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>PHP Form Send</title>

	</head>

	<body>
<form action="setalbum.php" method="POST">
	<p>Artist:<input type="text" name="artist"/></p>
	<p>Album Title: <input type="text" name="albumTitle" /></p>
  <p>Genre:<input type="text" name="genre"/></p>
  <p>Price: <input type="number" name="PRICE" /></p>
  <p>Release Date:<input type="text" name="RELEASEDATE"/></p>
  <p>Quality: <input type="text" name="quality" /></p>
  <p>Record Quantity:<input type="text" name="recordQuantity"/></p>
  <p>Edition Number: <input type="text" name="EDITIONNUMBER" /></p>
  <p>Image Upload:<input type="text" name="albumArtwork"/></p>
	<p>Additional Comments: <textarea name"comments" > text here...
		</textarea></p>
	<p><input type="submit" value="Submit" /></p>

</form>
	</body>
</html>
