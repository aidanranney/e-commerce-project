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
  $query = "select * from RECORD WHERE genre ='$genre'";
  $result = mysqli_query($link,"select * from RECORD WHERE genre ='$genre'");
} else {
  $query = "select * from RECORD";
  $result = mysqli_query($link,"select * from RECORD");
}
if (isset($genre))   {
  echo "<h4>$genre Records</h4>";
} else {
  echo "<h4>All Records</h4>";
}
while ($row = mysqli_fetch_array($result)) {
        echo "
        <div class='col-sm-3'>
           <article class='col-item'>
            <div class='albumArtwork'>
       			<img src='" . $row['albumArtwork'] . "' alt='Product Image' height=200 width=200>
            <div class='item-buttons'>
              <div class='animated fadeInDown'>
                <button type='button' id='itemDescription' class='btn btn-info' data-toggle='modal' data-target='#description' title='Product description'>
                <span class='glyphicon glyphicon-plus'></span></button>
                <button id='shoppingCart' class='btn btn-info' title='Add to cart'>
              <span class='glyphicon glyphicon-shopping-cart'></span></button>
              </div>
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
          <div id='description' class='modal fade' role='dialog'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>x</button>
                  <h4 class='modal-title'>Album description</h4>
                  </div>
                  <div class='modal-body'>
                    " . $row['description'] . "
                    </div>
                    <div class='modal-footer'>
                      <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                    </div>
              </div>
            </div>
            </div>
       	</article>
        </div>";
}
?>
</div>

<?php
 include ('footer.php');
?>
