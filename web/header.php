<?php
session_start();
ini_set('display_errors', 1);
include ('connection.php');
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title><?php print $title ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
        <link rel="stylesheet" href="CSS/styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src='JS/scripts.js'></script>
    </head>
    <div class="container-fluid">
      <div class="jumbotron">
        <h1>Mick's Licks</h1>
        <p>Buy used and new records on the internet, from my garage.</p>
      </div>
    </div>

    <body style="padding: 5px">
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Genres
                  <span class="caret"></span></a>
                    <ul class="dropdown-menu">

<!--List record categories from database-->
                      <?php
                        $categories = mysqli_query($link,'select genre from GENRE');
                        echo "<li id='All'><a href='index.php'>All</a></li>";
                        if ($categories)   {
                          while ($result = mysqli_fetch_array($categories)) {
                          $id = $result['genre'];
                          echo "<li id=" . $id . "><a href='index.php?genre=$id'>" . $id . "</a></li>";
                          }
                        }

                      ?>
                    </ul>
            </li>

            <li <?php
              if ($currentpage == 'home') {
                print 'class="active"';
              }
            ?>><a href="index.php">Home</a></li>

            <li <?php
              if ($currentpage == 'about') {
                print 'class="active"';
              }
            ?>><a href="about.php">About</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">


            <li <?php
                if ($currentpage == 'addrecord') {
                  print 'class="active"';
                }
              ?>><a href="addrecord.php" <?php
              if (!isset($_SESSION['admin'])) {
                echo "style='display:none;'";
              } else {
                if ($_SESSION['admin']!='Y') {
                  echo "style='display:none;'";
                }
              } ?>>Add Record</a></li>

            <li <?php
              if ($currentpage == 'login') {
                echo 'class="active"';
              }
              if (isset($_SESSION['useremail'])) {
                echo "style='display:none;'";
              }
            ?>><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>Login</a></li>

            <li <?php
              if ($currentpage == 'registration') {
                echo 'class="active"';
              }
              if (isset($_SESSION['useremail'])) {
                echo "style='display:none;'";
              }
            ?>><a href="register.php"><span class="glyphicon glyphicon-user"></span>Register</a></li>

<!--Create shopping cart icon, and list the number of current items inside of it.-->
            <?php
              $numItems=0;
              if (isset($_SESSION['useremail'])) {
                echo "<li ";
                if ($currentpage == 'cart') {
                                echo 'class="active"';
                              }
                echo " ><a href='cart.php'><span class='glyphicon glyphicon-shopping-cart'></span>Cart (";
                $cartItems = mysqli_query($link, 'SELECT quantityOrdered from SHOPPING_CART');
                while ($itemAmount=mysqli_fetch_array($cartItems)) {
                  $numItems += $itemAmount['quantityOrdered'];
                }
                echo $numItems . ")</a></li>";
                echo "<li><a href='logout.php'>Logout</a></li>";
              }
            ?>
            </li>
            </ul>
            </div>
        </nav>

    <!-- Collect the nav links, forms, and other content for toggling -->
