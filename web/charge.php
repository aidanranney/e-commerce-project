<?php
  session_start();
  $currentpage = 'cart';
  $title = "Your cart";
  include ('connection.php');
  include ('header.php');
  require_once('./config.php');

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

  if (isset($_SESSION['useremail'])) {
      $email = $_SESSION['useremail'];
  // ToDo:
    // -- ToDo: insert into invoice table the data from the shopping cart

    // -- ToDo: write to html page the data from the invoice table



          //get invoice id and purchase date
          $query = "SELECT * FROM INVOICE
                      WHERE USER_ACCOUNT_USEREMAIL = '$email'
                      AND purchaseDate = (SELECT MAX(purchaseDate)
                      FROM INVOICE WHERE USER_ACCOUNT_USEREMAIL = '$email')";
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
        $shipCost = 0;
        while ($row = mysqli_fetch_array($result)) {
          $items = $items . nl2br("\n" . $row['quantity'] . " x " . $row['albumTitle'] . " -- " . $row['artist']) . " ("
                  . $row['price'] . " each)";
          $subtotal += $row['price'] * $row['quantity'];
          $totalQuantity += $row['quantity'];
        }
        $shipCost += 0.07 * $totalQuantity;
        $pstTax = round($subtotal * 0.05, 2);
				$hstTax = round($subtotal * 0.07, 2);
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
                  <p>Items: " . $items . "</p>
                  <p>Shipping Address:</p>
                    <div style='text-indent:50px;'>
                    <p>" . $address . "</p>
                    <p>" . $city . "</p>
                    <p>" . $province . "</p>
                    <p>" . $postalcode . "</p>
                    </div>
                  <p><strong>Total: " . $total . "</strong></p>
                  <p>Thanks for your business!</p>
              </body>
        </html>";

      $date = date("Y-m-d-H-i");
      $file = "../invoices/" . $nameForFile . $date . ".html";
      if (file_put_contents($file, $data)) {
        echo "<h4>saved to file. <a href='" . $file . "'>View order email</a></h4>";
      } else {
        echo "<h4>not saved to file</h4>";
      }
    }

    // -- ToDo: delete data from shopping cart

    $totalCart = number_format(($totalCart / 100), 2);
    echo '<h4>Successfully charged ' . $totalCart . '!</h4>';
    echo "<h4>Thanks for shopping at Mick's Licks</h4>";
?>
