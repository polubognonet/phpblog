<?php

session_start();
include '../includes/dbh.inc.php';
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);


if (!isset($_SESSION['username'])) {
  header("Location: https://mikhailkostblog.cf/");
  exit;
}
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
  </head>
  <body>
    <?php include "header.php"; ?>
    <div class="wrapper">
      <div class="headerNavWrap">
      <div class="headerNav">
        <div class="createPost">
          <a href="https://mikhailkostblog.cf/admin/">Create Post</a>
        </div>
        <div class="createPost">
          <a href="https://mikhailkostblog.cf/admin/posts/">Edit Posts</a>
        </div>
        <div class="createPost">
          <a href="https://mikhailkostblog.cf/admin/categories/">Edit Categories</a>
        </div>
      </div>
      </div>
      <div class="mainBodyWrap">
        <form action="createpost.inc.php" method="post">
        <div class="createTitle">
          <div class="createHeader">
            <p>Title:</p>
          </div>
          <div class="createInput">
            <textarea name="posttitle"></textarea>
          </div>
        </div>
        <div class="createBody">
            <div class="createHeader">
              <p>Body:</p>
            </div>
            <div class="createInput">
              <textarea name="postbody"></textarea>
            </div>
        </div>
        <div class="createShortDesc">
            <div class="createHeader">
              <p>Short Description:</p>
            </div>
            <div class="createInput">
              <textarea name="postshortdesc"></textarea>
            </div>
        </div>
        <div class="chooseCategories">
            <div class="createHeader">
              <p>Choose Categories: </p>
              <p style="font-size:12px; color: grey;">(hold CTRL for many)</p>
            </div>
            <div class="createInput">

              <?php

              $sql_ud = "SELECT * FROM categories";
              $resultd = $conn->query($sql_ud);
              if ($resultd->num_rows > 0) {
              $numrow = $resultd->num_rows;
              echo "<select name = 'category[]' size=".$numrow." multiple='multiple' >";
                while($rowd = $resultd->fetch_assoc()) {
                  $category = $rowd['category'];
                  $lowercat = strtolower($category);
                  $uppercat = strtoupper($category);
                  echo "<option value = '$lowercat'>".$uppercat."</option>";
                }
               ?>
            </select>
          <?php } else {
            echo "<p>Create your first category <a href = 'https://mikhailkostblog.cf/admin/categories/' style = 'font-weight: 600;'> here </a></p>";
          } ?>
            </div>
        </div>
        <div class="postExceptions">
          <?php
          if ($_GET['title'] == "bad") {
            echo "<p style = 'color: red;'> Title cannot be longer than 50 characters. </p>";
          } elseif ($_GET['body'] == "bad") {
            echo "<p style = 'color: red;'> Body cannot be longer than 1000 characters. </p>";
          } elseif ($_GET['shortdesc'] == "bad") {
            echo "<p style = 'color: red;'> Short Description cannot be longer than 100 characters. </p>";
          } elseif ($_GET['added'] == "yes") {
            echo "<p style = 'color: green;'> Post added properly!</p>";
          }
           ?>
        </div>
        <div class="createPostSubmit">
            <button class = 'createpostbtn' type='submit' name='createpostbtn'>Create Post</button>
        </div>
        </form>
      </div>
   </div>
  </body>
</html>
