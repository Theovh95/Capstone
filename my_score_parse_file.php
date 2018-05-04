<?php
include 'core/init.php';

$user_id = $_SESSION['user_id'];
$score = $_POST['score'];

if (isset($_POST['score'])){
  if (add_score($con, $user_id, $score)){
    output_leaderboard($con, 10);
  } else {
    echo "problem adding score";
  }


}else{
  echo 'no_success';
}  
  



?>