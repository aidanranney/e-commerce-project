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
echo "<br>";
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_array($result)) {
          echo "
          <div class='col-sm-3'>
             <article class='col-item'>
              <div class='albumArtwork'>
         			<img src='" . $row['albumArtwork'] . "' alt='Product Image' onerror=" . "this.onerror=null;this.src='../images/records.jpg';" . "height=200 width=200>
              <div class='item-buttons'>
                <div class='animated fadeInDown'>
                  <button id='itemDescription' class='btn btn-info' data-toggle='tooltip' title='Click for album description'>
                  <span class='glyphicon glyphicon-plus'></span></button>
                  ";
                    echo "<a href='index.php?itemNumber=" . $row['itemNumber'] . "' id='shoppingCart' class='btn btn-info' data-toggle='tooltip' title='Add to cart'>
                    <span class='glyphicon glyphicon-shopping-cart'></span></a></div>";
                      if (isset($_GET['itemNumber'])) {
                        if (isset($_SESSION['useremail'])) {
                          $email = $_SESSION['useremail'];
                          $item = $_GET['itemNumber'];
                          $cartquery = "SELECT quantityOrdered FROM SHOPPING_CART
                                      WHERE USER_ACCOUNT_USEREMAIL = '$email'
                                      AND RECORD_itemNumber = $item";
                          $cart = mysqli_query($link, $cartquery);
                          $row_cnt = $cart->num_rows;
                          if ($row_cnt == 0) {
                            $addItem = "INSERT INTO SHOPPING_CART (quantityOrdered, RECORD_itemNumber, USER_ACCOUNT_USEREMAIL)
                            VALUES (1, '$item', '$email')";
                            mysqli_query($link, $addItem);
                            echo "<p class='alert alert-success'>Record Added!</p>";
                            echo "<meta http-quiv='refresh' content='0; url=#'>";
                          } else {
                            $incrementItem = "UPDATE SHOPPING_CART SET quantityOrdered = quantityOrdered + 1 WHERE USER_ACCOUNT_USEREMAIL = '$email' AND RECORD_itemNumber = $item";
                            if (mysqli_query($link, $incrementItem)) {
                              echo "<p class='alert alert-success'>Record Added!</p>";
                            } else {
                              echo "<p class='alert alert-danger'>Something went wrong" . mysqli_error($link) . "</p>";
                            }
                          }

                        } else {
                            echo "<meta http-equiv='refresh' content='0; url=login.php?itemNumber=" . $_GET['itemNumber'] . "'>";
                        }
                      }
              echo "
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
