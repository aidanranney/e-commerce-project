<?php
$currentpage = 'login';
include ('header.php');
include ('connection.php');
?>

<html>
  <head>
  <title>Login</title>
  <script>
  function validation() {
    if (document.getElementById('useremail').value == '') {
      alert("You must include a username");
      return false;
    }
    if (document.getElementById('password')).value =='') {
      alert("You must include a password");
      return false;
    }
    if (document.getElementById('password')).value.length < 4) {
      alert("password must have at least 4 characters");
      return false;
    }
  }
  </script>
  </head>
<body>
<form action="loginconfirmation.php" method="POST" onsubmit="return validation();">
  <p> Email: <input type="text" name="useremail" id="useremail"></p>
  <p> Password: <input type="password" name="password" id="password"></p>
  <input type="submit" value="Submit">
</form>

<?php
include ('footer.php');
?>
