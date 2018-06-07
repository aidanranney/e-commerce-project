<?php
session_start();
$currentpage = 'home';
$title = 'Home Page';
include ('connection.php');

if (isset($_GET['itemNumber'])) {
  if (isset($_SESSION['useremail'])) {
    $email = $_SESSION['useremail'];
    $item = $_GET['itemNumber'];
    $cartquery = "SELECT quantityOrdered FROM SHOPPING_CART
                WHERE USER_ACCOUNT_USEREMAIL = '$email'
                AND RECORD_itemNumber = $item";
    $cart = mysqli_query($link, $cartquery);
    $cartrow = mysqli_fetch_array($cart);
    $row_cnt = $cart->num_rows;

    //If no rows returned, insert into cart. if a row is returned, update quantity ordered
    if ($row_cnt == 0) {
      $addItem = "INSERT INTO SHOPPING_CART (quantityOrdered, RECORD_itemNumber, USER_ACCOUNT_USEREMAIL)
      VALUES (1, '$item', '$email')";
      if ((mysqli_query($link, $addItem)) or die("Error: ".mysqli_error($link))) {
      } else {
        $cartError = true;
      }
    } else {
      $quantity = intval($cartrow['quantityOrdered']);
      $quantity++;
      $incrementItem = "UPDATE SHOPPING_CART SET quantityOrdered = $quantity WHERE USER_ACCOUNT_USEREMAIL = '$email' AND RECORD_itemNumber = $item";
      if ((mysqli_query($link, $incrementItem)) or die("Error: ".mysqli_error($link))) {
      } else {
        $cartError = true;
      }
    }
  } else {
    $loginRedirect = true;
    echo "<meta http-equiv='refresh' content='0; url=login.php?itemNumber=" . $_GET['itemNumber'] . "'>";
  }
}
include ('header.php');
?>

<div class='container'>
<?php

// Check for genre request
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

if (isset($_GET['addtocart']) && !isset($cartError) && !isset($loginRedirect)) {
  echo "<p class='alert alert-success'>Record Added!</p>";
} elseif (isset($cartError)) {
  echo "<p class='alert alert-danger'>Something went wrong...</p>";
}

// Set page title
if (isset($genre))   {
  echo "<h4>$genre Records</h4>";
} else {
  echo "<h4>All Records</h4>";
}
echo "<br>";

// Populate home page with records
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_array($result)) {
          echo "
          <div class='col-sm-3'>
              <div class='albumArtwork'>
         			<img src='" . $row['albumArtwork'] . "' alt='Product Image' onerror=" . "this.onerror=null;this.src='../images/records.jpg';" . "height=200 width=200>
              <div class='item-buttons'>
                <div class='animated fadeInDown'>
                  <a href='#' id='itemDescription' class='btn btn-info' data-toggle='tooltip' title='Click for album description' style='display: none;'>
                  <span class='glyphicon glyphicon-plus'></span>Info</a>
                  <a href='index.php?itemNumber=" . $row['itemNumber'] . "&addtocart=true' id='shoppingCart' class='btn btn-info' data-toggle='tooltip' title='Add to cart'>
                    <span class='glyphicon glyphicon-shopping-cart id='addtocart'></span> Add</a>
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
              </div>
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
