<?php
  echo '
    <header>
      <h1>
      
        <img src="images/Title.png" alt="CoolName" width="644" height="176">
      
      </h1>

      <div id="login_toggle_div">
        <span>
          <a href="#" onclick="toggle_login(); return false">
            login
            <img id="login_carrot" src="images/up_carrot3.png" height="24" width="24">
          </a>
        </span>

      <div id="login_div" style="display: none;">
      ';
      if($auth->isLoggedIn() || loggedin()): 
      echo '
          <a href="log_out.php"><img src="images/signout.png" height="33px" width="180px"></a>
          ';
        else: 
        echo '
          <a href="'.$auth->getAuthUrl().'"><img src="images/google_signin.png"></a><hr>
          <a href = "login.php"><img src="images/login.png" width="180px" height="33px"></a><hr>
          <a href = "create_account.php"><img src="images/createaccount.png" width="180px" height="33px"></a>
        ';
        endif; 
        echo '     
     </div>
        
      </div>



    </header><br><br>
  ';

?>