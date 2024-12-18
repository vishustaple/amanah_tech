<?php
ob_start(); 
session_start();
error_reporting(0);
require_once(dirname(__FILE__) .'/core/config.php');
require_once(dirname(__FILE__) .'/core/functions.php');
require_once(dirname(__FILE__) .'/core/classes.php');
require_once(dirname(__FILE__) .'/core/Savant3.php');

$client = new uber_api_client($_API_USER,$_API_PASS);
$coupon = null;

//Start the template engine
$tpl = new Savant3();

if(!isset($_REQUEST["forder"]) || $_REQUEST["forder"]==""){
	$options = array();
	foreach($_REQUEST as $key=>$val){
		if(preg_match('/pu([0-9]+)/',$key,$match) && is_numeric($val)){
			$options[$match[1]]=$val;
		}
	}

	$result = $client->call($_UBER_API_URL,'order.create',array(
	'order_queue_id' => $_REQUEST["q"] ? (int)$_REQUEST["q"] : 1  ,
	'order_form_id' => $_REQUEST["f"] ? (int)$_REQUEST["f"] : 1 ,
	'info' => array(
		'pack1' => array(
			'plan_id' => $_REQUEST["p"] ? (int)$_REQUEST["p"] : 2 ,
			'options' => $options ,
			'quantity' => 1,
			'setup_qs' => 1,
		)
	)
	));

	$orderID=$result["data"]["hash"];

} else {
	$orderID=$_REQUEST['forder'];
}


$period=$_REQUEST["period"];
//Update the option prices becuase Ubersmith no longer does this automatically 
//Get the plan ID from this order
$orderInfo = $client->call($_UBER_API_URL,'order.get',array(
	'hash' => $orderID,
	)
);


$planID=$orderInfo['info']['pack1']['plan_id'];

//Get the plan options
$svcPlan = $client->call($_UBER_API_URL,'uber.service_plan_get',array(
	'plan_id' => $planID ,
));

//Just apply the coupon and see if it sticks
$order = $client->call($_UBER_API_URL,'order.update',array(
	'hash' => $orderID,
	'info' => array(
		'coupon' => $_REQUEST["coupon"],
		'pack1' => array(
			'coupon' => $_REQUEST["coupon"],
		)
	)
));

//Get the order data with the coupon (this prevents irrelevant coupons from being applied)
$orderInfo = $client->call($_UBER_API_URL,'order.get',array(
	'hash' => $orderID,
	)
);

//Validate that the coupon works with this order
if(is_array($orderInfo["info"]["pack1"]["coupon"])){
	$coupon = $client->call($_UBER_API_URL,'order.coupon_get',array(
		'coupon_id' => $orderInfo["info"]["pack1"]["coupon"]["coupon_id"],
		)
	);
}
else {
	$coupon = null;
}

//fix period for PriceData
$orderInfo["info"]["pack1"]["period"] = $period;

$priceData = new PriceData($svcPlan,$orderInfo,$coupon);

//Update the prices to what the pricing model wants, this applies period discounts and fixed annoying ubersmith behavior around coupons
foreach($svcPlan["upgrades"] as $upgID=>$upg){
	//Sort out any discounts provided
	$newPrice[$upgID] = $priceData->upgrades[$orderInfo["info"]["pack1"]["option"][$upgID]]->price;
	$newSetup[$upgID] = $priceData->upgrades[$orderInfo["info"]["pack1"]["option"][$upgID]]->setup;
}

//Apply discounts to package prices

//Update the new prices in the order
$order = $client->call($_UBER_API_URL,'order.update',array(
	'hash' => $orderID,
	'info' => array(
		'coupon' => $_REQUEST["coupon"],
		'pack1' => array(
			'coupon' => $_REQUEST["coupon"],
			'period' => $period,
			'bill_type' => 0,
			'setup_fee' => $newSetup,
			'monthly_fee' => $newPrice, //Ubersmith makes all period fees monthly. If they ever deicde to fix this bug the below line should work
		    'quantity' => $_REQUEST["quantity"],
			'total_setup' => $priceData->packSetup * intval($_REQUEST["quantity"]),
                        'setup' => $priceData->packSetup,
                        'price' => $priceData->packRec,
                )
	)
));

//Now update the quantity
$order = $client->call($_UBER_API_URL,'order.update',array(
	'hash' => $orderID,
	'info' => array(
		'pack1' => array(
			'quantity' => $_REQUEST["quantity"],
			//($svcPlan["pricing"][$period]["api_label"] . '_fee') => $newPrice, 
		)
	)
));


if($_REQUEST["ajax"] == "yes"){
	$orderInfo = $client->call($_UBER_API_URL,'order.get',array(
		'hash' => $orderID,
		)
	); 

	$priceData = new PriceData($svcPlan,$orderInfo,$coupon);
	$priceData->coupon = $coupon;
	$priceJSON = $priceData->toJSON();
	echo $priceJSON;
} else {

	if($_REQUEST["regMethod"]=="login"){
		header("Location: login.php?forder=".$orderID);
	} else {
		header("Location: login.php?reg=1&forder=".$orderID);
	}
}
flush();