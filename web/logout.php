<?php
session_start();//session is a way to store information (in variables) to be used across multiple pages.
session_destroy();
echo "You are now logged out. Redirecting to home page...";
echo "<script>setTimeout(function() {
  window.location='index.php';
}, 2000)</script>";
?>
