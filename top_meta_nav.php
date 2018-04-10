<?php
include 'core/other_init.php';
  if(loggedin() || $auth->isLoggedIn()) {
    include 'nav_top.php';
  } else {
    include 'nav_top_logged_out.php';
  }

?>