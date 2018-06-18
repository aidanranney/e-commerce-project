<?php
session_start();
$currentpage = 'about';
$title = 'About Mick\'s Licks';
include ('connection.php');
include ('header.php');
?>

<div class="container">
<h4>All About Mick's Licks</h4>

<div id='bio'>
<p>Mick Hornby was born Michael Hornby in 1967 in Vancouver, BC's now-defunct Hogan's Alley neighbourhood. Since the age of three, he has been
  hoarding records in his garage. Never the one to let anyone near his collection, this Smaug-like audiophile amassed an enviable vinyl pile.</p>
<p> Now he is getting divorced and would rather sell everything than give anything to Carol.</p>
</div>

<div id='portrait' class='animated rollIn'>
  <img src='../images/mick.jpg'>
</div>

<?php
include('footer.php');
?>
