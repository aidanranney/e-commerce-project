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
            <div class='zoom'>
       			<a href=''#''> <img src='" . $row['albumArtwork'] . "' alt='Product Image' height=200 width=200/> </a>
            <div class='cart-button'>
              <div class='animated fadeInDown'>
                <a href='#summary' class='btn btn-info' title='Product description'>
                <span class='glyphicon glyphicon-plus'></span></a>
            <a href='#' class='btn btn-info' title='Add to cart'>
              <span class='glyphicon glyphicon-shopping-cart'></span></a>
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
       	</article>
        </div>";
}
?>
</div>

<?php
 include ('footer.php');
?>
