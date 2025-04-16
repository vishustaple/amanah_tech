<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// session_start();
require_once(dirname(__FILE__) .'/core/config.php');
require_once(dirname(__FILE__) .'/core/functions.php');
require_once(dirname(__FILE__) .'/core/classes.php');
require_once(dirname(__FILE__) .'/core/Savant3.php');
error_reporting(E_PARSE);


$client = new uber_api_client($_API_USER,$_API_PASS);

setlocale(LC_MONETARY, 'en_US');

//Start the template engine
$tpl = new Savant3();
$order = null;
$coupon = null;



if($_GET["form"] != ""){
	$plan=$_FORMIDS[$_GET["form"]][2];
	$queue=$_FORMIDS[$_GET["form"]][1];
	$form=$_FORMIDS[$_GET["form"]][0];
}
elseif((!isset($_REQUEST["forder"]) || $_REQUEST["forder"]=='') && $_GET['form']=='' && !($_GET['pid'] && $_GET['q'] && $_GET['f']) ){
    $plan = $_FORMIDS['test'][2];
    $queue = $_FORMIDS['test'][1];
    $form = $_FORMIDS['test'][0];
}
else{
	$plan=$_GET["pid"];
	$queue=$_GET["q"];
	$form=$_GET["f"];
}

if(isset($_REQUEST["forder"]) && $_REQUEST['forder'] ){
	$order = $client->call($_UBER_API_URL,'order.get',array(
		'hash' => $_REQUEST["forder"],
		)
	);

	if(is_array($order["info"]["pack1"]["coupon"])){
		$coupon = $client->call($_UBER_API_URL,'order.coupon_get',array(
			'coupon_id' => $order["info"]["pack1"]["coupon"]["coupon_id"],
			)
		);
	}

	$plan=$order["info"]["pack1"]["plan_id"];
}

$result = $client->call($_UBER_API_URL,'uber.service_plan_get',
	[
	'plan_id' => (int)$plan ,
    ]);

$priceData = new PriceData($result,$order,$coupon);
$priceJSON = $priceData->toJSON();

//Set other template variables
$tpl->plan=$plan;
$tpl->queue=$queue;
$tpl->form=$form;
$tpl->priceJSON=$priceJSON;
$tpl->servicePlanData = $result;
$tpl->title = $result["title"];
$tpl->display('tpl/' . $_TEMPLATE . '/addplan-new-colo-tpl.php');   