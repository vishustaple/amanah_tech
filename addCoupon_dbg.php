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
	$didCopuonFail = false;
	$orderID=$plans[$_REQUEST['forder']];
	if(isset($orderID)){
		$requestArr = array(
			'order_id' => $plans[$_REQUEST['forder']] ,
			'info' => array(
				'pack1' => array(
				),
			),
		);

		if(isset($_REQUEST["coupon"])) {
			$requestArr["info"]["coupon"] = $_REQUEST["coupon"];
			$requestArr["info"]["pack1"]["coupon"] = $_REQUEST["coupon"];
		}
		else if(isset($_REQUEST["period"]) && is_numeric($_REQUEST["period"])) {
			$requestArr["info"]["pack1"]["period"] = $_REQUEST["coupon"];
		}

		$modifyOrder = $client->call($_UBER_API_URL,'order.update',$requestArr);

		//Check for a coupon failure
		if(isset($_REQUEST["coupon"]) && !isset($order["info"]["pack1"]["coupon_id"])){
			$didCopuonFail = true;
		}
	}
	
	$order = $client->call($_UBER_API_URL,'order.get',array(
		'order_id' => $orderID,
		)
	);
	$plan = $client->call($_UBER_API_URL,'uber.service_plan_get',array(
		'plan_id' => $order["info"]["pack1"]["plan_id"],
		)
	);

	//If the coupon failed to apply report back, otherwise report the new pricing data
	if($didCopuonFail) {
		echo json_encode("false");
	} else {
		$newPriceModel = new PriceData($plan,$order);
		echo $newPriceModel->toJSON();
	}
	
}