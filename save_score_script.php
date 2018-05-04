<?php

include 'core/init.php';

if(isset($_SESSION['user_id'])){
  if(isset($_POST['score'])){

    $user_id = $_SESSION['user_id'];
    $score = $_POST['score'];

    $sql = "INSERT INTO score_tbl VALUES ('', $user_id, $score)";
    if($query_run = mysqli_query($con, $sql)){
      echo "success";
      header('location: add_score.php');

    }else {
      echo "error adding score to score table";
    }





  }else {
    echo 'score was not set?';
  }
} else {
  echo "you are not logged in";
}

