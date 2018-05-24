<?php
include ('header.php');
include ('connection.php');
?>

<html>
  <head>
  <title>Login Confirmation</title>
  </head>
  <body>
    <?php
    $useremail = $_POST['useremail'];
    $password = $_POST['password'];
    echo "$useremail $password";
    //create query
    $query = "SELECT * from USER_ACCOUNT WHERE USEREMAIL='$useremail' AND password='$password'";
    //run query. the @ symbol suppresses errors
    $row = @mysqli_query ($link, $query);
    //check the result
    if (mysqli_num_rows($row) == 1) {
    	echo "You have logged in successfully";
    	$_SESSION['useremail']=$useremail;
    } else {
    	echo "<h4>Invalid login credentials. Please <a href='login.php'>try again</a></h4>";
    }
    ?>
  </body>
</html>
