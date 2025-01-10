<?php
ob_start(); 
session_start();
error_reporting(0);
require_once(dirname(__FILE__) .'/core/config.php');
require_once(dirname(__FILE__) .'/core/functions.php');
require_once(dirname(__FILE__) .'/core/classes.php');

$client = new uber_api_client($_API_USER,$_API_PASS);

$forgotPass = $client->call($_UBER_API_URL,'uber.forgot_pass',array(
	'email' => $_REQUEST["email"] ,
));

echo json_encode(true); 