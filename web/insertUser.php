<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>PHP Form Send</title>

	</head>

	<body>
<form action="setUser.php" method="POST">
	<p>Email Address:<input type="text" name="USEREMAIL"/></p>
	<p>First Name: <input type="text" name="firstName" /></p>
  <p>Last Name:<input type="text" name="lastName"/></p>
  <p>Date of Birth: <input type="date" name="DOB" /></p>
  <p>Password<input type="text" name="password"/></p>
  <p>Mailing Address: <input type="text" name="MAILADDRESS" /></p>
  <p>Shippig Address:<input type="text" name="SHIPADDRESS"/></p>
  <p>Phone Number: <input type="text" name="phoneNumber" /></p>
	<p><input type="submit" value="Submit" /></p>

</form>
	</body>
</html>
