<?php 
session_start();
require_once(dirname(__FILE__) .'/core/config.php');
require_once(dirname(__FILE__) .'/core/functions.php');
require_once(dirname(__FILE__) .'/core/classes.php');
require_once(dirname(__FILE__) .'/core/Savant3.php');

$client = new uber_api_client($_API_USER,$_API_PASS);

//Start the template engine
$tpl = new Savant3();
if($_POST["forder"]!="")
{	
	//Get the order IDs
	if(isSerializedArray($_SESSION["orders"]))
	{
		$plans=unserialize($_SESSION["orders"]);
	}
	if(isset($plans[$_POST['forder']]))
	{

		//Assign the stored CC id to the order
		$submit = $client->call($_UBER_API_URL,'order.submit',array(
			'order_id' => $plans[$_POST['forder']] ,
		));
		
		// Get order info
		$getOrder = $client->call($_UBER_API_URL,'order.get',array(
			'order_id' => $plans[$_POST['forder']] ,
		)); print_r($getOrder); die();
		
		//If payment if via PayPal, get some info to display to the user
		if($getOrder["info"]["payment_type"] == 'paypal')
		{
			$delStart=strpos($submit,'<p>');
			$delEnd=strpos($submit,'<input type="submit"');

			$tpl->button=substr($submit,0,$delStart) . substr($submit,$delEnd);
			
			//Replace the return addresses from the default. 
			$tpl->total=$getOrder["total"];
			$tpl->paypal=true;
		}
		$tpl->orderID=$getOrder["order_id"];
		$tpl->display('tpl/' . $_TEMPLATE . '/submit.tpl.php');
	}
} 