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

<div class="container">
<form action="register.php" method="POST" onsubmit="return validation()">
	<p><label>Email Address:</label> <input type="email" name="USEREMAIL" id="USEREMAIL" placeholder="youremail@youremail.com"/></p>
	<p><label>First Name:</label> <input type="text" name="firstName" id="firstName" /></p>
  <p><label>Last Name:</label> <input type="text" name="lastName" id="lastName"/></p>
  <p><label>Date of Birth:</label> <input type="date" name="DOB" id="DOB" title="Format: YYYY-MM-DD"/></p>
  <p><label>Password:</label> <input type="password" name="password" id="password" placeholder="Min. 4 Characters"/></p>
  <p><label>Repeat Password:</label> <input type="password" name="password2" id="password2" placeholder="Repeat your password" />
  <p><label>Address:</label> <input type="text" name="address" id="address"/></p>
  <p><label>City:</label> <input type="text" name="city" id="city"/></p>
  <p><label>Province:</label>   <select name="province" id="province">
    <option value="BC" selected="BC">
      British Columbia
      </option>
    <option value="AB">
      Alberta
      </option>
    <option value="SK">
      Saskatchewan
      </option>
    <option value="MB">
      Alberta
      </option>
    <option value="ON">
      Ontario
      </option>
    <option value="QC">
      Quebec
      </option>
    <option value="NB">
      New Brunswick
      </option>
    <option value="PE">
      Prince Edward Island
      </option>
    <option value="NS">
      Nova Scotia
      </option>
    <option value="NL">
      Newfoundland and Labrador
      </option>
    <option value="YT">
      Yukon
      </option>
    <option value="NT">
      Northwest Territories
      </option>
    <option value="NU">
      Nunavut
      </option>
    </select></p>
  <p><label>Postal Code:</label> <input type="text" name="postal_code" id="postal_code"/></p>
  <p><label>Phone Number:</label> <input type="tel" name="phoneNumber" id="phoneNumber" placeholder="555-555-5555" /></p>
	<p><input type="submit" name="submit" value="Submit" /></p>

</form>
</div>

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
