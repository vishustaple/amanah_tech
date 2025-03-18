<?php
ini_set("log_errors", 1);
ini_set("error_log", "/var/www/html/form/trigger/log.txt");
$d=0;
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once(dirname(__FILE__) .'/../core/config.php');
require_once(dirname(__FILE__) .'/../core/functions.php');
require_once(dirname(__FILE__) .'/../core/classes.php');

$client = new uber_api_client($_API_USER,$_API_PASS);

$id=$_REQUEST["id"];
$fname=$_REQUEST["fname"];
$lname=$_REQUEST["lname"];
$login=$_REQUEST["login"];
 
$getClient = $client->call($_UBER_API_URL,'client.get',array(
	'client_id' => $id,
	)
);
//Only continue if the login is valid
if(!is_array($getClient)){
	die("Error");
}
$clientinfo=
"ID: " . $getClient["clientid"] . "<br />\n" . 
"First Name: " . $getClient["first"] . "<br />\n" . 
"Last Name: " . $getClient["last"] . "<br />\n" . 
"Company: " . $getClient["company"] . "<br />\n" . 
"Address: " . $getClient["address"] . "<br />\n" . 
"City: " . $getClient["city"] . "<br />\n" . 
"State: " . $getClient["state"] . "<br />\n" . 
"Zip: " . $getClient["zip"] . "<br />\n" . 
"Phone: " . $getClient["phone"] . "<br />\n" . 
"Fax: " . $getClient["fax"] . "<br />\n" . 
"Email: " . $getClient["email"] . "<br />\n" . 
"Comments: " . $getClient["comments"] . "<br />\n" . 
"Country: " . $getClient["country"] . "<br />\n";

$getClient = $client->call($_UBER_API_URL,'client.contact_list',array(
	'client_id' => $id,
	)
);

$mail             = new PHPMailer(); // defaults to using php "mail()"

$body             = "A user has " . (isset($_REQUEST["type"]) ? "registered" : "been modified") . " with the following information:\n " . $clientinfo;

$mail->SetFrom('sales@amanah.com', 'Automated Trigger');

$address = "sales@amanah.com";
$mail->AddAddress($address, "Amanah");

$mail->Subject    = "User " . (isset($_REQUEST["type"]) ? "registration" : "modification") . " notice";

$mail->MsgHTML($body);

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
	file_put_contents("/var/www/html/form/trigger/log.txt",time() . " Mail Error \n");
} else {
  echo "Message sent!";
	file_put_contents("/var/www/html/form/trigger/log.txt",time() . " Sent \n");
}
