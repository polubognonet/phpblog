<?php

session_start();
include 'includes/dbh.inc.php';
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/input.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="header">
      <div class="headerWrap">
      <div class="websiteLogo">
        <p>My PHP Blog</p>
      </div>
      <div class="headerNav">
        <form action="includes/login.inc.php" method="post">
        <div class="adminP">
          <div class="col-3">
                      <input class="effect-8" type="text" name="login" placeholder="Username" autocomplete="off">
                          <span class="focus-border">
                            <i></i>
                          </span>
                </div>
        </div>
        <div class="adminP">
          <div class="col-3">
                      <input class="effect-8" type="password" name="password" placeholder="Password" autocomplete="off">
                          <span class="focus-border">
                            <i></i>
                          </span>
                </div>
        </div>
        <div class="adminP" style="width: 14%;">
          <button class = 'loginbutton' type='submit' name='loginbutton'>Log in</button>
        </div>
        </form>
      </div>
      </div>
    </div>
    <div class="wrapper">
      <div class="postsHeader">
        <p>POSTS</p>
      </div>
      <div class="postsBody">

    <?php
      include "showPost.php";
     ?>

     <?php


      ?>

     </div>
   </div>
  </body>
</html>
