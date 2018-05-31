<?php
$currentpage = 'home';
$title = 'Home Page';
include ('header.php');
include ('connection.php');
?>

<div class='container-fluid'>
<?php
if (isset($_GET['genre'])) {
  $genre = $_GET['genre'];
  $query = "select * from RECORD where itemNumber IN
	   (SELECT RECORD_itemNumber from RECORD_CATEGORY where GENRE_genreID IN
     (SELECT genreID from GENRE where genre = '$genre'))";
  $result = mysqli_query($link, $query);
} else {
  $query = "select * from RECORD";
  $result = mysqli_query($link, $query);
}
if (isset($genre))   {
  echo "<h4>$genre Records</h4>";
} else {
  echo "<h4>All Records</h4>";
}
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_array($result)) {
          echo "
          <div class='col-sm-3'>
             <article class='col-item'>
              <div class='albumArtwork'>
         			<img src='" . $row['albumArtwork'] . "' alt='Product Image' height=200 width=200>
              <div class='item-buttons'>
                <div class='animated fadeInDown'>
                  <button id='itemDescription' class='btn btn-info' data-toggle='tooltip' title='Click for album description'>
                  <span class='glyphicon glyphicon-plus'></span></button>
                  ";
                  if (isset($_SESSION['useremail'])) {
                    echo "<a href='cart.php?itemNumber=" . $row['itemNumber'] . "' id='shoppingCart' class='btn btn-info' data-toggle='toolip' title='Add to cart'>
                <span class='glyphicon glyphicon-shopping-cart'></span></a>";
              }
              echo "</div>
                </div>
              </div>
         		<div class='info'>
         				<div class='price-details col-md-10'>
         					<div class='details'>"
         						. $row['quality'] . "
         					</div>
         					<div style='font-size:16pt'>" . $row['albumTitle'] . "</div>
                   <b>" . $row['artist'] . "</b>
                   <br>
         					<span class='price-new'>" . "$" . $row['PRICE'] . "</span>
                   <br>
                   <br>
         				</div>
         		</div>
         	</article>
          </div>";
  }
} else {
  echo "No records match that genre";
}

?>
</div>

<?php
 include ('footer.php');
?>
