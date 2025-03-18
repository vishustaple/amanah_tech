<?php
session_start();
require_once(dirname(__FILE__) .'/core/config.php');
require_once(dirname(__FILE__) .'/core/functions.php');
require_once(dirname(__FILE__) .'/core/classes.php');
require_once(dirname(__FILE__) .'/core/Savant3.php');

$client = new uber_api_client($_API_USER,$_API_PASS);

if(isSerializedArray($_SESSION["orders"])){ //If the session is an array
	$plans=unserialize($_SESSION["orders"]);
}
$orderID=$plans[$_REQUEST['forder']];
//Order ID does not have to be valid

$getCoupon = $client->call($_UBER_API_URL,'order.coupon_get',array(
	'coupon_code' => $_REQUEST["coupon"]
));

if( ($getCoupon["coupon"]["max_uses"] <= $getCoupon["coupon"]["total_uses"] && $getCoupon["coupon"]["max_uses"]!='0') ||
	($_REQUEST["plan"] != $getCoupon["coupon"]["plan_id"] && $getCoupon["coupon"]["plan_id"])!='0' ||
	($getCoupon["coupon"]["expire"] != 0 && $getCoupon["coupon"]["expire"] < time()) ||
	$getCoupon["coupon"]["active"]="0")
{
	$return["valid"]=false;
}
else
{
	$return["valid"]=true;
}

if(is_numeric($orderID)){
	$order = $client->call($_UBER_API_URL,'order.get',array(
		'order_id' => $orderID,
		)
	);
}

$return["ammt"]=$getCoupon["coupon"]["discount_value"];
$return["type"]=$getCoupon["coupon"]["dollar"];
$return["total"]=$order["total"];
$return["subtotal"]=$getCoupon["coupon"]["subtotal"];

echo json_encode($return);