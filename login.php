<?php

error_reporting(0);
session_start();
require_once(dirname(__FILE__) . '/core/config.php');
require_once(dirname(__FILE__) . '/core/functions.php');
require_once(dirname(__FILE__) . '/core/classes.php');
require_once(dirname(__FILE__) . '/core/Savant3.php');


if (!isset($_REQUEST["method"])) {
    //Start the template engine
    $tpl = new Savant3();

    //Set other template variables
    $tpl->forder = $_REQUEST["forder"];
    $tpl->display('tpl/' . $_TEMPLATE . '/login.tpl.php');
} else {
    $client = new uber_api_client($_API_USER, $_API_PASS);
    $retArr = array("error" => "none");

    //Check format

    if (
            isset($_REQUEST["password"]) &&
            $_REQUEST["password"] == $_REQUEST["passwordCnf"] &&
            strlen($_REQUEST["password"]) >= 6 &&
            filter_var($_REQUEST["email"], FILTER_VALIDATE_EMAIL) != false
    ) {
        $emailLookup = $client->call($_UBER_API_URL, 'client.get', array(
            'email' => $_REQUEST["email"],
                ), true); 
                // print_r($emailLookup); die();
        //if we are registering
        if ($_REQUEST["method"] == "register") {
            //If the email exists already
            if (isset($emailLookup['clientid']) && $emailLookup['clientid']) {
                //Account exists
                $retArr["error"] = "taken";
            } else {
                //Register the account
                $registerAcct = $client->call($_UBER_API_URL, 'client.add', array(
                    'email' => $_REQUEST["email"],
                    'uber_pass' => $_REQUEST["password"],
                    'first' => $_REQUEST['firstName'],
                    'last' => $_REQUEST['lastName'],
                    'company' => $_REQUEST['company'],
                    'address' => $_REQUEST['address'],
                    'city' => $_REQUEST['city'],
                    'state' => $_REQUEST['state'],
                    'country' => $_REQUEST['country'],
                    'zip' => $_REQUEST['zip'],
                    'phone' => $_REQUEST['phone']
                        ), true);

                $error = $client->getError();


                $_SESSION[$_REQUEST["forder"]] = $registerAcct;
                if (!empty($error)) {
                    //http_response_code(400);
                    $retArr["error"] = $error;
                } else {
                    $retArr["error"] = "none";
                }
            }
            //If logging in
        } else if ($_REQUEST["method"] == "login") {

            $login = $client->call($_UBER_API_URL, 'uber.check_login', array(
                'login' => $emailLookup['clientid'],
                'pass' => $_REQUEST['password'],
                    ), true
            );

            //If the login is valid and a client
            if ($login["type"] == "client") {
                $_SESSION[$_REQUEST["forder"]] = $login["id"];
                $retArr["error"] = "none";
            } else {
                $retArr["error"] = "auth";
            }
        }
    } else {
        $retArr["error"] = "validation";
    }

    //Associate the order with the client ID
    if ($retArr["error"] == "none") {
        $result = $client->call($_UBER_API_URL, 'order.update', array(
            'hash' => $_REQUEST['forder'],
            'client_id' => $_SESSION[$_REQUEST["forder"]],
                )
        );
    }

    echo json_encode($retArr);
}