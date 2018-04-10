<?php       


       if (loggedin() || $auth->isLoggedIn()) {
            include 'footer_nav.php';
          }else {
            include 'footer_nav_logged_out.php';
          }
          
?>