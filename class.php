<?php

class Post {

    public $date;
    public $shortDesc;

    function setDate($date) {
        $newDate = date("d-m-Y", strtotime($date));
        $this->date = $newDate;
        return $this->date;
    }

    function setShortDesc($shortDesc) {
        $shortDescNew = "«".$shortDesc."»";
        $this->shortDesc = $shortDescNew;
        return $this->shortDesc;
    }

}

class removePost {

    public $id;

      public function removePost($id = null) {
        include 'includes/dbh.inc.php';
        $sql = "DELETE FROM posts WHERE id=?";
        $stmtee = $conn->prepare($sql);
        $stmtee->bind_param("i", $id);
        $stmtee->execute();
      }

     public function removeCategories($id = null) {
        include 'includes/dbh.inc.php';
        $sql1 = "DELETE FROM postscategories WHERE post=?";
        $stmte = $conn->prepare($sql1);
        $stmte->bind_param("s", $id);
        $stmte->execute();
        header("Location: https://mikhailkostblog.cf/admin/posts?removed=yes");
        exit;
      }


}

class editPost {

    public $id;
    public $body;
    public $title;
    public $date;
    public $shortDesc;
    public $categories;


    function checkBody($body) {
        if (strlen($body) > 1000) {
          header("Location: https://mikhailkostblog.cf/admin/posts?body=bad");
          exit;
        }
    }

    function checkTitle($title) {
        if (strlen($title) > 50) {
          header("Location: https://mikhailkostblog.cf/admin/posts?title=bad");
          exit;
        }
    }

    function checkShortDesc($shortDesc) {
        if (strlen($shortDesc) > 100) {
          header("Location: https://mikhailkostblog.cf/admin/posts?shortDesc=bad");
          exit;
        }
    }

    function setDate($date) {
      $newDate = date("Y-m-d", strtotime($date));
      $this->date = $newDate;
      return $this->date;
    }

    function enterData($id, $body, $title, $date, $shortDesc) {
      include 'includes/dbh.inc.php';
      $sqlqd = "UPDATE posts SET title = ?, dates = ?, body = ?, shortdescription = ? WHERE id = ?;";
      $stmtss= $conn->prepare($sqlqd);
      $stmtss->bind_param("ssssi", $title, $date, $body, $shortDesc, $id);
      $stmtss->execute();
    }

    function enterCategories($categories, $id) {
      include 'includes/dbh.inc.php';
      if(isset($categories))
            {
              $sql1 = "DELETE FROM postscategories WHERE post=?";
              $stmte = $conn->prepare($sql1);
              $stmte->bind_param("i", $id);
              $stmte->execute();
                foreach ($categories as $category) {
                  $sqlq = "INSERT INTO postscategories (post, category) VALUES (?, ?)";
                  $stmted = $conn->prepare($sqlq);
                  $stmted->bind_param("ss", $id, $category);
                  $stmted->execute();
    }
  }
  header("Location: https://mikhailkostblog.cf/admin/posts?changed=yes");
  exit;
}
}

class changeCategory {

  public $category;
  public $categories;

  function addCategory($category) {
    include 'includes/dbh.inc.php';
    if (strlen($category)>50) {
      header("Location: https://mikhailkostblog.cf/admin/categories?category=bad");
      exit;
    } else {
      $sql = "INSERT INTO categories (category) VALUES (?)";
      $stmte = $conn->prepare($sql);
      $stmte->bind_param("s", $category);
      $stmte->execute();
      header("Location: https://mikhailkostblog.cf/admin/categories?added=yes");
      exit;
    }
  }

  function removeCategory($categories) {
    include 'includes/dbh.inc.php';
    if(isset($categories))
          {
            foreach ($categories as $category) {
            $sql1 = "DELETE FROM categories WHERE category=?";
            $stmte = $conn->prepare($sql1);
            $stmte->bind_param("s", $category);
            $stmte->execute();

            $sql12 = "DELETE FROM postscategories WHERE category=?";
            $stmtee = $conn->prepare($sql12);
            $stmtee->bind_param("s", $category);
            $stmtee->execute();
          }
          header("Location: https://mikhailkostblog.cf/admin/categories?removed=yes");
          exit;
    } else {
      header("Location: https://mikhailkostblog.cf/admin/categories?removed=no");
      exit;
    }

  }

}

class createPost {

  public $id;
  public $body;
  public $title;
  public $date;
  public $shortDesc;
  public $categories;

  function checkData($body,$title,$shortDesc) {
    if (strlen($title) > 50) {
      header("Location: https://mikhailkostblog.cf/admin?title=bad");
      exit;
    } elseif (strlen($body) > 1000) {
      header("Location: https://mikhailkostblog.cf/admin?body=bad");
      exit;
    } elseif (strlen($shortDesc) > 100) {
      header("Location: https://mikhailkostblog.cf/admin?shortdesc=bad");
      exit;
    }
  }

  function enterData($body,$title,$shortDesc,$date) {

    include 'includes/dbh.inc.php';
    $sql = "INSERT INTO posts (body, title, shortdescription, dates) VALUES (?, ?, ?, ?)";
    $stmte = $conn->prepare($sql);
    $stmte->bind_param("ssss", $body, $title, $shortDesc, $date);
    $stmte->execute();

  }

  function enterCategories($categories,$last_id) {
    include 'includes/dbh.inc.php';
    if(isset($categories))
          {
              foreach ($categories as $category) {
                $sqlq = "INSERT INTO postscategories (post, category) VALUES (?, ?)";
                $stmted = $conn->prepare($sqlq);
                $stmted->bind_param("ss", $last_id, $category);
                $stmted->execute();
              }
          }

    header("Location: https://mikhailkostblog.cf/admin?added=yes");
  }


}

?>
