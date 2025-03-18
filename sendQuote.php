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
if($_REQUEST["forder"]!="")
{
	//Decode the querystring
	foreach($_REQUEST as $key=>$val){
		$_REQUEST[$key]=urldecode($val);
	}
	//A convenience array for the types of billing
	$billing=array(
		0=>"One Time Fee",
		1=>"Monthly", 
		3=>"Quarterly",
		6=>"Semi-Annually",
		7=>"Annually"
	);
	//Generate the order hash
	$orderHash=$_REQUEST['forder'];
	
	$orderInfo = $client->call($_UBER_API_URL,'order.get',array(
		'hash' => $orderHash ,
	));
	$planInfo = $client->call($_UBER_API_URL,'uber.service_plan_get',array(
		'plan_id' => $orderInfo["info"]["pack1"]["plan_id"] ,
	));
	$noteText = "";
	$noteText = str_replace("<ul style=\"margin-left:15px;\" >","",$noteText);
	$noteText = str_replace("<li>","",$noteText);
	$noteText = str_replace("</li>","",$noteText);
	$noteText = str_replace("</ul>","",$noteText);
	$noteText= preg_replace('/\n/', '', $noteText, 1);
	$noteText = str_replace("\n","<br>\n",$noteText);
	$optStr="";
	foreach($orderInfo["info"]["pack1"]["groups_desc"] as $key=>$val){
		$optStr .= $val . ": " . $orderInfo["info"]["pack1"]["options_desc"][$key] . "<br />\n";
	}
	//Assemble the body
	$body="Dear Potential Client,<br />
<br />
Here's your saved server configuration:<br />
=============<br />
{$noteText}
<br />
Server Configuration<br />
{$optStr}
=============<br />
Toronto<br />
<br />
Total: " . moneyFormatUS($orderInfo["info"]["pack1"]["cost"]) . "<br />
Setup: " . moneyFormatUS($orderInfo["info"]["pack1"]["total_setup"]) . "<br />
Billing Period: " . $billing[$orderInfo["info"]["pack1"]["period"]] . "<br />
<br />
Your Amanah Tech server quote is ready and saved here:<br />
<br />
http://billing.amanah.com/form/addplan.php?forder={$orderHash} <br />
<br />
We look forward to working with you.<br />
<br />
Sincerely, <br />
Amanah Tech";
	
	$mail = new PHPMailer();
    //$mail-> isSMTP();
    //$mail->Host = 'smtp.amanah.com';
    $mail->SetFrom('sales@amanah.com', 'Amanah Quotes');
	$mail->AddAddress($_REQUEST["email"], "Valued Customer");
	$mail->Subject    = "Quote #" . $orderInfo["order_id"] . " from Amanah";
	$mail->MsgHTML($body);
  
	if(!$mail->Send()) {
	  echo json_encode(false);
	} else {
	  echo json_encode(true);
	}
	
}