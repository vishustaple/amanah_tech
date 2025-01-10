<?php
session_start();
error_reporting(0);
require_once(dirname(__FILE__) .'/core/config.php');
require_once(dirname(__FILE__) .'/core/functions.php');
require_once(dirname(__FILE__) .'/core/classes.php');
require_once(dirname(__FILE__) .'/core/Savant3.php');
require_once(dirname(__FILE__) .'/email.php');

$client = new uber_api_client($_API_USER,$_API_PASS);

setlocale(LC_MONETARY, 'en_US');

//Start the template engine
// $tpl = new Savant3();
// $tpl->session=$_SESSION;
$coupon = null;

if($_POST["s"]=="")
{
	
	
	$orderID=$_GET["forder"];
	$order = $client->call($_UBER_API_URL,'order.get',array(
		'hash' => $orderID,
		)
	);

	//Make sure the client assignment is valid
	//This should never happen
	if($_SESSION[$_REQUEST["forder"]] != $order["client_id"]){
		//print_r($_SESSION); die();
		header("Location: addplan.php?forder=" . $_REQUEST["forder"]);
	}

	if(is_array($order["info"]["pack1"]["coupon"])){
		$coupon = $client->call($_UBER_API_URL,'order.coupon_get',array(
			'coupon_id' => $order["info"]["pack1"]["coupon"]["coupon_id"],
			)
		); //print_r($order); die();
	}

	$clientData = $client->call($_UBER_API_URL,'client.get',array(
		'client_id' => $order["client_id"] ,
	));

	//Otherwise continue
	$pack = $client->call($_UBER_API_URL,'uber.service_plan_get',array(
		'plan_id' => $order["info"]["pack1"]["plan_id"],
		)
	);

	$priceData = new PriceData($pack,$order,$coupon);
	$priceJSON = $priceData->toJSON();

	// Prepare the data structure for the JSON response
	$response = array();

	// Set price-related details
	$response['title'] = $pack["title"];
	$response['forder'] = $_REQUEST["forder"];
	$response['subTotal'] = $priceData->subTotal;
	$response['packPrice'] = $priceData->packRec;
	$response['priceJSON'] = $priceData->toJSON();
	$response['packSetup'] = $priceData->packSetup;
	$response['period'] = $order["info"]["pack1"]["period"];
	$response['quantity'] = $order["info"]["pack1"]["quantity"];
	$response['packTotal'] = $priceData->packRec * $order["info"]["pack1"]["quantity"];
	$response['totalSetup'] = floatval($priceData->packSetup) * intval($order["info"]["pack1"]["quantity"]);

	// Load client data if it exists
	$response['city'] = $clientData["city"];
	$response['postal'] = $clientData["zip"];
	$response['lname'] = $clientData["last"];
	$response['email'] = $clientData["email"];
	$response['phone'] = $clientData["phone"];
	$response['state'] = $clientData["state"];
	$response['fname'] = $clientData["first"];
	$response['address'] = $clientData["address"];
	$response['country'] = $clientData["country"];
	$response['company'] = $clientData["company"];

	// Add tax rate and total
	$response['_TAX_RATE'] = $_TAX_RATE;
	$response['total'] = $order["total"];

	// Populate the details for each upgrade option
	$response['details'] = [];
	foreach ($order["info"]["pack1"]["options"] as $groupId => $optId) {
		$response['details'][$groupId] = array(
			'price' => $priceData->upgrades[$optId]->price,
			'setup' => $priceData->upgrades[$optId]->setup,
			'title' => $pack["upgrades"][$groupId]["options"][$optId]["spo_description"]
		);
	}

	// Encode the response array to JSON and send it as a response
	header('Content-Type: application/json');

	
	echo json_encode($response, JSON_PRETTY_PRINT);

	// $tpl->priceJSON=$priceJSON;
	// $tpl->forder=$_REQUEST["forder"];
	// $tpl->title = $pack["title"];
	// //$tpl->period = $pack["period"];
    //     $tpl->period = $order["info"]["pack1"]["period"];
	// $tpl->quantity = $order["info"]["pack1"]["quantity"];
	// $tpl->packPrice = $priceData->packRec;
	// $tpl->packTotal = $priceData->packRec * $order["info"]["pack1"]["quantity"];
	// $tpl->packSetup = $priceData->packSetup;
	// $tpl->totalSetup = floatval($priceData->packSetup) * intval($order["info"]["pack1"]["quantity"]);
	// $tpl->subTotal = $priceData->subTotal;

	// //Load client data if it exists
	// $tpl->fname=$clientData["first"];
	// $tpl->lname=$clientData["last"];
	// $tpl->email=$clientData["email"];
	// $tpl->phone=$clientData["phone"];
	// $tpl->address=$clientData["address"];
	// $tpl->city=$clientData["city"];
	// $tpl->state=$clientData["state"];
	// $tpl->postal=$clientData["zip"];
	// $tpl->country=$clientData["country"];
	// $tpl->company=$clientData["company"];

	// $tpl->_TAX_RATE = $_TAX_RATE;

	// //Always display the actual total, display errors are better than billing errors. 
	// $tpl->total = $order["total"]; 

	// $tpl->email = $clientData["email"];


	// $tpl->details = array();
	// foreach($order["info"]["pack1"]["options"] as $groupId=>$optId){
	// 	$tpl->details[$groupId] = array(
	// 		"price"=>$priceData->upgrades[$optId]->price,
	// 		"setup"=>$priceData->upgrades[$optId]->setup,
	// 		"title"=>$pack["upgrades"][$groupId]["options"][$optId]["spo_description"],
	// 	);
	// }

	// $tpl->display('tpl/' . $_TEMPLATE . '/checkout.tpl.php');
}
else{
	
	//Make sure the user is authed
	$orderID=$_REQUEST["forder"];
	$order = $client->call($_UBER_API_URL,'order.get',array(
		'hash' => $orderID,
		)
	);

	//Make sure the client assignment is valid
	//This should never happen
	if($_SESSION[$_REQUEST["forder"]] != $order["client_id"]){
		//print_r($_SESSION); die();
		header("Location: addplan.php?forder=" . $_REQUEST["forder"]);
	}

	//Update the client
	//Enter the credit card information in the system
	$name=explode(' ',$_POST["ccName"]);
	$fname=$name[0];
	$lname=$name[sizeof($name)-1];
	$modifyClient = $client->call($_UBER_API_URL,'client.update',array(
		'client_id' => $order["client_id"], 
		'first' => $_POST["fname"],
		'last' => $_POST["lname"],
		'company' => $_POST["company"],
		'address' => $_POST["address"],
		'city' => $_POST["city"],
		'state' => $_POST["state"],
		'zip' => $_POST["zip"],
		'country' => $_POST["country"],
		'phone' => $_POST["phone"],
		'email' => $_POST["email"],
	)); 
	$response = array();

	if($_POST["pm"] == "cc"){
		//Enter the credit card information in the system
		// $name=explode(' ',$_POST["ccName"]);
		// $fname=$name[0];
		// $lname=$name[sizeof($name)-1];
		$newCC = $client->call($_UBER_API_URL,'client.cc_add',array(
			'client_id' => $order["client_id"], 
			'cc_num' => $_POST["ccNum"], 
			'cc_expire' => ($_POST["ccm"] . $_POST["ccy"]), 
			'cc_cvv2' => $_POST["cccvv2"], 
			'fname' => $_POST["fname"],
			'lname' => $_POST["lname"],
			'company' => $_POST["company"],
			'address' => $_POST["address"] . " " . $_POST["address2"],
			'city' => $_POST["city"],
			'state' => $_POST["state"],
			'zip' => $_POST["zip"],
			'country' => $_POST["country"],
			'phone' => $_POST["phone"],
			'email' => $_POST["email"],
		)); 


		if(isset($_REQUEST['forder']))
		{
			//Assign the stored CC id to the order
			$assignCC = $client->call($_UBER_API_URL,'order.update',array(
				'hash' => $orderID,
				'card_stored' => '1' ,
				'card_id' => $newCC ,
				'info' => array(
					'payment_type' => 'charge_prior_auth'
				),
			));
		}
	}
	if($_POST["pm"]=="storedCC"){
		if(isset($_REQUEST['forder']))
		{
			//Make sure that it is a valid card ID
			if(preg_match('/^[0-9]+$/',$_POST['CCID']))
			{
				//Assign the stored CC id to the order
				$assignCC = $client->call($_UBER_API_URL,'order.update',array(
					'hash' => $orderID,
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
		}
	}
	if($_POST["pm"]=="pp"){
		if(isset($_REQUEST['forder']))
		{
			//Assign the stored CC id to the order
			$paypal = $client->call($_UBER_API_URL,'order.update',array(
				'hash' => $orderID,
				'info' => array(
					'payment_type' => 'paypal'
				),
			));
		}
		
	}

	//Assign relevant tax rates
	$taxarr = array();
	if($_POST["country"]=="CA" && $_POST["state"]=="ON"){
		$taxarr[$_TAX_IDS["CAN-ON"]]=1;
	} else if($_POST["country"]=="CA") {
		$taxarr[$_TAX_IDS["CAN-REST"]]=1;
	} 
	$assignTax = $client->call($_UBER_API_URL,'order.update',array(
		'hash' => $orderID,
		'info' => array(
			'pack1' => array(
				'taxes' => $taxarr,
				'setup_taxes'=>$taxarr,
			),
		),
	));

	//Submit the order
	if(isset($_REQUEST['forder']))
	{

		//Assign the stored CC id to the order
		$submit = $client->call($_UBER_API_URL,'order.submit',array(
			'hash' => $orderID,
		));// print_r($submit); die();
		
		// Get order info
		$getOrder = $client->call($_UBER_API_URL,'order.get',array(
			'hash' => $orderID,
		)); 
		
		// Initialize response array
	
		// Set the total
		$response['total'] = $getOrder['total'];

		// If payment is via PayPal, get some info to display to the user
		if ($getOrder['info']['payment_type'] == 'paypal') {
			$delStart = strpos($submit, '<p>');
			$delEnd = strpos($submit, '<input type="submit"');
			
			// Prepare the button content
			$response['button'] = substr($submit, 0, $delStart) . substr($submit, $delEnd);

			// Set PayPal info
			$response['paypal'] = true;
		}

		// Set the order ID and email
		$response['orderID'] = $getOrder['order_id'];
		$response['email'] = $getOrder['info']['email'];
		// email send Users
		$emailArray=array($getOrder['info']['email']);
		$emailStaus = sendEmailTesting($_POST['term_policy'],$emailArray);
		$response['email_send'] = $emailStaus;
		// Convert the response array into a JSON object and output it
		echo json_encode($response);
	
		// //If payment if via PayPal, get some info to display to the user
		// $tpl->total=$getOrder["total"];
		// if($getOrder["info"]["payment_type"] == 'paypal')
		// {
		// 	$delStart=strpos($submit,'<p>');
		// 	$delEnd=strpos($submit,'<input type="submit"');

		// 	$tpl->button=substr($submit,0,$delStart) . substr($submit,$delEnd);

		// 	//Replace the return addresses from the default. 
		// 	$tpl->paypal=true;
		// }
		// $tpl->orderID=$getOrder["order_id"];
		// $tpl->email=$getOrder["info"]["email"];
		// $tpl->display('tpl/' . $_TEMPLATE . '/submit.tpl.php');
	}
}

?>