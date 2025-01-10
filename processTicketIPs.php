<?php
/*
Name: writeLog
Parameters: $str Input string, $fptr The file pointer to the log
Returns: None
Description: Writes the given string to the given file with a line timestamp header
*/
function writeLog($str,$fptr){
	$header = date('[c] ');
	fwrite($fptr, $header . $str . "\n");
}

session_start();
$_UBER_FORM_DIR = "/var/www/billing.amanah.com/htdocs/form";
require_once($_UBER_FORM_DIR .'/core/config.php');
require_once($_UBER_FORM_DIR .'/core/functions.php');
require_once($_UBER_FORM_DIR .'/core/classes.php');

$client = new uber_api_client($_API_USER,$_API_PASS);

//Set up the log
$_LOG = fopen('processTicketIPs.log','a');

//Get the ticket queues to look through
$idFile = fopen("searchqueues.csv", "r") or die("Unable to open searchqueues.csv!");
$idStr = fgets($idFile);
$idArr = explode(',',$idStr);

//Load the reply email
$emailFile = fopen("reply_email.txt", "r") or die("Unable to open reply_email.txt!");
$EMAIL_SUBJECT = fgets($emailFile);
$EMAIL_BODY = "";
while($line = fgets($emailFile)){	
	$EMAIL_BODY .= $line;
}

//Load the reply to the ticket
$replyFile = fopen("reply_ticket.txt", "r") or die("Unable to open replay_ticket.txt!");
$TICKET_SUBJECT = fgets($replyFile);
$TICKET_BODY = "";
while($line = fgets($replyFile)){	
	$TICKET_BODY .= $line;
}


//Get all open tickets for selected queues
foreach($idArr as $id){
	writeLog("Queue ID " . $id, $_LOG);
	//Get all open messages for a given ID
	$queueResult = $client->call($_UBER_API_URL,'support.ticket_list',array(
	'queue' => $id,
	//"type"=>"Open",
	"limit"=>"100",
	"begin"=>strtotime("-1 week")
	));

	//For a given ID process each open message
	foreach($queueResult as $msgId=>$messageData){
		writeLog("Ticket ID " . $msgId, $_LOG);
		
		$messageResult = $client->call($_UBER_API_URL,'support.ticket_post_list',array(
		"ticket_id"=>$msgId
		));
		
		//Get the first message
		$firstMsgKey = key($messageResult);
		$firstMsgBody = $messageResult[$firstMsgKey]["body"];
		
		//See if we can find an IP
		$foundIP = getIPAddrFromStr($firstMsgBody);
		
		//If there is an IP
		if($foundIP != "") {
            writeLog("IP " . $foundIP, $_LOG);
            //Get the device associated with this IP
            $devResult = $client->call($_UBER_API_URL, 'device.ip_lookup', array(
                'ip' => $foundIP,
            ));

            if (is_null($devResult) || $devResult == "") {
                writeLog("No device found for ticket ID " . $msgId . ", IP " . $foundIP, $_LOG);
            } else {
                //Get the client associate with this device
                //In testing $devResult["client_id"] doesn't work
                $clientResult = $client->call($_UBER_API_URL, 'device.get', array(
                    'device_id' => $devResult["device_id"],
                ));

                //If we have a valid ID assign it to the ticket
                if (isset($clientResult["clientid"]) && is_numeric($clientResult["clientid"])) {
                    //Process the reply title
                    if ($EMAIL_SUBJECT == "{RE_TITLE}") {
                        $EMAIL_SUBJECT = "RE: " . $messageData["subject"];
                    }

                    //Reply to the complainer
                    $mail = new PHPMailer();
                    $mail->IsSMTP();
                    $mail->SMTPAuth = true;
                    $mail->Host = $_SMTP_HOST;
                    $mail->Port = $_SMTP_PORT;
                    $mail->Username = $_SMTP_USER;
                    $mail->Password = $_SMTP_PASS;

                    $mail->SetFrom($_ABUSE_FROM_EMAIL, $_ABUSE_FROM_NAME);
                    $mail->Subject = $EMAIL_SUBJECT;
                    $mail->MsgHTML($EMAIL_BODY);
                    $mail->AddAddress($messageData["reply_to"], $messageData["author"]);
                    print_r($messageResult);
                    die();

                }
            }
        }
		else{
			writeLog("No IP found in ticket ID " . $msgId , $_LOG);
		}
	}
}