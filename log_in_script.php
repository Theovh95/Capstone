<?php
include 'core/func/call.inc.php';
include 'core/db/connect.inc.php';

if (isset($_POST['email'])&&isset($_POST['password'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  $password_hash = md5($password);
  
  if (!empty($email)&&!empty($password)) {
    
    $query = "SELECT user_id FROM user_tbl WHERE email='".mysqli_real_escape_string($con, $email)."' AND password =  '".mysqli_real_escape_string($con, $password_hash)."'";
      if ($query_run = mysqli_query($con, $query)) {
       $query_num_rows = mysqli_num_rows($query_run);
       
       if ($query_num_rows==0) {
         echo 'Invalid username/password combination.';
       }else if ($query_num_rows==1){

        $query2 = "SELECT * FROM user_tbl WHERE email='".mysqli_real_escape_string($con, $email)."' AND password =  '".mysqli_real_escape_string($con, $password_hash)."'";
        if ($query_run2 = mysqli_query($con, $query2)){
          while($row = mysqli_fetch_assoc($query_run2)){
            $user_id = $row['user_id'];
            $picture = $row['picture'];
          }
  
           $_SESSION['user_id'] = $user_id;
           $_SESSION['username'] = $_POST['email'];
           $_SESSION['picture'] = $picture;
           
           header('Location: index.php'); // sends user to home page after logging in

        } else {
          die("problem getting user data from the database");
        }

       }
      }else {
        die('query did not run');
        
      }
    
    
  }else {
    echo 'you must supply a username and password.';
  }
} else {
  echo 'problems';
}
?>
