<?php
$currentpage = 'login';
$title = 'Login Page';
include ('header.php');
include ('connection.php');
?>
<div class="container">
<?php
if (isset($_GET['itemNumber'])) {
  echo "<form class='well form-horizontal' id='myForm' action='loginconfirm.php?itemNumber=" . $_GET['itemNumber'] . "' method='POST'>";
} else {
  echo "<form class='well form-horizontal' id='myForm' action='loginconfirm.php' method='POST'>";
}
?>
<div class="container">

  <div class="form-group">
    <label class="col-md-4 control-label">E-Mail</label>
      <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
    <input name="useremail" placeholder="E-Mail Address" class="form-control"  type="text" required pattern="^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*$">
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label">Password</label>
      <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    <input name="password" placeholder="Password" class="form-control"  type="password" required minlength="4">
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label"></label>
    <div class="col-md-4">
      <button type="submit" class="btn btn-warning"> Login <span class="glyphicon glyphicon-check"></span></button>
    </div>
  </div>
<a <?php if (isset($_GET['itemNumber'])) {
  echo "href='register.php?itemNumber=" . $_GET['itemNumber'] . "'";
  } else {
  echo "href='register.php'";
  }
  ?>
  >Not registered yet? Click here to create an account.</a>
</form>
</div>

<?php
include ('footer.php');
?>
