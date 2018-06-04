<?php
$currentpage = 'registration';
$title = 'Registration';
include ('header.php');
include ('connection.php');
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
