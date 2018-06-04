<?php
session_start();
$currentpage = 'cart';
$title = "Your cart";
include ('connection.php');
if (isset($_SESSION['useremail'])) {
	$email = $_SESSION['useremail'];

	// Remove single item code
	if (!empty($_POST['remove'])) {
		$removedItem = $_POST['remove'];
		$removeQuery = "DELETE FROM SHOPPING_CART
										WHERE RECORD_itemNumber = " .  $removedItem . "
										AND USER_ACCOUNT_USEREMAIL = '$email'";
		if(mysqli_query($link, $removeQuery) or die("Error: ".mysqli_error($link))){
		}else {
			$error = true;
		}
	}

	// Remove all items code
	if(!empty($_POST['removeAll'])) {
		$itemNumbers = $_POST['removeAll'];
		foreach ($itemNumbers as $itemNumber) {
			$removeQuery = "DELETE FROM SHOPPING_CART
											WHERE RECORD_itemNumber = " .  $itemNumber . "
											AND USER_ACCOUNT_USEREMAIL = '$email'";
			if(mysqli_query($link, $removeQuery) or die("Error: ".mysqli_error($link))){
			} else {
				$error = true;
			}
		}
	}

	// Update item(s) code
	if(!empty($_POST['quantities'])) {
		$itemNumbers = $_POST['itemNumbers'];
		$quantities = $_POST['quantities'];
		foreach (array_combine($itemNumbers, $quantities) as $itemNumber => $quantity) {
			$updateQuery = "UPDATE SHOPPING_CART SET quantityOrdered = $quantity WHERE USER_ACCOUNT_USEREMAIL = '$email' AND RECORD_itemNumber = $itemNumber";
			if(mysqli_query($link, $updateQuery) or die("Error: ".mysqli_error($link))) {
			} else {
				$error = true;
			}
		}
	}
}
include ('header.php');
?>

<div class=container>
<h1>Your Cart</h1>

<?php
if (isset($_SESSION['useremail'])) {// Display Alerts

	// Display Remove single item
	if (!empty($_POST['remove'])) {
		if (isset($error)) {
			echo "<p class='alert alert-danger'>There was a problem removing your items!</p>";
		} else {
			echo "<p class='alert alert-danger'>Item removed from cart!</p>";
		}
	}

	// Display Remove all items
	if(!empty($_POST['removeAll'])) {
		if (isset($error)) {
			echo "<p class='alert alert-danger'>There was a problem removing your items</p>";
		} else {
			echo "<p class='alert alert-danger'>Items removed!</p>";
		}
	}

	// Display Update item(s)
	if(!empty($_POST['quantities'])) {
		if (isset($error)) {
			echo "<p class='alert alert-danger'>There was a problem updating your items</p>";
		} else {
			echo "<p class='alert alert-success'>Items updated!</p>";
		}
	}
}

?>

<!-- left side cart table headers-->
<div class='col-sm-6' id=cartTableLeftDiv>
	<table class=table>
	<tr>
		<th class=col-sm-6 style="padding-bottom:10px"><h4>Item</h4></th>
		<th class=col-sm-4 style="padding-bottom:10px"><h4>Price</h4></th>
		<th class=col-sm-2 style="padding-bottom:10px"><h4>Quantity</h4></th>
	</tr>

<?php


		$subtotal = 0;
		$total = 0;
		$ship = 5.00;
		$tax = 0;
		$items = 0;
		if (isset($_SESSION['useremail'])) {
			$numRows = 0;
			$itemIndex = 0;
			$query = "SELECT sc.RECORD_itemNumber, sc.quantityOrdered, r.artist, r.albumTitle, r.PRICE, r.albumArtwork
					FROM SHOPPING_CART sc, RECORD r
					WHERE  sc.RECORD_itemNumber=r.itemNumber
					AND sc.USER_ACCOUNT_USEREMAIL = '$email'";
			echo "<form id='update' action='cart.php' method='post'></form>";
			echo "<form id='removeAll' action='cart.php' method='post'></form>";
			$result = mysqli_query($link, $query) or die("Error: ".mysqli_error($link));
			while ($row = mysqli_fetch_array($result)) {
				echo "<tr>
										<td>
											<form action='cart.php' method='post'>
											<input type='hidden' name='remove' value='" . $row['RECORD_itemNumber'] . "'>
											<input class='btn btn-danger remove-btn' type='submit' value='Remove Item'>
											</form>
											<div class='photo'>
												<img src='" . $row['albumArtwork'] . "' alt='Product Image' onerror=" . "this.onerror=null;this.src='../images/records.jpg';" . "height=100 width=100>
											</div>
											<p style='font-size:14pt'>" . $row['artist'] . " - " . $row['albumTitle'] . "</p>
										</td>
										<td>
										<p>$" . $row['PRICE'] * $row['quantityOrdered'] . "</p>
										</td>
										<td>
												<input type='number' form='update' name='quantities[]' value='" . $row['quantityOrdered'] . "'min='1' size='1'>
										</td>
										<input type='hidden' form='update' name='itemNumbers[]' value='" . $row['RECORD_itemNumber'] . "'>
										<input type='hidden' form='removeAll' name='removeAll[]' value='" . $row['RECORD_itemNumber'] . "'>
							</tr>";
									$numRows++;
									$subtotal += $row['PRICE'] * $row['quantityOrdered'];
					}
					echo "<tr>
								<td>";
									if ($numRows > 0) {
										echo "<input class='btn btn-danger remove-btn' type='submit' form='removeAll' value='Remove All' style='margin-right:100px;'>";
									}
					echo "</td>
								<td>
								</td>
									<td>";
									if ($numRows > 0) {
										echo "<input class='btn btn-primary' form='update' type='submit' value='Update Order' style='float:right;'>";
									}
					echo "<p align='right'>   Subtotal: <strong>$$subtotal</strong></p>
								</td>
								<tr>
								</table>
				</div>";
				// end of left side table

				$tax = round($subtotal * 0.08, 2);
				$total = $subtotal + $ship + $tax;
		}

?>

<!-- the right side summary table... -->
						<div class='col-sm-6' id='cartTableRightDiv'>
						<h4 id='summaryTitle'>Summary</h4>
							<table class='table summaryTable'>
									<tr class='cell'>
									<td style='border-top: none;'><strong>Subtotal:</strong></td>
									<td style='text-align:right; border-top: none;'>$<?php echo $subtotal ?></td>
									</tr>
									<tr>
									<td style='border-top: none;'><strong>Est. Shipping:</strong></td>
									<td style='text-align:right; border-top: none;'>$<?php echo $ship ?></td>
									</tr>
									<tr>
									<td style='border-top: none; padding-bottom: 20px'><strong>Taxes:</strong></td>
									<td style='text-align:right; border-top: none; padding-bottom: 20px'>$<?php echo $tax ?></td>
									</tr>
									<tr>
									<td style='border-top: 1px solid black;'><strong>Total:</strong></td>
									<td style='text-align:right; border-top: 1px solid black;'><strong>$<?php echo $total ?></strong></td>
									</tr>
									<tr style='text-align:right;'>
									<td style='border-top: none;'></td>
									<td style='border-top: none;'><a href='#'><input type='submit' name='checkout' value='Checkout' class='btn btn-success '></a></td>
									</tr>
							</table>
						</div>

<!--end of main container-->
</div>



<?php
include ('footer.php');
?>
