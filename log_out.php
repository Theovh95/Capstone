<?php
require_once 'core/init.php';
include 'core/other_init.php';
$auth = new GoogleAuth();

$auth->logout();

session_start();
session_destroy();
header('Location: index.php');

?>