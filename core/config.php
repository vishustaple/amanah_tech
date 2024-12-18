<?php
$_UBER_API_URL='https://104.245.144.68/api/2.0';
$_API_USER='API-Test'; //API user username
$_API_PASS='t7Hj@u6N$MeMx5^m%Iv##'; //API user password

$_SMTP_USER = "";
$_SMTP_PASS = "";
$_SMTP_HOST = "10.10.10.221";
$_SMTP_PORT = 26;
$_ABUSE_FROM_EMAIL = "test@test.com";
$_ABUSE_FROM_NAME = "John Doe";

$_TAX_IDS["HST"]=1;
$_TAX_IDS["GST"]=2;
$_TAX_IDS["CAN-ON"]=4;
$_TAX_IDS["CAN-REST"]=5;
$_TAX_IDS["WORLD"]=6;

$_TAX_RATE["HST"]=0.13;
$_TAX_RATE["GST"]=0.05;
$_TAX_RATE["CAN-ON"]=0.13;
$_TAX_RATE["CAN-REST"]=0.06;
$_TAX_RATE["WORLD"]=0;

define('_FORCE_HTTPS',false); //Due to the nature of the data being passed, this script will force the user to use https, set to false to override this 
//error_reporting ( 1 ); 
ini_set('display_errors', 'on');
//Template name 
$_TEMPLATE="new";

//Form configs
//At this time, Ubersmith does not allow the viewing of form data. This means that you
//either must specify the form ID, queue ID and service plan ID or preset these.
// eg
// $_FORMIDS['plans']=array(1,2,3); //1=form, 2=queue and 3=service plan
$_FORMIDS['test'] = [2, 6, 12];

//Do not edit below this line
$_CHECKSUM_LEN=4;
$_SALT="AgeG_WSjh54j-"; //This line must be the same when a quote is made and redeemed for the quote to work
date_default_timezone_set("Canada/Eastern");
if(_FORCE_HTTPS && $_SERVER['HTTPS']!="on")
{
	$redirect= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	header("Location:$redirect");
	die();
}
