<?php
$currentpage = 'cart';
$title = "Your cart";
include ('header.php');
include ('connection.php');
?>

<?php
/*
Todo list:
----------------------
Remove item from cart
Update cart quantity of items - mostly likely will have to be an update button.
Basic checkout page.

General visual and layout improvements.

Note background-colors are only to help identify different elements.
*/


echo
				"<div class=container>
					<h1>Your Cart</h1>";


$email = $_SESSION['useremail'];
if(!empty($_POST['remove'])){
	$removedItem = $_POST['remove'];
	$removeQuery = "DELETE FROM SHOPPING_CART
									WHERE RECORD_itemNumber =" .  $removedItem . "
									AND USER_ACCOUNT_USEREMAIL = '$email'";
	if(mysqli_query($link, $removeQuery) or die("Error: ".mysqli_error($link))){
		echo "Item removed";
	}else{//Remove - Update Cart Items -- This may look better if inline with your cart but floating to the right
				echo "Remove Failed";
	}
}



//here's the code for tables to display properly

echo
				"<div id=cartTableLeft>
					<div class='col-xs-6'>
					<table class=table-responsive>
					<tr>
						<th class=col-lg-6>Item</th>
						<th class=col-lg-4>Price</th>
						<th class=col-lg-2>Quantity</th>
					</tr>";

	$subtotal = 0;
	$total = 0;
	$ship = 5.00;
	$tax = 0;
	$items = 0;
	$query = "SELECT sc.RECORD_itemNumber, sc.quantityOrdered, r.artist, r.albumTitle, r.PRICE, r.albumArtwork
			FROM SHOPPING_CART sc, RECORD r
			WHERE  sc.RECORD_itemNumber=r.itemNumber
			AND sc.USER_ACCOUNT_USEREMAIL = '$email'";

	$result = mysqli_query($link, $query);
	while ($row = mysqli_fetch_array($result)) {
		if($row['quantityOrdered'] > 1){
			$pricePerItem = "<p>($" . $row['PRICE'] . " ea.)</p>";
		}else{
			$pricePerItem = "";
		}
		echo "<tr>
								<td>
									<div class='photo'>
										<a href=''#''> <img src='" . $row['albumArtwork'] . "' alt='Product Image' onerror=" . "this.onerror=null;this.src='../images/records.jpg';" . "height=100 width=100></a>
									</div>
									<p>" . $row['artist'] . "</p>
									<p>" . $row['albumTitle'] . "</p>
									<input type='submit' name='remove' value='Remove'' action=''>
								</td>
								<td>
								<p>$" . $row['PRICE'] * $row['quantityOrdered'] . "</p>
										$pricePerItem
								</td>
								<td>
									<input type='number' name='quantity' value='" . $row['quantityOrdered'] . "' min='0' size='1'>
									<br></br>
									<form action='cart.php' method='post'>
										<input type ='hidden' name='remove' value='" . $row['RECORD_itemNumber'] . "'>
										<input type ='submit' value='Remove Item'>
									</form>
								</td>
							</tr>";
		$subtotal += $row['PRICE'] * $row['quantityOrdered'];
		$items += 1; //count number of items in cart. Should it be by total of quantity or types of items?
	}
	echo "<tr>
		<td></td><td></td><td><p align='right'>Subtotal: <spam style='font-weight:bold;'>$$subtotal</span></p></td>
		<tr>
			</table></div>";
	$tax = round($subtotal * 0.08, 2);
	$total = $subtotal +  $ship + $tax;
	if($items > 1){//Just for look and feel of summary div
		$itemWord = "items";
	}else{
		$itemWord = "item";
	}

	echo "<div class='col-xs-6'>
					<div id=cartTableRight>
						<table class=table>
						<tr>
							<th class=col-lg-6>Summary</th>
						</tr><p align='left'>Subtotal $$subtotal</p></tr>
						</tr><p>Est. Shipping $$ship</p></tr>
						<tr><p>Taxes $$tax</p></tr>
						<br></br>
						<tr><p>Total $$total</p></tr>
						<tr><input type='submit' name='checkout' value='checkout'></tr>
					</div>
				</div>";

//end of main container
echo "</div>";




include ('footer.php');
?>
