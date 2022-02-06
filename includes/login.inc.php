<?php
  session_start();
  include 'dbh.inc.php';
  if (isset($_POST['loginbutton'])) {

  $userinput = $_POST['login'];
  $password = $_POST['password'];

    $sql_ud = "SELECT * FROM admincreds WHERE username = '{$userinput}'";
      $resultd = $conn->query($sql_ud);
      if ($resultd->num_rows > 0) {
        while($rowd = $resultd->fetch_assoc()) {

          $hashed_password = $rowd['password'];

          if (password_verify($password, $hashed_password)) {

            $_SESSION['username'] = $userinput;

            header("Location: https://mikhailkostblog.cf/admin/");
            exit;
          } else {
            header("Location: https://mikhailkostblog.cf?ucomb=bad");
            exit;
          }
          }
        } else {
          header("Location: https://mikhailkostblog.cf?ucomb=bad");
          exit;
        }
      }


 ?>
