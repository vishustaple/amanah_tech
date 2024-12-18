<?php
session_start();
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
if($_REQUEST["forder"]!="")
{	
	$orderID=$plans[$_REQUEST['forder']];
	if(isset($orderID))
	{
		$assignCoupon = $client->call($_UBER_API_URL,'order.update',array(
			'order_id' => $plans[$_REQUEST['forder']] ,
			'info' => array(
				'coupon' => $_REQUEST["coupon"],
				'pack1' => array(
					'coupon' => $_REQUEST["coupon"],
				),
			),
		));
	}
	
	$order = $client->call($_UBER_API_URL,'order.get',array(
		'order_id' => $orderID,
		)
	);
	
	echo json_encode(array(
		"main" => (isset($order["info"]["coupon_credits"]) || isset($order["info"]["pack1"]["discount"])),
		"ammt"=>(isset($order["info"]["coupon_credits"]) ? $order["info"]["coupon_credits"][$_REQUEST["coupon"]] : $order["info"]["pack1"]["discount"]),
		"type"=>(isset($order["info"]["coupon_credits"]) ? 1 : $order["info"]["pack1"]["discount_type"]),
		"setup" => isset($order["info"]["pack1"]["setup_discount"]),
		"setup_ammt"=>$order["info"]["pack1"]["setup_discount"],
		"setup_type"=>$order["info"]["pack1"]["setup_discount_type"],
		"total"=>$order["total"],
		"valid"=> isset($order["info"]["pack1"]["coupon_id"]),
		"subtotal"=>$order["info"]["pack1"]["cost"],
		"onetime" =>isset($order["info"]["coupon_credits"]),
		"prorate" => $order["info"]["pack1"]["prorated_total"], 
		)
	);
	
}