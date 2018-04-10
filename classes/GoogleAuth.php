<?php


class GoogleAuth
{
  
  protected $db;
  protected $client;
  
  public function __construct(DB $db = null, Google_Client $googleClient = null)
  {
    $this->db = $db;
    $this->client = $googleClient;
 
    if($this->client){
      
      $this->client->setClientId('5954590334-cm9msujd6aalbq00vivhhniea7pg2u2u.apps.googleusercontent.com');
      $this->client->setApplicationName('capstone_project');
      $this->client->setClientSecret('66izq-vo2PF2styhT7_cR7Fd');
      $this->client->setRedirectUri('http://localhost:9090/Capstone_Project/php_script9.php');
      $this->client->setScopes('email');
    }
  }
  
  public function isLoggedIn()
  {
    return isset($_SESSION['access_token']);
  }
  
  public function getAuthUrl() {
    return $this->client->createAuthUrl();
  }
  
  public function checkRedirectCode()
  {

    if(isset($_GET['code'])) {
      $this->client->authenticate($_GET['code']);
            
      $this->setToken($this->client->getAccessToken());
      
      $this->storeUser($this->getPayload());
      
      return true;
    }
    return false;
  }
  
  public function setToken($token){
    $_SESSION['access_token'] = $token;
    
    $this->client->setAccessToken($token);
  }
  
  public function logout()
  {
    unset($_SESSION['access_token']);
    
  }
  
  public function getPayload()
  {
    $payload = $this->client->verifyIdToken();
    
    return $payload;
  }
  
  protected function storeUser($payload) 
  {
  $time = time();
  date_default_timezone_set('America/Chicago');
  $actual_time = date('m/d/Y h:i:s a', $time);
  
    $query2 = "SELECT user_id FROM user_tbl WHERE google_id = '".$payload['sub']."'";
    if($query_run2 = mysqli_query($query2)){
      if (mysqli_num_rows($query_run2)>=1){
        
        // this user exists so it should already have a default picture with their user_id
        //get user_id and set it in a session
        $query5 = "SELECT user_id, username FROM user_tbl WHERE google_id = '".$payload['sub']."'";
        $query_run5 = mysql_query($query5);
        $user_id = mysql_result($query_run5, 0, 'user_id');
        $user_name = mysql_result($query_run5, 0, 'username');
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $user_name;
        
        
      } else {
 
          // use OOP to insert new user but since duplicates are not allowed it will
          // not allow more than one.
          $sql = "
          INSERT INTO user_tbl (google_id, email, start_date)
          VALUES ({$payload['sub']}, '{$payload['email']}', '{$actual_time}') 
          ";
          $this->db->query($sql);
      

          //get user_id from previous insert
          $query5 = "SELECT user_id FROM user_tbl WHERE google_id = '".$payload['sub']."'";
          $query_run5 = mysql_query($query5);
          $user_id = mysql_result($query_run5, 0, 'user_id');
          $_SESSION['user_id'] = $user_id;
              
              
          //inserting default picture into user table    
          $query7 = "SELECT picture_name FROM picture_tbl WHERE picture_id = 1";
          $query_run7 = mysql_query($query7);
          if($default_picture_name = mysql_result($query_run7, 0, 'picture_name')){

        }else{
          echo 'query 7 failed';
          die(mysql_error());

        }
        
        // get the default picture
        $query9 = "SELECT picture FROM picture_tbl WHERE picture_id = 1";
        $query_run9 = mysql_query($query9);
        if($default_picture = mysql_result($query_run9, 0, 'picture')){
        $image = $default_picture;

        }else{
          echo 'query 9 failed';
          die(mysql_error());
        }

        // insert default picture into picture table
        $query8 = "INSERT INTO picture_tbl VALUES ('','$user_id','$default_picture_name','".mysql_escape_string($image)."','')";
        if($query_run8 = mysql_query($query8)){
          

        }else{
          
          echo 'query 8 failed<br>';
          echo 'user id is: '.$user_id.'<br><br>';
          echo "<img src=get.php?id=\"1\" height=75 width=75>";
          echo 'default picture name is: '.$default_picture_name.'<br><br>';
          echo 'picture is equal to: '.$default_picture.'<br><br>';
          
          die(mysql_error());
        }
        
        
      }
    }
  
   
  }
  
  
}
?>
