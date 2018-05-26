<?php
session_start();
ini_set('display_errors', 1);
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
    </head>
    <div class="container-fluid">
      <div class="jumbotron">
        <h1>Mick's Licks</h1>
        <p>Buy used and new records on the internet, from my garage.</p>
      </div>
    </div>

    <body>
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Genres
                  <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <?php
                        include ('connection.php');
                        $categories = mysqli_query($link,'select genre from GENRE');
                        if ($categories)   {
                          while ($result = mysqli_fetch_array($categories)) {
                          echo "<li><a href='#'>" . $result['genre'] . "</a></li>"; //do stuff with bootstrap dropdown categories here
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
              ?>><a href="insertAlbum.php">Add Record</a></li>
              <li <?php
                if ($currentpage == 'login') {
                  print 'class="active"';
                }
              ?>><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>Login</a></li>
              <li <?php
                if ($currentpage == 'registration') {
                  print 'class="active"';
                }
              ?>><a href="insertUser.php"><span class="glyphicon glyphicon-user"></span>Register</a></li>
            </ul>
            </div>
        </nav>


    <!-- Collect the nav links, forms, and other content for toggling -->
