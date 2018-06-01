<?php
$currentpage = 'registration';
$title = 'Registration';
include ('header.php');
include ('connection.php');
?>

<script>
function validation() {

// VALIDATION CODE HERE!

if(document.getElementById('USEREMAIL').value ==''){
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

<fieldset>
<div class="container">
<form class="well form-horizontal" action="register.php" method="POST" onsubmit="return validation()">

  <div class="form-group">
    <label class="col-md-4 control-label">E-Mail</label>
      <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
    <input name="USEREMAIL" placeholder="E-Mail Address" class="form-control"  type="text">
      </div>
    </div>
  </div>

<div class="form-group">
    <label class="col-md-4 control-label">First Name</label>
      <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    <input  name="firstName" placeholder="First Name" class="form-control"  type="text">
    </div>
  </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Last Name</label>
      <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    <input  name="lastName" placeholder="Last Name" class="form-control"  type="text">
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">Date of Birth</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
  <input name="DOB" placeholder="Format: YYYY-MM-DD" class="form-control"  type="date">
    </div>
  </div>
</div>

  <div class="form-group">
    <label class="col-md-4 control-label">Password</label>
      <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    <input name="password" placeholder="Password" class="form-control"  type="password">
      </div>
    </div>
  </div>

 <div class="form-group">
    <label class="col-md-4 control-label">Repeat Password</label>
      <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    <input name="password2" placeholder="Repeat password" class="form-control"  type="password">
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label">Address</label>
      <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
    <input name="address" placeholder="Address" class="form-control"  type="text">
      </div>
    </div>
  </div></>

  <div class="form-group">
    <label class="col-md-4 control-label">City</label>
      <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
    <input name="city" placeholder="city" class="form-control"  type="text">
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
  <input name="postal_code" placeholder="Postal Code" class="form-control"  type="text">
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

  <a href="login.php">Already registered? Click here to login.</a>

</form>
</div>
</fieldset>

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
          echo "User account created. <script>setTimeout(function() {
        		window.location='index.php';
        	}, 2000)</script>";
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

include ('footer.php');
?>
</html>
