<?php

require "class.php";

$sql_u = "SELECT * FROM posts";
$result = $conn->query($sql_u);
if ($result->num_rows > 0) {
  foreach ($result as $resultkey) {
      echo "<div class = 'actualPost'>";
      $id = $resultkey['id'];
      $title = $resultkey['title'];
      $body = $resultkey['body'];
      $date = $resultkey['dates'];
      $shortDescription = $resultkey['shortdescription'];

      $post = new Post();
      $newDate = $post->setDate($date);
      $newShortDesc = $post->setShortDesc($shortDescription);

      echo "<div class = 'postTitle'>";
      echo "<p>".$title."</p>";
      echo "</div>";
      echo "<div class = 'postShortDesc'>";
      echo "<p><i>".$newShortDesc."</i></p>";
      echo "</div>";
      echo "<div class = 'postBody'>";
      echo "<p>".$body."</p>";
      echo "</div>";
      echo "<div class = 'postInfo'>";
      echo "<div class = 'postDate'>";
      echo "<p>".$newDate."</p>";
      echo "</div>";
      echo "<div class = 'postDate'>";
      $sql_ud = "SELECT * FROM postscategories WHERE post = '$id'";
      $resultd = $conn->query($sql_ud);
      if ($resultd->num_rows > 0) {
        while($rowd = $resultd->fetch_assoc()) {
          echo "<p>".$rowd['category'].",&nbsp;</p>";
        }
      }
      echo "</div>";
      echo "</div>";
      echo "</div>";
}
}


 ?>
