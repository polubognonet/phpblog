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

    if ($_GET['category'] == "bad") {
      echo '<script>alert("Categories cannot be longer than 50 charachters.")</script>';
    } elseif ($_GET['added'] == "yes") {
      echo '<script>alert("Category added properly.")</script>';
    } elseif ($_GET['removed'] == "yes") {
      echo '<script>alert("Categories removed properly.")</script>';
    } elseif ($_GET['removed'] == "no") {
      echo '<script>alert("Categories were not chosen!")</script>';
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
        <div class="existingCategories">
          <?php
          $sql_ud = "SELECT * FROM categories";
          $resultd = $conn->query($sql_ud);
          if ($resultd->num_rows > 0) {
            echo "<div class = 'categoriesHeader'>";
            echo "<p>Your categories:</p>";
            echo "</div>";
            echo "<div class = 'categoriesMain'>";
            while($rowd = $resultd->fetch_assoc()) {

              echo "<p>".$rowd['category'].",&nbsp;</p>";

            }
            echo "</div>";
          } else {
            echo "<p>No categories created!</p>";
          }
           ?>
        </div>
        <div class="createCategory">
          <form action="changecategories.inc.php" style="text-align: center;" method="post">
            <p>Create Categories:</p>
            <input type="text" name="createCategoryName" placeholder="Category Name">
            <button class = 'categorybtn' type='submit' name='createbutton'>Create</button>
          </form>
        </div>
        <div class="removeCategory">
          <form action="changecategories.inc.php" style="text-align: center;" method="post">
            <p>Remove Categories:(hold CTRL for many)</p>
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
            <button class = 'categorybtn' type='submit' name='removebutton'>Remove</button>
          </form>
        </div>
      </div>
   </div>
  </body>
</html>
