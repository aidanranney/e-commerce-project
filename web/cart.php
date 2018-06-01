<?php
$currentpage = 'cart';
$title = "Your cart";
include ('header.php');
include ('connection.php');
?>

<!--
Todo list:

Remove item from cart
Update cart quantity of items - mostly likely will have to be an update button.
Basic checkout page.

General visual and layout improvements.

Note background-colors are only to help identify different elements.
-->

<div class=container>
<h1>Your Cart</h1>

<?php
if (isset($_SESSION['useremail'])) {
	$email = $_SESSION['useremail'];
	if(!empty($_POST['remove'])){
		$removedItem = $_POST['remove'];
		$removeQuery = "DELETE FROM SHOPPING_CART
										WHERE RECORD_itemNumber =" .  $removedItem . "
										AND USER_ACCOUNT_USEREMAIL = '$email'";
		if(mysqli_query($link, $removeQuery) or die("Error: ".mysqli_error($link))){
			echo "<p class='alert alert-danger'>Item removed from cart!</p>";
		}else{//Remove - Update Cart Items -- This may look better if inline with your cart but floating to the right
			echo "<p class='alert alert-danger'>Removal of item failed!</p>";
		}
	}
	if(!empty($_POST['update'])) {

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
										<form action='cart.php' method='post'>
											<input type ='hidden' name='remove' value='" . $row['RECORD_itemNumber'] . "'>
											<input class='btn btn-danger remove-btn' type='submit' value='Remove Item'>
										</form>
											<div class='photo'>
												<a href=''#''> <img src='" . $row['albumArtwork'] . "' alt='Product Image' onerror=" . "this.onerror=null;this.src='../images/records.jpg';" . "height=100 width=100></a>
											</div>
											<p style='font-size:14pt'>" . $row['artist'] . " - " . $row['albumTitle'] . "</p>
										</td>
										<td>
										<p>$" . $row['PRICE'] * $row['quantityOrdered'] . "</p>
										</td>
										<td>
											<input type='number' name='quantity' value='" . $row['quantityOrdered'] . "' min='0' size='1'>
											<br></br>
											<form action='cart.php' method='post'>
												<input type='hidden' name='itemNumber' value='" . $row['RECORD_itemNumber'] . "'>
												<input type='hidden' name='itemNumber[]' value='" . $row['RECORD_itemNumber'] . "'>
												<input class='btn btn-primary' type='submit' value='Update Order'>
											</form>
										</td>
									</tr>";

									$subtotal += $row['PRICE'] * $row['quantityOrdered'];

						// $items += 1; //count number of items in cart. Should it be by total of quantity or types of items?
						// if($items > 1){
						// 	$itemWord = "items";
						// }else{
						// 	$itemWord = "item";
						// }

					}
					echo "<tr>
								<td></td><td></td><td><p align='right'>Subtotal: <strong>$$subtotal</strong></p></td>
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
									<td style='border-top: none;'><input type='submit' name='checkout' value='Checkout' class='btn btn-success checkout-btn'></td>
									</tr>
							</table>
						</div>

<!--end of main container-->
</div>



<?php
include ('footer.php');
?>
