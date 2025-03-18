<?php 
session_start();
require_once(dirname(__FILE__) .'/core/config.php');
require_once(dirname(__FILE__) .'/core/functions.php');
require_once(dirname(__FILE__) .'/core/classes.php');
require_once(dirname(__FILE__) .'/core/Savant3.php');

$client = new uber_api_client($_API_USER,$_API_PASS);

//Start the template engine
$tpl = new Savant3();
if($_POST["m"]=="")
{
	//Get all the payment methods this client has stored
	$paymentMethods = $client->call($_UBER_API_URL,'client.payment_method_list',array(
		'client_id' => $_SESSION['client']['id'],
	));
	foreach($paymentMethods as $method)
	{
		$tpl->methods[$method["payment_type"]][]=array(
			'id'=>$method["billing_info_id"],
			'num'=>$method["cc_num"],
			'type'=>$method["cc_type"],
		);
	}
	$tpl->display('tpl/' . $_TEMPLATE . '/payment.tpl.php');
}
if($_POST["m"] == "achadd") // New bank account
{
	//Enter the credit card information in the system
	$newACH = $client->call($_UBER_API_URL,'client.ach_add',array(
		'user_login' => $_SESSION['client']['id'] ,
		'ach_acct' => $_POST["account_number"], 
		'ach_type' => $_POST["account_type"], 
		'ach_aba' => $_POST["bank_routing"], 
		'ach_bank' => $_POST["bank_name"], 
		'address' => $_POST["address"], 
		'fname' => $_POST["fname"], 
		'lname' => $_POST["lname"], 
		'company' => $_POST["company"], 
		'city' => $_POST["city"], 
		'state' => $_POST["state"], 
		'zip' => $_POST["zip"], 
		'country' => $_POST["country"], 
		'phone' => $_POST["phone"], 
		'email' => $_POST["email"], 
	));
	
	//Get the order IDs
	if(isSerializedArray($_SESSION["orders"]))
	{
		$plans=unserialize($_SESSION["orders"]);
	}
	if(isset($plans[$_GET['forder']]))
	{
		//Assign the stored CC id to the order
		$asignACH = $client->call($_UBER_API_URL,'order.update',array(
			'order_id' => $plans[$_GET['forder']] ,
			'ach_id' => $newACH ,
			'info' => array(
				'payment_type' => 'ach_prior_auth'
			),
		));
		header('Location: receipt.php?forder=' . $_GET['forder']);
	}
	
}
if($_POST["m"] == "cc") // New credit card
{
	//Enter the credit card information in the system
	$newCC = $client->call($_UBER_API_URL,'client.cc_add',array(
		'client_id' => $_SESSION['client']['id'] ,
		'cc_num' => $_POST["ccNum"], 
		'cc_expire' => ($_POST["ccm"] . $_POST["ccy"]), 
		'cc_cvv2' => $_POST["cccvv2"], 
		'cc_issuenr' => $_POST["cc_issuenr"],
		'fname' => $_POST["cc_first"],
		'lname' => $_POST["cc_last"],
		'company' => $_POST["cc_company"],
		'address' => $_POST["cc_addr"],
		'city' => $_POST["cc_city"],
		'state' => $_POST["cc_state"],
		'zip' => $_POST["cc_zip"],
		'country' => $_POST["cc_country"],
		'phone' => $_POST["cc_phone"],
		'email' => $_POST["cc_email"],
	));
	//Get the order IDs
	if(isSerializedArray($_SESSION["orders"]))
	{
		$plans=unserialize($_SESSION["orders"]);
	}
	if(isset($plans[$_GET['forder']]))
	{
		//Assign the stored CC id to the order
		$assignCC = $client->call($_UBER_API_URL,'order.update',array(
			'order_id' => $plans[$_GET['forder']] ,
			'card_stored' => '1' ,
			'card_id' => $newCC ,
			'info' => array(
				'payment_type' => 'cc'
			),
		));
		
		header('Location: receipt.php?forder=' . $_GET['forder']);
	}
}
if($_POST['m']=='storedCC') // Stored Credit Card
{
	//Get the order IDs
	if(isSerializedArray($_SESSION["orders"]))
	{
		$plans=unserialize($_SESSION["orders"]);
	}
	if(isset($plans[$_GET['forder']]))
	{
		//Make sure that it is a valid card ID
		if(preg_match('/^[0-9]+$/',$_POST['CCID']))
		{
			echo $_POST['CCID'];
			//Assign the stored CC id to the order
			$assignCC = $client->call($_UBER_API_URL,'order.update',array(
				'order_id' => $plans[$_GET['forder']] ,
				'card_stored' => '1' ,
				'card_id' => $_POST['CCID'],
				'info' => array(
					'payment_type' => 'charge_prior_auth'
				),
			));
		}
		else
		{
			//Invalid card ID
		}
		header('Location: receipt.php?forder=' . $_GET['forder']);
	}
}

if($_POST['m']=='pp') // Stored Credit Card
{
	//Get the order IDs
	if(isSerializedArray($_SESSION["orders"]))
	{
		$plans=unserialize($_SESSION["orders"]);
	}
	if(isset($plans[$_GET['forder']]))
	{
		//Assign the stored CC id to the order
		$paypal = $client->call($_UBER_API_URL,'order.update',array(
			'order_id' => $plans[$_GET['forder']] ,
			'info' => array(
				'payment_type' => 'paypal'
			),
		));
		header('Location: receipt.php?forder=' . $_GET['forder']);
	}
}