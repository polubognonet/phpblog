<?php

session_start();
include '../includes/dbh.inc.php';

if (isset($_POST['createpostbtn'])) {

  $title = $_POST['posttitle'];
  $body = $_POST['postbody'];
  $shortdesc = $_POST['postshortdesc'];
  $categories = $_POST['category'];

  require "../class.php";
  $post = new createPost();
  $post->checkData($body,$title,$shortdesc);

  $currentdate = date('Y-m-d H:i:s');

  $post->enterData($body,$title,$shortdesc,$currentdate);

  $newarray = array();

  $sql_ud = "SELECT * FROM posts";
  $resultd = $conn->query($sql_ud);
  if ($resultd->num_rows > 0) {
    while($rowd = $resultd->fetch_assoc()) {
      $id = $rowd['id'];
      array_push($newarray, $id);
    }
  }

  $largest = max($newarray);
  $last_id = $largest;

  $post->enterCategories($categories,$last_id);
  
  }





 ?>
