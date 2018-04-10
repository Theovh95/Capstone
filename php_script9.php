<?php

include 'core/init.php';
include 'core/other_init.php';


$db = new DB;
$googleClient = new Google_Client;
$auth = new GoogleAuth($db, $googleClient);


if($auth->checkRedirectCode()){
  
  $payload = $auth->getPayload();
    $query = "SELECT user_id FROM user_tbl WHERE google_id='".$payload['sub']."' AND email='".$payload['email']."'";
      if ($query_run = mysql_query($query)) {
       $query_num_rows = mysql_num_rows($query_run);
       
      if ($query_num_rows==1){
         $user_id = mysql_result($query_run, 0, 'user_id');
         $_SESSION['user_id']=$user_id;
         $_SESSION['username']=$payload['email'];
         
         header('Location: index.php'); // sends user to home page after logging in
       }
      }
  
  header('Location: index.php');

}

?>