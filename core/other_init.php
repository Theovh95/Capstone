<?php

require_once 'vendor/autoload.php';
require_once 'classes/DB.php';
require_once 'classes/GoogleAuth.php';


$googleClient = new Google_Client;
$db = new DB;
$auth = new GoogleAuth($db, $googleClient);




?>