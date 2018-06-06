<?php
  session_start();
  $currentpage = 'cart';
  $title = "Your cart";
  include ('connection.php');
  include ('header.php');
  require_once('./config.php');

  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];

  $customer = \Stripe\Customer::create(array(
      'email' => $email,
      'source'  => $token
  ));

  $charge = \Stripe\Charge::create(array(
      'customer' => $customer->id,
      'amount'   => 5000,
      'currency' => 'usd'
  ));

  // ToDo:
    // -- insert into invoice table the data from the shopping cart
    // -- write to html page the data from the shopping cart
    // -- delete data from shopping cart

  echo '<h4>Successfully charged $50.00!</h4>';
?>
