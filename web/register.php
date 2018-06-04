<?php
session_start();
$currentpage = 'registration';
$title = 'Registration';
include ('connection.php');
include ('header.php');
?>

<html>
  <head>
    <title>Register</title>
    <script type="text/javascript" src='JS/scripts.js'></script>
  </head>
<fieldset>
<div class="container">
<form class="well form-horizontal" action="register.php" method="POST" onsubmit="return registrationValidation()">

  <div class="form-group">
    <label class="col-md-4 control-label">E-Mail</label>
      <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
    <input name="USEREMAIL" placeholder="E-Mail Address" class="form-control"  type="text" id="USEREMAIL" pattern="^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*$">
      </div>
    </div>
  </div>

<div class="form-group">
    <label class="col-md-4 control-label">First Name</label>
      <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    <input  name="firstName" placeholder="First Name" class="form-control"  type="text" id="firstName">
    </div>
  </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Last Name</label>
      <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    <input  name="lastName" placeholder="Last Name" class="form-control"  type="text" id="lastName">
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">Date of Birth</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
  <input name="DOB" placeholder="Format: YYYY-MM-DD" class="form-control"  type="date" id="DOB">
    </div>
  </div>
</div>

  <div class="form-group">
    <label class="col-md-4 control-label">Password</label>
      <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    <input name="password" placeholder="Password" class="form-control"  type="password" id="password">
      </div>
    </div>
  </div>

 <div class="form-group">
    <label class="col-md-4 control-label">Repeat Password</label>
      <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    <input name="password2" placeholder="Repeat password" class="form-control"  type="password" id="password2">
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label">Address</label>
      <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
    <input name="address" placeholder="Address" class="form-control"  type="text" id="address">
      </div>
    </div>
  </div></>

  <div class="form-group">
    <label class="col-md-4 control-label">City</label>
      <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
    <input name="city" placeholder="city" class="form-control"  type="text" id="city">
      </div>
    </div>
  </div>

  <div class="form-group">
  <label class="col-md-4 control-label">Province</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
    <select name="province" class="form-control selectpicker" >
      <option value=" " >Please select your Province</option>
      <option>British Columbia</option>
      <option>Alberta</option>
      <option>Saskatchewan</option>
      <option>Manitoba</option>
      <option>Ontario</option>
      <option>Quebec</option>
      <option>New Brunswick</option>
      <option>Prince Edward Island</option>
      <option>Nova Scotia</option>
      <option>Newfoundland and Labrador</option>
      <option>Yukon</option>
      <option>Northwest Territories</option>
      <option>Nunavut</option>
      <option>New Brunswick</option>
      <option>Prince Edward Island</option>
    </select>
  </div>
</div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">Postal Code</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
  <input name="postal_code" placeholder="Postal Code" class="form-control"  type="text" id="postal_code">
    </div>
  </div>
</div>

  <div class="form-group">
    <label class="col-md-4 control-label">Phone Number</label>
      <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
    <input name="phoneNumber" placeholder="(250)555-5555" class="form-control" type="text">
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label"></label>
    <div class="col-md-4">
      <button type="submit" name="submit" value="submit" class="btn btn-warning" >Register <span class="glyphicon glyphicon-check"></span></button>
    </div>
  </div>

  <!-- if item in GET request, pass it to POST -->
  <?php if (isset($_GET['itemNumber'])) {
    $itemNumber = $_GET['itemNumber'];
    echo "<input type=hidden name=itemNumber value='" . $itemNumber . "'>";
  }
  ?>

  <a href="login.php">Already registered? Click here to login.</a>

</form>
</div>
</fieldset>
<<<<<<< HEAD
=======

<?php
$flag = FALSE;

if (isset($_POST['submit'])) {
	$USEREMAIL = mysqli_real_escape_string($link, $_REQUEST['USEREMAIL']);
	$firstName = mysqli_real_escape_string($link, $_REQUEST['firstName']);
	$lastName = mysqli_real_escape_string($link, $_REQUEST['lastName']);
	$DOB = $_POST['DOB'];
	$password = mysqli_real_escape_string($link, $_REQUEST['password']);
  $password2 = $_POST['password2'];
	$address = mysqli_real_escape_string($link, $_REQUEST['address']);
  $city = mysqli_real_escape_string($link, $_REQUEST['city']);
  $province = mysqli_real_escape_string($link, $_REQUEST['province']);
  $postal_code = mysqli_real_escape_string($link, $_REQUEST['postal_code']);
	$phoneNumber = mysqli_real_escape_string($link, $_REQUEST['phoneNumber']);

  if ($password == $password2){
    $flag = TRUE;
  }

$salted = "456y45rghtrhfgr23441ldk3".$password."32490ffsll33";
//created giberish values on either side of the password to further
//secure the hashed password
$hashed = hash('sha1', $salted);
//password is hashed and salted for insertion into the database

  if ($flag == TRUE) {
    $emailQuery = "SELECT * FROM USER_ACCOUNT WHERE USEREMAIL='$USEREMAIL'" or die (mysqli_error());
    $emailResult = mysqli_query($link, $emailQuery);
    $email_count = $emailResult->num_rows;
    if ($email_count == 0) {
        $userQuery = "INSERT INTO USER_ACCOUNT (USEREMAIL, firstName, lastName, DOB, password, address, city, province, postal_code, phoneNumber) VALUES
        ('$USEREMAIL', '$firstName', '$lastName', '$DOB', '$hashed', '$address', '$city', '$province', '$postal_code', '$phoneNumber')";

          if(mysqli_query($link, $userQuery)){
          echo "User account created.";
          $_SESSION['useremail']=$USEREMAIL;

          // if user tried to add a record before registering, add record and redirect to new cart.
          if (isset($_POST['itemNumber'])) {
            $item = $_POST['itemNumber'];
            $addItem = "INSERT INTO SHOPPING_CART (quantityOrdered, RECORD_itemNumber, USER_ACCOUNT_USEREMAIL)
            VALUES (1, '$item', '$USEREMAIL')";
              if ((mysqli_query($link, $addItem)) or die("Error: ".mysqli_error($link))) {
                echo "<p class='alert alert-success'>Record Added to your new cart!</p>";
              } else {
                echo "<p class='alert alert-danger'>Something went wrong" . mysqli_error($link) . "</p>";
              }
            echo "<script>setTimeout(function() {
          		window.location='cart.php';
          	  }, 2000)</script>";
          } else {
            echo "<script>setTimeout(function() {
        		window.location='index.php';
        	  }, 2000)</script>";
          }

    } else {
      echo "Error: Could not execute $userQuery." . mysqli_error($link);
    }
} else {
echo "That user account is already in use.";
  }
} else {
  echo "Your passwords do not match!";
}
}
?>

<script>
function validation() {

// VALIDATION CODE HERE!

if(document.getElementById('USEREMAIL').value =='') {
  alert("You must include a valid Email Address");
  return false;
} if(document.getElementById('firstName').value ==''){
  alert("Please include your first name");
  return false;
} if(document.getElementById('lastName').value ==''){
	alert("Please include your first name");
	return false;
} if(document.getElementById('DOB').value < 1998-01-01){
  alert("You must be at least 18 years old");
  return false;
} if(document.getElementById('password').value.length < 4){
  alert("Password must have at least 4 characters");
  return false;
} if(document.getElementById('address').value ==''){
	alert("Please include your address");
	return false;
} if(document.getElementById('city').value ==''){
	alert("Please include your city");
	return false;
}if(document.getElementById('province').value ==''){
	alert("Please include your province");
	return false;
}if(document.getElementById('postal_code').value ==''){
  	alert("Please include your postal code");
  	return false;
  }
}
</script>

<?php
include ('footer.php');
?>
>>>>>>> changed code on index page to make cart number update properly
