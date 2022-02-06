<?php

session_start();
include '../../includes/dbh.inc.php';

if (isset($_POST['removepost'])) {

  $id = $_POST['id'];

  require "../../class.php";
  $post = new removePost();
  $post->removePost($id);
  $post->removeCategories($id);

} elseif (isset($_POST['editpost'])) {

  $id = $_POST['id'];
  $body = $_POST['bodyTA'];
  $shortDesc = $_POST['shortDesc'];
  $title = $_POST['title'];
  $date = $_POST['datecreated'];
  $categories = $_POST['category'];

  require "../../class.php";
  $post = new editPost();
  $post->checkBody($body);
  $post->checkTitle($title);
  $post->checkShortDesc($shortDesc);
  $newDate = $post->setDate($date);
  $post->enterData($id, $body, $title, $newDate, $shortDesc);
  $post->enterCategories($categories, $id);

}

 ?>
