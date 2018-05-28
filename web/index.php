<?php
$currentpage = 'home';
$title = 'Home Page';
include ('header.php');
include ('connection.php');
?>

<div class='container'>
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
           	<div class='photo'>
       			<a href=''#''> <img src='" . $row['albumArtwork'] . "' class='img-responsive' alt='Product Image' height=200 width=200/> </a>
       	    </div>
       		<div class='info'>
       			<div class='row'>
       				<div class='price-details col-md-9'>
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
       		</div>
       	</article>
       </div>";
}
?>

</div>;

<?php
 include ('footer.php');
?>
