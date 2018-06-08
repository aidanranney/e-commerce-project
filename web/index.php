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
    $login = true;
    echo "<meta http-equiv='refresh' content='0; url=login.php?itemNumber=" . $_GET['itemNumber'] . "'>";
  }
}
include ('header.php');
?>


<?php
if(isset($_POST['accept'])) {
  unset($_SESSION['privacy']);
}

if (isset($_SESSION['privacy'])) {
  if($_SESSION['privacy']=='N') {
    echo $_SESSION['privacy'] . "
        <body>
        <div class='modal' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' style='display:block;'>
          <div class='modal-dialog'>
            <div class='modal-content'>
              <div class='modal-header'>
                <h4 class='modal-title' id='myModalLabel'>Our Terms of Use Have Changed</h4>
              </div>
              <div class='modal-body'>
                <p><embed src='https://termsfeed.com/terms-conditions/3fc9f955d476a5bf9ca69d4c91d23b6f' frameborder='100' width='100%' length='400px' height='500px'></p>
              </div>
              <div class='modal-footer'>
                <p>Questions or Concerns, Contact Us <a href='mailto:mick.lick.records@gmail.com?Subject=Terms%20And%20Contions'>Here</a></p>
                <form action='index.php' method='POST'>
                <button type='submit' name='accept' value='accept' class='btn btn-primary' data-dismiss='modal'> Accept <span class='glyphicon glyphicon-ok-circle'></span></button>
                <button type='submit' id='decline' name='decline' value='decline' class='btn btn-default' data-dismiss='modal-body'> Decline <span class='glyphicon glyphicon-ban-circle'></span></button>
                </form>
              </div>
            </div>
          </div>
        </div>
        </body>";
}
}
?>
<?php if (isset($_POST['accept'])) {
  $pQuery = "UPDATE USER_ACCOUNT SET privCheck = 'Y'
  WHERE USEREMAIL = '$email'";
  mysqli_query($link, $pQuery) or die ("Error: ".mysqli_error($link));
  unset($_SESSION['privacy']);
  unset($_SESSION['accept']);
  echo "<script>javascript: alert('Thank you for agreeing to the terms!')</script>";
  // echo "<script>javascript: if(!alert('Thank you for agreeing to the terms!')){window.location.reload();}</script>";
}

if (isset($_POST['decline'])) {
  session_destroy();
}
?>

<div class='container-fluid'>
<?php

// Check for genre request
if (isset($_GET['genre'])) {
  $genre = $_GET['genre'];
  $query = "select * from RECORD where itemNumber IN
	   (SELECT RECORD_itemNumber from RECORD_CATEGORY where GENRE_genreID IN
     (SELECT genreID from GENRE where genre = '$genre'))";
  $result = mysqli_query($link, $query) or die("Error: ".mysqli_error($link));
} else {
  $query = "select * from RECORD";
  $result = mysqli_query($link, $query) or die("Error: ".mysqli_error($link));
}

if (isset($_GET['addtocart']) && !isset($cartError) && !isset($login)) {
  echo "<p class='alert alert-success'>Record Added!</p>";
}
elseif (isset($cartError)) {
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
             <article class='col-item'>
              <div class='albumArtwork'>
         			<img src='" . $row['albumArtwork'] . "' alt='Product Image' onerror=" . "this.onerror=null;this.src='../images/records.jpg';" . "height=200 width=200>
              <div class='item-buttons'>
                <div class='animated fadeInDown'>
                  <a href='#' id='itemDescription' class='btn btn-info' title='Click for album description'>
                  <span class='glyphicon glyphicon-plus'></span><p style='display:inline;'>Info</p></a></button>
                  <a href='index.php?itemNumber=" . $row['itemNumber'] . "&addtocart=true' id='shoppingCart' class='btn btn-info' title='Add to cart'>
                    <span class='glyphicon glyphicon-shopping-cart id='addtocart'></span><p style='display:inline;'>Add to cart</p></a></div>
                </div>
              </div>
       		<div class='info'>
       				<div class='price-details col-sm-10'>
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
