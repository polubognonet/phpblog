<?php

session_start();
include '../../includes/dbh.inc.php';

if (isset($_POST['createbutton'])) {

  $category = $_POST['createCategoryName'];

  require "../../class.php";
  $categoryClass = new changeCategory();
  $categoryClass->addCategory($category);

} elseif (isset($_POST['removebutton'])) {

  $categories = $_POST['category'];

  require "../../class.php";
  $categoryClass = new changeCategory();
  $categoryClass->removeCategory($categories);

}




 ?>
