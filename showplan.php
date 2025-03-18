<?php
ob_start(); 
session_start();
error_reporting(0);
require_once(dirname(__FILE__) .'/core/config.php');
require_once(dirname(__FILE__) .'/core/functions.php');
require_once(dirname(__FILE__) .'/core/classes.php');
require_once(dirname(__FILE__) .'/core/Savant3.php');

$client = new uber_api_client($_API_USER,$_API_PASS);

$orderInfo = $client->call($_UBER_API_URL,'order.get',array(
	'order_id' => $_GET["id"],
	)
); 
print_r($orderInfo);