<?php
session_start();
$currentpage = 'orderhistory';
$title = "Order History";
include ('connection.php');
include ('header.php');
?>

<div class=container>
<h1>Order History</h1>

<div class='col-sm-6' id=cartTableLeftDiv>
<table class=table>
	<tr>
		<th class=col-sm-2 style="padding-bottom:10px"><h4>Order: #</h4></th>
		<th class=col-sm-2 style="padding-bottom:10px"><h4>Order Date</h4></th>
		<th class=col-sm-2 style="padding-bottom:10px"><h4>Status</h4></th>
		<th class=col-sm-6 style="padding-bottom:10px"><h4>Item</h4></th>
		<th class=col-sm-4 style="padding-bottom:10px"><h4>Price</h4></th>
		<th class=col-sm-2 style="padding-bottom:10px"><h4>Quantity</h4></th>
	</tr>

<?php
if (isset($_SESSION['useremail'])) {
	$email = $_SESSION['useremail'];
	$currentOrder = 0;
	//sc.RECORD_itemNumber, sc.quantityOrdered, r.artist, r.albumTitle, r.PRICE, r.albumArtwork
	$query = "SELECT i.invoiceID, i.purchaseDate, i.orderStatus, 
					ip.RECORD_itemNumber, ip.price, ip.quantity,
					r.artist, r.albumTitle, r.albumArtwork, r.quality
				FROM INVOICE i, INVOICE_PRODUCT ip, RECORD r
				WHERE i.invoiceID=ip.INVOICE_invoiceID
				AND ip.RECORD_itemNumber=r.itemNumber
				AND i.USER_ACCOUNT_USEREMAIL = '$email'
				ORDER BY i.invoiceID DESC";
	$result = mysqli_query($link, $query) or die("Error: ".mysqli_error($link));
	while ($row = mysqli_fetch_array($result)) {
		echo "<tr>";
			if($currentOrder != $row['invoiceID']){//Display order # if start of new Order
				$currentOrder = $row['invoiceID'];
				echo "
				<td><p>" . $row['invoiceID'] . "</p></td>
				<td><p>" . $row['purchaseDate'] . "</p></td>
				<td><p>" . $row['orderStatus'] . "</p></td>";
			}else{//Blank table cells for spacing of table
				echo"
				<td></td>
				<td></td>
				<td></td>";
			}
				echo"
				<td>
					<div class='photo'>
						<img src='" . $row['albumArtwork'] . "' alt='Product Image' onerror=" . "this.onerror=null;this.src='../images/records.jpg';" . "height=100 width=100>
					</div>
					<p style='font-size:14pt'>" . $row['artist'] . " - " . $row['albumTitle'] . "</p>
				</td>
				<td>
					<p>$" . $row['price'] * $row['quantity'] . "</p>
				</td>
				<td>
					<p>" . $row['quantity'] . "</p>
				</td>
			</tr>";
	}
}
?>
</table>
</div>
<!--end of main container-->
</div>







<?php
include ('footer.php');
?>