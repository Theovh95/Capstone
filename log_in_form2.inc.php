<?php
// creates an account for the user and sets their email and user_id in sessions.
  include 'core/init.php';
  
  $ip_address = $_SERVER['REMOTE_ADDR'];

  
  $time = time();

  date_default_timezone_set('America/Chicago');
  $actual_time = date('m/d/Y h:i:s a', $time);

  
  if (!loggedin()) {
    if(isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['password_again'])) {
    
      $email=$_POST['email'];
      $password=md5($_POST['password']);
      $password_again = md5($_POST['password_again']);
      
      //set session variables
      $_SESSION['user_time'] = time();
           
      if (!empty($password)&&!empty($password_again)&&!empty($email)){
            if ($password!=$password_again){
              echo 'your passwords do not match';
            }else{
            
              $query = "SELECT email FROM user_tbl WHERE email = '".mysqli_real_escape_string($con, $email)."'";
              $query_run = mysqli_query($con, $query);
              
              if (mysqli_num_rows($query_run)==1) {
                die('the email '.$email.' already exists.');
              }else{
                  
                    $google_id = !empty($google_id) ? "'$google_id'" : "NULL";
                    $query = "INSERT INTO user_tbl VALUES ('','".mysqli_real_escape_string($con, $email)."', '".mysqli_real_escape_string($con, $password)."', $google_id, 'http://www.mattsarg.com/images/profile_photo_blank.jpg')";
                    if($query_run = mysqli_query($con, $query)){
                                   
                    //get user id 
                    $query5 = "SELECT user_id FROM user_tbl WHERE email = '".mysqli_real_escape_string($con, $email)."'";
                    $query_run5 = mysqli_query($con, $query5);

                    while($row = mysqli_fetch_assoc($query_run5)){
                      $user_id = $row['user_id'];
                      $picture = $row['picture'];
                    }

                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['picture'] = $picture;     
                    $_SESSION['username'] = $email;
                    header('Location: index.php'); // sends user to home page after logging in
                    } else {
                        echo 'query did not run';
                      }
              }
            }
      }
    }
  }
?>

