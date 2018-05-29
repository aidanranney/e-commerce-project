<?php
$currentpage = 'addrecord';
$title = "Add Record";
include ('header.php');
include ('connection.php');
?>

<script>
function validate() {

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
	} if(document.getElementById('price').value ==''){
			alert("Please insert a valid price");
			return false;
	} if(document.getElementById('quality').value ==''){
			alert("You must specify used or new quality");
			return false;
	} if(document.getElementById('recordQuantity').value ==''){
			alert("Include how many records are being added");
			return false;
	}
}
</script>

<div class="container">
<form action="addrecord.php" method="POST" enctype="multipart/form-data" onsubmit="return validate()">
	<p>Artist:<input type="text" name="artist" id="artist"></p>
	<p>Album Title: <input type="text" name="albumTitle" id="albumTitle"></p>
  <p>Genre:<input type="text" name="genre" id="genre"></p>
  <p>Price: <input type="number" name="PRICE" id="price"></p>
  <p>Release Date:<input type="text" name="RELEASEDATE" id="releaseDate"></p>
  <p>Quality: <input type="text" name="quality" id="quality"></p>
  <p>Record Quantity:<input type="text" name="recordQuantity" id="recordQuantity"></p>
  <p>Edition Number: <input type="text" name="EDITIONNUMBER" /></p>
  <p>Image Upload:<input type="file" name="albumArtwork"/></p>
	<p>Additional Comments: <textarea name"comments" > text here...
		</textarea></p>
	<p><input type="submit" name="submit" value="Submit" /></p>

</form>
</div>

<?php
if (isset($_POST['submit'])) {
	$artist = mysqli_real_escape_string($link, $_REQUEST['artist']);
	$albumTitle = mysqli_real_escape_string($link, $_REQUEST['albumTitle']);
	$genre = mysqli_real_escape_string($link, $_REQUEST['genre']);
	$PRICE = $_POST['PRICE'];
	$RELEASEDATE = $_POST['RELEASEDATE'];
	$quality = mysqli_real_escape_string($link, $_REQUEST['quality']);
	$recordQuantity = $_POST['recordQuantity'];
	$EDITIONNUMBER = $_POST['EDITIONNUMBER'];

	$error_code = $_FILES['albumArtwork']['error'];
	if($error_code) {
		$list_error = array(1 => 'File exceeds maximum size',
							2 => 'File exceeds maximum size',
							3 => 'File only partially uploaded',
							4 => 'No file was uploaded',
							6 => 'Temporary folder not found',
							7 => 'Failed to write to disk');
		echo "<p>ERROR:" . $list_error[$error_code] . "</p>";
	} else {
		if (is_uploaded_file($_FILES['albumArtwork']['tmp_name'])) {

			//VALIDATION of image data.
			$size = $_FILES['albumArtwork']['size'];
			$type = $_FILES['albumArtwork']['type'];
			$tmp_name = $_FILES['albumArtwork']['tmp_name'];
			$uploadFile =  "../images/" . $_FILES['albumArtwork']['name'];
			$formats = array('image/jpeg', 'image/jpg', 'image/png'); //Add file types here. Adjust file type error if you do so
			$error = false;

			if ($size > (1024 * 1024)) {// 1MB
				$error = 'ERROR: Maximum size allowed is 1MB';
			} elseif (!in_array($type, $formats)) {
				$error = 'ERROR: File type must be JPG, JPEG, or PNG';
			} else { //UPLOAD image to image folder and then add to data base.

				// if genre doesn't already exist, insert genre
				$genreQuery = "SELECT * from GENRE WHERE genre='$genre'";
				$result = mysqli_query($link, $genreQuery);
				$row_cnt = $result->num_rows;
				if ($row_cnt == 0) {
					$newquery = "INSERT INTO GENRE (genre) VALUES ('$genre')";
					if(mysqli_query($link, $newquery)) {
						echo "<p>New genre added</p>";
					} else {
						echo "Error: Could not execute $newquery. " . mysqli_error($link);
					}
				}

				// insert record data
					$query = "INSERT INTO RECORD (artist, albumTitle, genre, PRICE, RELEASEDATE, quality, recordQuantity, EDITIONNUMBER, albumArtwork) VALUES
					('$artist', '$albumTitle', '$genre', '$PRICE', '$RELEASEDATE', '$quality', '$recordQuantity', '$EDITIONNUMBER', '$uploadFile')";
					$duplicateQuery = "SELECT * FROM RECORD WHERE albumTitle LIKE $albumTitle";
					$row = @mysqli_query($link, $duplicateQuery)
					if (mysqli_num_rows($row) == 1) {
						echo "Error: Record already exists.";
					} else {
						if (move_uploaded_file($tmp_name, $uploadFile)) {
							echo "The file has been uploaded.";
							if (mysqli_query($link, $query)) {
							echo "<p>Record added successfully.</p>";
							} else {
								echo "Error: Could not execute $query." . mysqli_error($link);
							}
						}  else {
							echo "<p>ERROR: Image upload fail</p>";
							//If this occurs remove added record?
						}
					}


				if($error) {
					echo $error;
				}

				}
		}//End of no error codes
		else {
			echo '<p>No file uploaded</p>';
		}
	}//end of if submitted data
}

include ('footer.php');
?>
