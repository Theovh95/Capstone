<?php
include 'call.inc.php';
require 'connect.inc.php';

$user_id = $_GET['UID'];
$user_name = $_GET['UN'];
$start_date = getuserfield('start_date');

echo 'the user id is: '.$user_id;

echo "
  <form action=\"delete_account.php?UID=$user_id\" method=\"post\">
    <h2>Are you sure you want to delete this account?</h2><br>
    <input type=\"submit\" name=\"choice\" value=\"Yes\">
    <input type=\"submit\" name=\"choice\" value=\"No\"><br><br>

    <img src=get.php?id=$user_id height=300 width=300><br>
    
    User name: ".$user_name."<br>
    Start date: ".$start_date."<br><br>    
              
  </form>"
?>