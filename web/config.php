<?php
require_once('vendor/autoload.php');

$stripe = array(
  "secret_key"      => "sk_test_L66KF3ChDKVoobIBLI5A4sr7",
  "publishable_key" => "pk_test_FaMbCdGS5nOFRDLMRFEi11Ef"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>
