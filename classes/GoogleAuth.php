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
      
      $this->client->setClientId('5954590334-hegl0ej2i3f31dmtfeflut1940hbauko.apps.googleusercontent.com');
      $this->client->setApplicationName('Capstone');
      $this->client->setClientSecret('VXMF211nIrIwK88AmGtJgduZ');
      $this->client->setRedirectUri('http://localhost:9090/Capstone/php_script9.php');
      $this->client->setScopes('profile');
      $this->client->addScope('email');
      
    }
  }
  
  public function isLoggedIn(){
    return isset($_SESSION['access_token']);
  }
  
  public function getAuthUrl() {
    return $this->client->createAuthUrl();
  }
  
  public function checkRedirectCode() {
    if(isset($_GET['code'])) {
      $this->client->authenticate($_GET['code']);
            
      $this->setToken($this->client->getAccessToken());
/*
      echo "<pre>";
      die(var_dump($this->getPayload()));
      echo "</pre>";
*/

      $this->storeUser($this->getPayload());
      
      return true;
    }
    return false;
  }
  
  public function setToken($token) {
    $_SESSION['access_token'] = $token;
    
    $this->client->setAccessToken($token);
  }
  
  public function logout() {
    unset($_SESSION['access_token']);
  }
  
  public function getPayload() {
    $payload = $this->client->verifyIdToken();
    
    return $payload;
  }
  
  protected function storeUser($payload) {

    $mysqli = new mysqli('localhost', 'root', '', 'coolname');

    $time = time();
    date_default_timezone_set('America/Chicago');
    $actual_time = date('m/d/Y h:i:s a', $time);
    $google_id = $payload['sub'];
    $email = $payload['email'];
    $picture = $payload['picture'];

  
    $query2 = "SELECT user_id FROM user_tbl WHERE google_id = '".$payload['sub']."'";
    if($query_run2 = mysqli_query($mysqli, $query2)){
      if (mysqli_num_rows($query_run2)>=1){
        
        // this user exists so it should already have a default picture with their user_id
        //get user_id and set it in a session
        $query5 = "SELECT user_id, email, picture FROM user_tbl WHERE google_id = '".$payload['sub']."'";
        if($query_run5 = mysqli_query($mysqli, $query5)) {

        
        while($row = mysqli_fetch_assoc($query_run5)){
          $user_id = $row['user_id'];
          $user_name = $row['email'];
          $picture = $row['picture'];
        }
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $user_name;
        $_SESSION['picture'] = $picture;
      } else {
        echo "Whoooaaa.....";
      }
        
      } else {
 
          // use OOP to insert new user but since duplicates are not allowed it will
          // not allow more than one.
          $sql = "
          INSERT INTO user_tbl (user_id, email, password, google_id, picture)
          VALUES ('', '{$payload['email']}', '', {$payload['sub']}, '{$payload['picture']}') 
          ";
//          $this->db->query($sql);
          if(!mysqli_query($mysqli, $sql)){
            
            echo "<br><br>hey that was supposed to insert into the database.";
            die();
          }
      

          //get user_id from previous insert
          $query5 = "SELECT * FROM user_tbl WHERE google_id = '".$payload['sub']."'";
          if(!mysqli_query($mysqli, $query5)) {
            echo "why in the world did this not run?????";
            die();
          }

          $query_run5 = mysqli_query($mysqli, $query5);

          while($row = mysqli_fetch_assoc($query_run5)){
            $user_id = $row["user_id"];
            $user_name = $row["email"];
            $picture = $row["picture"];
          }

          $_SESSION['user_id'] = $user_id;
          $_SESSION['username'] = $user_name;
          $_SESSION['picture'] = $picture;
        }
      } else {
        echo 'what happened???';
        die();
      }
    } 
}
?>
