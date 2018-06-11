<?php
  session_start();
  $currentpage = 'cart';
  $title = "Your cart";
  include ('connection.php');
  include ('header.php');
  require_once('./config.php');

if (isset($_SESSION['useremail']) && isset($_POST['totalCart'])) {
	//Stripe data
	$token  = $_POST['stripeToken'];
	$email  = $_POST['stripeEmail'];

	$totalCart = $_POST['totalCart'];

	$customer = \Stripe\Customer::create(array(
      'email' => $email,
      'source'  => $token
	));

	$charge = \Stripe\Charge::create(array(
      'customer' => $customer->id,
      'amount'   => $totalCart,
      'currency' => 'cad'
  ));

    $email = $_SESSION['useremail'];
    // -- insert into invoice table the data from the shopping cart
	$insertInvoice = "INSERT INTO INVOICE (purchaseDate, orderStatus, USER_ACCOUNT_USEREMAIL)
						VALUES (now(), 'processing', '$email');";
	if(mysqli_query($link, $insertInvoice) or die("Error: ".mysqli_error($link))){
	}else {
			$error = true;
	}

	$invoiceNum = mysqli_insert_id($link);//get last auto generated id

	$getCartQuery = "SELECT sc.RECORD_itemNumber, r.PRICE, sc.quantityOrdered
					FROM SHOPPING_CART sc, RECORD r
					WHERE sc.RECORD_itemNumber=r.itemNumber
					AND USER_ACCOUNT_USEREMAIL = '$email';";
	$result = mysqli_query($link, $getCartQuery) or die("Error: ".mysqli_error($link));
    while ($row = mysqli_fetch_array($result)) {
		$insertItems = "INSERT INTO INVOICE_PRODUCT (RECORD_itemNumber, INVOICE_invoiceID, price, quantity)
											VALUES (" . $row['RECORD_itemNumber'] . ", $invoiceNum," . $row['PRICE'] . "," . $row['quantityOrdered'] . ")";
		if(mysqli_query($link, $insertItems) or die("Error: ".mysqli_error($link))){
		}else {
				$error = true;
		}
    }

    // -- write to html page the data from the invoice table
          //get invoice id and purchase date
          $query = "SELECT * FROM INVOICE
                      WHERE USER_ACCOUNT_USEREMAIL = '$email'
                      AND invoiceID = $invoiceNum";
          $result = mysqli_query($link, $query) or die("Error: ".mysqli_error($link));
          while ($row = mysqli_fetch_array($result)) {
            $invoiceID = $row['invoiceID'];
            $puchaseDate = $row['purchaseDate'];
          }

          // get customer data
          $query = "SELECT firstName, lastName, address, city, province, postal_code
                    FROM USER_ACCOUNT
                    WHERE USEREMAIL = '$email'";
          $result = mysqli_query($link, $query) or die("Error: ".mysqli_error($link));
          while ($row = mysqli_fetch_array($result))  {
            $name = $row['firstName'] . " " . $row['lastName'];
            $nameForFile = $row['firstName'] . "_" . $row['lastName'];
            $address = $row['address'];
            $city = $row['city'];
            $province = $row['province'];
            $postalcode = $row['postal_code'];
          }

        // get invoice data
        $query = "SELECT i.invoiceID, i.purchaseDate, i.orderStatus,
  					ip.RECORD_itemNumber, ip.price, ip.quantity,
  					r.artist, r.albumTitle
  				FROM INVOICE i, INVOICE_PRODUCT ip, RECORD r
  				WHERE i.invoiceID=ip.INVOICE_invoiceID
  				AND ip.RECORD_itemNumber=r.itemNumber
  				AND i.USER_ACCOUNT_USEREMAIL = '$email'
          AND i.invoiceID = '$invoiceID'";
      	$result = mysqli_query($link, $query) or die("Error: ".mysqli_error($link));
        $items = "";
        $total = 0;
        $totalQuantity = 0;
        $subtotal = 0;
        $shipCost = 5;
        while ($row = mysqli_fetch_array($result)) {
          $items = $items . nl2br("\n" . $row['quantity'] . " x " . $row['albumTitle'] . " - " . $row['artist']) . " ($"
                  . $row['price'] . " each)";
          $subtotal += $row['price'] * $row['quantity'];
          $totalQuantity += $row['quantity'];
        }
        $shipCost += 0.07 * $totalQuantity;
        $pstTax = round($subtotal * 0.05, 2);
				$hstTax = round($subtotal * 0.07, 2);
        $taxes = $shipCost + $pstTax + $hstTax;
        $total = $subtotal + $shipCost + $pstTax + $hstTax;

      $data =
        "<html>
            <head>
              <title>Mick's Licks Invoice for " . $name . "</title>
            </head>
              <body>
              <h1>Hello, " . $name . "</h1>
                <h4>Here is your album order from Mick's Licks:</h4>
                  <p>Invoice Number: " . $invoiceID ."</p>
                  <p>Purchase Date: " . $puchaseDate ."</p>
                  <p>Shipping Address:</p>
                    <section style='text-indent:50px;'>
                      <p>" . $address . "</p>
                      <p>" . $city . "</p>
                      <p>" . $province . "</p>
                      <p>" . $postalcode . "</p>
                    </section>
                  <hr style='float:left; width:200px;' />
                  <br>
                  <p>Items: " . $items . "</p>
                  <br>
                  <p>Subtotal: $" . $subtotal . "</p>
                  <p>Taxes: $" . $taxes . "</p>
                  <p><strong style='color:red; '>Total: $" . $total . "</strong></p>
                  <hr style='float:left; width:200px;' />
                  <br>
                  <p>Thanks for your business!</p>
              </body>
        </html>";

      $date = date("Y-m-d-H-i");
      $file = "../invoices/" . $nameForFile . $date . ".html";
      if (file_put_contents($file, $data)) {
        echo "<a href='" . $file . "'>View your order</a></h4>";
      } else {
        echo "<h4>Something went wrong with saving you order...</h4>";
      }

	// -- delete data from shopping cart
	$deleteQuery = "DELETE FROM SHOPPING_CART
					WHERE USER_ACCOUNT_USEREMAIL = '$email';";
	if(mysqli_query($link, $deleteQuery) or die("Error: ".mysqli_error($link))){
	}else {
			$error = true;
	}

    $totalCart = number_format(($totalCart / 100), 2);
    echo '<h4>Successfully charged ' . $totalCart . '!</h4>';
    echo "<h4>Thanks for shopping at Mick's Licks</h4>";
}else{
	//redirect user to cart or orderHistoy page.
	echo "";
}
?>
