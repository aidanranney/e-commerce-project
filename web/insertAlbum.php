<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>PHP Form Send</title>

		<script>
		function validation() {

		// VALIDATION CODE HERE!

		if(document.getElementById('artist').value ==''){
		  alert("You must include the artists name");
		  return false;
		} if(document.getElementById('albumTitle').value ==''){
		  alert("You must include an album title");
		  return false;
		} if(document.getElementById('genre').value ==''){
			alert("You must include a genre");
			return false;
		} if(document.getElementById('PRICE').value ==''){
			  alert("Please insert a valid price");
			  return false;
		} if(document.getElementById('quality').value ==''){
			  alert("You must specify used or new quality");
			  return false;
		} if(document.getElementById('recordQuanitity').value ==''){
				alert("Include how many records are being added");
				return false;
		}
		}
		</script>

	</head>

	<body>
<form action="setalbum.php" method="POST" onsubmit="return validation();">
	<p>Artist:<input type="text" name="artist" id="artist"/></p>
	<p>Album Title: <input type="text" name="albumTitle" id="albumTitle" /></p>
  <p>Genre:<input type="text" name="genre" id="genre"/></p>
  <p>Price: <input type="number" name="PRICE" id="PRICE"/></p>
  <p>Release Date:<input type="text" name="RELEASEDATE" id="RELEASEDATE"/></p>
  <p>Quality: <input type="text" name="quality" id="quality"/></p>
  <p>Record Quantity:<input type="text" name="recordQuantity" id="recordQuantity"/></p>
  <p>Edition Number: <input type="text" name="EDITIONNUMBER" id="EDITIONNUMBER"/></p>
  <p>Image Upload:<input type="text" name="albumArtwork" id=albumArtwork/></p>
	<p>Additional Comments: <textarea name"comments" > text here...
		</textarea></p>
	<p><input type="submit" value="Submit" /></p>

</form>
	</body>
</html>
