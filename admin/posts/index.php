<?php

session_start();
include '../../includes/dbh.inc.php';
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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
  </head>
  <body>
    <?php

    if ($_GET['body'] == "bad") {
      echo '<script>alert("Body cannot be longer than 1000 charachters.")</script>';
    } elseif ($_GET['title'] == "bad") {
      echo '<script>alert("Title cannot be longer than 50 charachters.")</script>';
    } elseif ($_GET['shortDesc'] == "bad") {
      echo '<script>alert("Short description cannot be longer than 100 charachters.")</script>';
    } elseif ($_GET['changed'] == "yes") {
      echo '<script>alert("Changed properly.")</script>';
    } elseif ($_GET['removed'] == "yes") {
      echo '<script>alert("Removed properly.")</script>';
    }

     ?>
    <?php include "../header.php"; ?>
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
        <div class="currentposts">
        <?php
        $sql_ud = "SELECT * FROM posts";
          $resultd = $conn->query($sql_ud);
          if ($resultd->num_rows > 0) {
            foreach ($resultd as $resultkeyd) {
              $id = $resultkeyd['id'];
              $title = $resultkeyd['title'];
              $body = $resultkeyd['body'];
              $date = $resultkeyd['dates'];
              $shortDesc = $resultkeyd['shortdescription'];

              ?>

              <form class="" action="editpost.inc.php" method="post">
              <div class="postId">
              <?php  echo "<p>".$id."</p>";
              echo "<input type = 'hidden' name = 'id' value = '".$id."'>";?>
              </div>

        <div class = 'postsEditWrap'>
          <div class = 'title_shortDesc'>
            <div class = 'title'>
              <p>Title:</p>
              <?php  echo "<textarea name='title'>".$title."</textarea>"; ?>
            </div>
            <div class = 'shortDesc'>
              <p>Short Description:</p>
            <?php  echo "<textarea name='shortDesc'>".$shortDesc."</textarea>";?>
            </div>
          </div>
          <div class = 'postBodyEdit'>
            <p>Body:</p>
          <?php   echo "<textarea name='bodyTA'>".$body."</textarea>";?>
          </div>
          </div>
          <div class = 'postsEditWrap2'>
            <div class="postDateEdit">
              <div class="postDateWrap">
            <p>Date Created:</p>
            <?php
            $newDate = date("Y-m-d", strtotime($date));
            echo "<input type='date' name='datecreated' value='".$newDate."' min='2022-01-01' max='2022-12-31'>";
            ?>
            </div>
            </div>
            <div class="postCategoriesEdit">
              <div class="currentCategories">
                <p>Current Categories:</p>
                <div class="currentCategoriesWrap">
                  <?php
                    $sql_ud = "SELECT * FROM postscategories WHERE post = '$id'";
                    $resultd = $conn->query($sql_ud);
                    if ($resultd->num_rows > 0) {
                      while($rowd = $resultd->fetch_assoc()) {
                        echo "<p>".$rowd['category']."</p>";
                      }
                    } else {
                      echo "<p>No categories entered</p>";
                    }
                   ?>
                </div>
              </div>
              <div class="newCategories">
                <p>Change Categories:</p>
                <?php
                $sql_ud = "SELECT * FROM categories";
                $resultd = $conn->query($sql_ud);
                if ($resultd->num_rows > 0) {
                $numrow = $resultd->num_rows;
                echo "<select name = 'category[]' size='3' multiple='multiple' >";
                  while($rowd = $resultd->fetch_assoc()) {
                    $category = $rowd['category'];
                    $lowercat = strtolower($category);
                    $uppercat = strtoupper($category);
                    echo "<option value = '$lowercat'>".$uppercat."</option>";
                  }
                 }
                 ?>
               </select>
              </div>
            </div>
          </div>
          <div class="postsEditWrap3">
            <div class="removeButton">
              <button class = 'postbtn' type='submit' name='removepost'>Remove Post</button>
            </div>
            <div class="editButton">
              <button class = 'postbtn' type='submit' name='editpost'>Edit Post</button>
            </div>
          </div>
            </form>
            <?php
            }
          }
         ?>
         </div>
      </div>
   </div>
  </body>
</html>
