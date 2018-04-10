<?php
  include 'call.inc.php';
  require 'connect.inc.php';


  $user_id = $_GET['UID'];
  $choice = $_POST['choice'];

  echo 'The choice is '.$choice;

  if($choice == "Yes"){
    $query  = "DELETE FROM video_tbl WHERE user_id=$user_id";
    $query3 = "DELETE FROM ip_address_tbl WHERE user_id=$user_id";
    $query4 = "DELETE FROM picture_tbl WHERE user_id=$user_id";
    $query2 = "DELETE FROM user_tbl WHERE user_id=$user_id";
    
    $query_run = mysql_query($query); 
    $query_run4 = mysql_query($query4); 
    $query_run3 = mysql_query($query3); 
    $query_run2 = mysql_query($query2); 
    header('Location: log_out.php'); // sends user to logout then to the index page after saying yes to deleting a video

  
  }else{
    header('Location: account.php'); // sends user to account page after saying no to deleting a video

    
  }
  
  
  



?>