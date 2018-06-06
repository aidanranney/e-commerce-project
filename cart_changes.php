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
echo "<div class=container>
<h1>Your Cart</h1>
<<<<<<< HEAD
	<table width='600' align='left' style='display:inline;background-color:lightblue'>
=======
	<div id=cartTableLeft>
	<table class=table>
>>>>>>> made a few more small changes to the left table layout
		<tr>
			<th class=col-lg-2>Item</th>
			<th class=col-lg-4>Price</th>
			<th class=col-lg-6>Quantity</th>
		</tr>";

	$subtotal = 0;
	$total = 0;
	$ship = 5.00;
	$tax = 0;
	$items = 0;
	$email = $_SESSION['useremail'];
	$query = "SELECT sc.RECORD_itemNumber, sc.quantityOrdered, r.artist, r.albumTitle, r.PRICE, r.albumArtwork
			FROM SHOPPING_CART sc, RECORD r
			WHERE  sc.RECORD_itemNumber=r.itemNumber
			AND sc.USER_ACCOUNT_USEREMAIL = '$email'";
	$result = mysqli_query($link, $query);
	while ($row = mysqli_fetch_array($result)) {
		echo "<tr>
<<<<<<< HEAD
								<td>
									<div class='photo'>
										<a href=''#''> <img src='" . $row['albumArtwork'] . "' alt='Product Image' height=100 width=100></a>
									</div>
									<p style='display:inline;font-size:16pt;'>" . $row['artist'] . "</p>
									<p style='display:inline;'>" . $row['albumTitle'] . "</p>
									<input type='submit' name='remove' value='Remove Item' action='Remove this item'>
								</td>
								<td>
									<p>$" . $row['PRICE'] . "</p>
								</td>
								<td>
									<input type='number' name='quantity' value='" . $row['quantityOrdered'] . "' max='9' size='1'>
								</td>
							</tr>";
=======
						<td><div class='photo'>
								<a href=''#''> <img src='" . $row['albumArtwork'] . "' alt='Product Image' height=100 width=100/> </a>
							</div>
							<p style='font-size:16pt;'>" . $row['artist'] . "</p>
							<p >" . $row['albumTitle'] . "</p>
							<input type='submit' name='remove' value='Remove Item' action='Remove this item';
						</td>
						<td><p>$" . $row['PRICE'] . "</p></td>
						<td><input type='number' name='quantity' value='" . $row['quantityOrdered'] . "' max='9' size='1'></td>

			</tr>";
>>>>>>> made a few more small changes to the left table layout
		$subtotal += $row['PRICE'] * $row['quantityOrdered'];
		$items += 1; //count number of items in cart. Should it be by total of quantity or types of items?
	}
	echo "<tr>
		<td></td><td></td><td><p>Subtotal: <spam style='font-weight:bold;'>$$subtotal</span></p></td>
		<tr>
			</table>
			</div>";
	$tax = round($subtotal * 0.08, 2);
	$total = $subtotal +  $ship + $tax;
	if($items > 1){//Just for look and feel of summary div
		$itemWord = "items";
	}else{
		$itemWord = "item";
	}
	echo "<div align='right' width='100' style='display:inline-block;background-color:grey'>
				<h4>Summary ($items $itemWord)</h4>
				<p align='left'>Subtotal $$subtotal</p>
				<p>Est. Shipping $$ship</p>
				<p>Taxes $$tax</p>
				<br>
				<p>Total $$total</p>
				<input type='submit' name='checkout' value='checkout' >
		<div>";
echo "</div>";




include ('footer.php');
?>
