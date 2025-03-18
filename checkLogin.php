<?php
session_start();
require_once(dirname(__FILE__) .'/core/config.php');
require_once(dirname(__FILE__) .'/core/functions.php');
require_once(dirname(__FILE__) .'/core/classes.php');
require_once(dirname(__FILE__) .'/core/Savant3.php');

$client = new uber_api_client($_API_USER,$_API_PASS);
$login = $client->call($_UBER_API_URL,'uber.check_login',array(
	'login' => $_GET['uber_login'],
	'pass'  => $_GET['uber_pass'],
	)
);
//If the login is valid and a client
if($login["type"]=="client"){
	$user = $client->call($_UBER_API_URL,'client.get',array(
		'client_id' => $login["id"]
		)
	);
	echo json_encode(true);
}
else{
	echo json_encode(false);
}
?>