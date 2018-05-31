<?php
$currentpage = 'login';
$title = 'Login Page';
include ('header.php');
include ('connection.php');
?>
<div class="container">
<form id="myForm" action="loginconfirm.php?itemNumber=<?php echo $_GET['itemNumber'];?>" method="POST">
  <p> Email: <input type="text" name="useremail" id="useremail" required pattern="^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*$"></p>
  <p> Password: <input type="password" name="password" id="password" required minlength="4"></p>
  <input type="submit" value="Submit"/>
</form>
</div>
<br>
<br>
<a href="register.php">Not registered yet? Click here to create an account.</a>

<?php
include ('footer.php');
?>
