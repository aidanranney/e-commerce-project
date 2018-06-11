<?php
session_start();
$currentpage = 'addrecord';
$title = "Add Record";
include ('connection.php');
include ('header.php');
?>

<?php 
if(isset($_SESSION['useremail']) && $_SESSION['admin']=='Y'){
?>

<div class="container">
	<form class="well form-horizontal" action="addrecord.php" method="POST" enctype='multipart/form-data' onsubmit="return validateRecord()">

	  <div class="form-group">
	    <label class="col-md-4 control-label">Artist</label>
	      <div class="col-md-4 inputGroupContainer">
	      <div class="input-group">
	          <span class="input-group-addon"><i class="glyphicon glyphicon-headphones"></i></span>
	    			<input name="artist" placeholder="Record Artist" class="form-control"  type="text" id="artist">
	      </div>
	    </div>
	  </div>

    <div class="form-group">
		 <label class="col-md-4 control-label">Album Title</label>
			 <div class="col-md-4 inputGroupContainer">
			 <div class="input-group">
					 <span class="input-group-addon"><i class="glyphicon glyphicon-cd"></i></span>
		 		 	 <input name="albumTitle" placeholder="Album Title" class="form-control"  type="text" id="albumTitle">
			</div>
		 </div>
	 </div>

		<?php
	$categories = mysqli_query($link,'select * from GENRE');
		if ($categories)   {
			while ($result = mysqli_fetch_array($categories)) {
				$genreID = $result['genreID'];
				$genreName = $result['genre'];
				echo"<div class='form-group'>
						<label class='col-md-4 control-label'></label>
						<div class='col-md-4 inputGroupContainer'>
						<div class='input-group'>
							<span class=input-group-addon'><i class'glyphicon glyphicon-list'></i></span>
				<input type='checkbox' name='genre[]' value='$genreID' id='$genreID'/>$genreName</br>
				</div>
				</div>
				</div>";
			}
		}
		?>

        		<div class="form-group">
		  <label class="col-md-4 control-label">New Genre</label>
		    <div class="col-md-4 inputGroupContainer">
		    <div class="input-group">
		        <span class="input-group-addon"><i class="glyphicon glyphicon-music"></i></span>
		  <input name="genreText" placeholder="New Genre" class="form-control"  type="text" id="genreText">
		    </div>
		  </div>
		</div>

        	<div class="form-group">
	  <label class="col-md-4 control-label">Price</label>
	    <div class="col-md-4 inputGroupContainer">
	    <div class="input-group">
	        <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
	  <input name="PRICE" placeholder="Price" class="form-control"  type="number" step="0.01" id="price">
	    </div>
	  </div>
	</div>

    <div class="form-group">
	  <label class="col-md-4 control-label">Release Date</label>
	    <div class="col-md-4 inputGroupContainer">
	    <div class="input-group">
	        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	  <input name="RELEASEDATE" placeholder="Format: YYYY-MM-DD" class="form-control"  type="date" id="releaseDate">
	    </div>
	  </div>
	</div>

    	<div class="form-group">
											 <label class="col-md-4 control-label">Record Quality</label>
											 <div class="col-md-4">
													 <div class="radio">
															 <label>
																	 <input type="radio" name="quality" value="New" id="quality"/> New
															 </label>
													 </div>
													 <div class="radio">
															 <label>
																	 <input type="radio" name="quality" value="Used" id="quality"/> Used
															 </label>
													 </div>
											 </div>
									 </div>

            	<div class="form-group">
				<label class="col-md-4 control-label">Image Upload</label>
						<div class="col-md-4 inputGroupContainer">
						<div class="input-group">
								 <span class="input-group-addon"><i class="glyphicon glyphicon-camera"></i></span>
										<input name="albumArtwork" class="form-control" type="file">
						</div>
						</div>
			</div>

            	<div class="form-group">
  <label class="col-md-4 control-label">Record Description</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
        	<textarea class="form-control" name="description" placeholder="Record Description" id="description" style="width:300px; height:100px"></textarea>
  	</div>
  	</div>
	</div>


<div class="form-group">
	<label class="col-md-4 control-label"></label>
	<div class="col-md-4">
		<button type="submit" name="submit" value="submit" class="btn btn-warning">Add Record <span class="glyphicon glyphicon-check"></span></button>
	</div>
</div>

</form>
</div>

<?php
}//end render to page if logged in as an admin

if (isset($_POST['submit'])) {
	$artist = mysqli_real_escape_string($link, $_REQUEST['artist']);
	$albumTitle = mysqli_real_escape_string($link, $_REQUEST['albumTitle']);
	//$genre = mysqli_real_escape_string($link, $_REQUEST['genre']);
	$genreText = $_POST['genreText'];
	$PRICE = $_POST['PRICE'];
	$RELEASEDATE = $_POST['RELEASEDATE'];
	$quality = mysqli_real_escape_string($link, $_REQUEST['quality']);
	$description = mysqli_real_escape_string($link, $_POST['description']);
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
						$albumInsert = "INSERT INTO RECORD (artist, albumTitle, PRICE, RELEASEDATE, quality, albumArtwork, description) VALUES
						('$artist', '$albumTitle', '$PRICE', '$RELEASEDATE', '$quality', '$uploadFile', '$description')";
						if(mysqli_query($link, $albumInsert)  or die(mysqli_error($link))) {
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
