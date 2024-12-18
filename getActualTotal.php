<?php
session_start();
require_once(dirname(__FILE__) .'/core/config.php');
require_once(dirname(__FILE__) .'/core/functions.php');
require_once(dirname(__FILE__) .'/core/classes.php');
require_once(dirname(__FILE__) .'/core/Savant3.php');

$client = new uber_api_client($_API_USER,$_API_PASS);

setlocale(LC_MONETARY, 'en_US');

//Start the template engine
$tpl = new Savant3();
$tpl->session=$_SESSION;
if($_POST["s"]=="")
{
	if(isSerializedArray($_SESSION["orders"]))
	{ //If the session is an array
		$plans=unserialize($_SESSION["orders"]);
	}
	if($plans[$_REQUEST["forder"]]!="")
	{
		$orderID=$plans[$_REQUEST["forder"]];
		$order = $client->call($_UBER_API_URL,'order.get',array(
			'order_id' => $orderID,
			)
		);
		print_r($order);
		die();
		echo $order["info"]["pack1"]["prorated_total"];
	}
}