<?php
include 'core/init.php';
$ip_address = $_SERVER['REMOTE_ADDR'];

if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
}else{
  $user_id = $ip_address;
}

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