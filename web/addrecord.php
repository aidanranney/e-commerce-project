<?php
$currentpage = 'addrecord';
$title = "Add Record";
include ('header.php');
include ('connection.php');
?>

<<<<<<< HEAD
<div class="container">
<form action="addrecord.php" method="POST" enctype="multipart/form-data" onsubmit="return validateRecord()">
=======
<script>
function validate() {

// VALIDATION CODE HERE!

	if(document.getElementById('artist').value ==''){
		alert("You must include the artist's name");
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
}
}
</script>

<div class="container eachPage">
<form action="addrecord.php" method="POST" enctype="multipart/form-data" onsubmit="return validate()">
>>>>>>> navbar now fixes to top on scroll
	<p><b>Artist:</b><input type="text" name="artist" id="artist"></p>
	<p><b>Album Title:</b> <input type="text" name="albumTitle" id="albumTitle"></p>
<b>Genre:
	<ul>
		<?php
		$categories = mysqli_query($link,'select * from GENRE');
		if ($categories)   {
			while ($result = mysqli_fetch_array($categories)) {
				$genreID = $result['genreID'];
				$genreName = $result['genre'];
				echo "<input type='checkbox' name='genre[]' value='$genreID' id='$genreID'/>$genreName</br>";
			}
		}
		?>
		<br><input type="text" name="genreText" id="genreText" placeholder="Create new genre"></p>
	</ul>
  <p><b>Price:</b> <input type="number" step="0.01" name="PRICE" id="price"></p>
  <p><b>Release Date:</b><input type="date" name="RELEASEDATE" id="releaseDate" title="Format: YYYY-MM-DD"></p>
<b>Quality:</b>
	<ul>
		<input type="radio" name="quality" value="New" id="quality"/> New
	  <br><input type="radio" name="quality" value="Used" id="quality"/> Used
	</ul>
  <p><b>Edition Number:</b> <input type="number" name="EDITIONNUMBER" /></p>
  <p><b>Image Upload:</b><input type="file" name="albumArtwork"/></p>
	<p><b>Record Description:</b>
		<p><textarea name="description" id="description" placeholder="record description here..." style="width:300px; height:100px"></textarea></p>
	<p><input type="submit" name="submit" value="Submit" /></p>
</form>
</div>

<?php
if (isset($_POST['submit'])) {
	$artist = mysqli_real_escape_string($link, $_REQUEST['artist']);
	$albumTitle = mysqli_real_escape_string($link, $_REQUEST['albumTitle']);
	//$genre = mysqli_real_escape_string($link, $_REQUEST['genre']);
	$genreText = $_POST['genreText'];
	$PRICE = $_POST['PRICE'];
	$RELEASEDATE = $_POST['RELEASEDATE'];
	$quality = mysqli_real_escape_string($link, $_REQUEST['quality']);
	$EDITIONNUMBER = $_POST['EDITIONNUMBER'];
	$description = htmlspecialchars($_POST['description']);
	//$description = mysqli_real_escape_string($link, $_REQUEST['comments']);

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

			if ($genreText != '') {
				$genreQuery = "SELECT * from GENRE WHERE genre='$genreText'";
				$result = mysqli_query($link, $genreQuery);
				$row_cnt = $result->num_rows;
				if ($row_cnt == 0) {
					$newquery = "INSERT INTO GENRE (genre) VALUES ('$genreText')";
					if(mysqli_query($link, $newquery)) {
						echo "<p>New genre added</p>";
					} else {
						echo "Error: Could not execute $newquery. " . mysqli_error($link);
					}
				}
			}

						//add record
						$albumQuery = "SELECT * FROM RECORD WHERE albumTitle='$albumTitle'" or die (mysqli_error());
						$albumResult = mysqli_query($link, $albumQuery);
						$album_count = $albumResult->num_rows;
						if ($album_count == 0) {
						$albumInsert = "INSERT INTO RECORD (artist, albumTitle, PRICE, RELEASEDATE, quality, EDITIONNUMBER, albumArtwork, description) VALUES
						('$artist', '$albumTitle', '$PRICE', '$RELEASEDATE', '$quality', '$EDITIONNUMBER', '$uploadFile', '$description')" or die(mysqli_error());
						if(mysqli_query($link, $albumInsert)) {
							echo "<p>Record added</p>";

							//add data to RECORD_CATEGORY
							$result = mysqli_query($link, "SELECT MAX(itemNumber) FROM RECORD");
							$row = mysqli_fetch_array($result);
							$record = $row[0];
							if (isset($genreText)) {
								$newGenre = mysqli_query($link,"SELECT genreID from GENRE where genre = '$genreText'");
								$row = mysqli_fetch_array($newGenre);
								$newGenreID = $row[0];
								mysqli_query($link,"INSERT INTO RECORD_CATEGORY VALUES ($record, $newGenreID)");
							}
							if (isset($_POST['genre'])) {
								foreach (array_values($_POST['genre']) as $genre) {
									mysqli_query($link,"INSERT INTO RECORD_CATEGORY VALUES ($record, $genre)");
								}
							}
						}
						else {
							echo "<p>Record not added successfully</p>";
						}

						//image file upload check
						if (move_uploaded_file($tmp_name, $uploadFile)) {
							echo "The image file has been uploaded.";
						} else {
							echo "<p>ERROR: Image upload fail</p>";
						}
				} else {
				echo "<p>That record already exists</p>";
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
