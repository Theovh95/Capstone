<?php

ob_start();
session_start();
$current_file = $_SERVER['SCRIPT_FILENAME'];
$current_file2 = $_SERVER['SCRIPT_NAME'];
if (isset($_SERVER['HTTP_REFERER'])) {
$http_referer = $_SERVER['HTTP_REFERER'];
}


function loggedin() {
  if (isset($_SESSION['user_id'])&&!empty($_SESSION['user_id'])) {
    return true;
  } else{
    return false;
  }
}

function getuserfield($field) {
  $query = "SELECT $field FROM user_tbl WHERE user_id = '".$_SESSION['user_id']."'";
  if ($query_run = mysqli_query($con, $query)) {
    if ($query_result = mysqli_fetch_row($query_run)) {
      if ($result = $query_result[$field])
      return $result;
    }
  }
}




?>