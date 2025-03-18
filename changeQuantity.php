<?php
session_start();
error_reporting(0);
require_once(dirname(__FILE__) .'/core/config.php');
require_once(dirname(__FILE__) .'/core/functions.php');
require_once(dirname(__FILE__) .'/core/classes.php');
require_once(dirname(__FILE__) .'/core/Savant3.php');

$client = new uber_api_client($_API_USER,$_API_PASS);

//Start the template engine
$tpl = new Savant3();
if(isSerializedArray($_SESSION["orders"])){ //If the session is an array
	$plans=unserialize($_SESSION["orders"]);
}

//Create an order if none exists
if($_REQUEST["forder"]==""){
	$update = $client->call($_UBER_API_URL,'order.create',array(
		'order_id' => $orderID,
		'info' => array(
			'pack1' => array(
				'quantity' => $_REQUEST["quantity"]
			)
		)
	));
}

if($_REQUEST["forder"]!=""){	
	$orderID=$plans[$_REQUEST['forder']];

	$update = $client->call($_UBER_API_URL,'order.update',array(
		'order_id' => $orderID,
		'info' => array(
			'pack1' => array(
				'quantity' => $_REQUEST["quantity"]
			)
		)
	));
	
	$order = $client->call($_UBER_API_URL,'order.get',array(
		'order_id' => $orderID,
		)
	);

	$plan = $client->call($_UBER_API_URL,'uber.service_plan_get',array(
		'plan_id' => $order["info"]["pack1"]["plan_id"] ,
	)); 

	$priceData = new PriceData($plan,$order);
	$priceJSON = $priceData->toJSON();
	echo $priceJSON;
}