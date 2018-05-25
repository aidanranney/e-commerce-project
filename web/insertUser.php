<?php
$currentpage = 'registration';
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
} if(document.getElementById('MAILADDRESS').value ==''){
	alert("Please include your mailing address");
	return false;
}
}
</script>
	</head>

	<body>
<form action="setUser.php" method="POST" onsubmit="return validation();">
	<p>Email Address:<input type="text" name="USEREMAIL" id="USEREMAIL"/></p>
	<p>First Name: <input type="text" name="firstName" id="firstName" /></p>
  <p>Last Name:<input type="text" name="lastName" id="lastName"/></p>
  <p>Date of Birth: <input type="date" name="DOB" id="DOB" /></p>
  <p>Password<input type="text" name="password" id="password"/></p>
  <p>Mailing Address: <input type="text" name="MAILADDRESS" id="MAILADDRESS" /></p>
  <p>Shipping Address:<input type="text" name="SHIPADDRESS" id="SHIPADDRESS"/></p>
  <p>Phone Number: <input type="text" name="phoneNumber" id="phoneNumber" /></p>
	<p><input type="submit" value="Submit" /></p>

</form>
	</body>
<?php include ('footer.php');
?>
</html>
