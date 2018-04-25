<?php

include 'core/init.php';
include 'core/other_init.php';


$db = new DB;
$googleClient = new Google_Client;
$auth = new GoogleAuth($db, $googleClient);


if($auth->checkRedirectCode()){
  
  $payload = $auth->getPayload();
    $query = "SELECT user_id FROM user_tbl WHERE google_id='".$payload['sub']."' AND email='".$payload['email']."'";
      if ($query_run = mysqli_query($db, $query)) {
       $query_num_rows = mysqli_num_rows($query_run);
       
      if ($query_num_rows==1){
        while($row = mysqli_fetch_assoc($query_run)){
          $user_id = $row['user_id'];
          if(isset($payload['email'])){
            $email = $payload['email'];
          } else {
            $email = $row['email'];
          }
        }

         $_SESSION['user_id']=$user_id;
         $_SESSION['username']=$email;
         
         header('Location: index.php'); // sends user to home page after logging in
       } else {
        $auth->storeUser($payload);
      }
      }else {
        echo "query did not run";
      }
  
  header('Location: index.php');

}

?>