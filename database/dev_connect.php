<html>
<head>
  <title>Database connect</title>
</head>
<body>
  <?php
  if ($dbc = mysqli_connect('localhost', 'cst161', '427021', 'ICS199Group08_dev')) {
  print '<p>Successfully connected to the database</p>';
  mysqli_close($dbc);
} else {
  print '<p style="color: red;">Could not connect to the database.</p>';
}
?>
</body>
</html>
