<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ──────────────────────────────────────────────────────────
// PARSE “pretty” URL segments into $_GET
// ──────────────────────────────────────────────────────────
$uri    = $_SERVER['REQUEST_URI'];    // e.g. "/addplan.php/plan/5/queue/3/form/12"
$script = $_SERVER['SCRIPT_NAME'];    // e.g. "/addplan.php"

// strip off "/addplan.php" to get "/plan/5/queue/3/form/12"
$path = substr($uri, strlen($script));

if ($path) {
    $parts = explode('/', trim($path, '/'));
    // expect ['plan','5','queue','3','form','12']
    for ($i = 0; $i + 1 < count($parts); $i += 2) {
        switch ($parts[$i]) {
            case 'plan':  $_GET['pid'] = $parts[$i+1]; break;
            case 'queue': $_GET['q']   = $parts[$i+1]; break;
            case 'form':  $_GET['f']   = $parts[$i+1]; break;
        }
    }
}

// ──────────────────────────────────────────────────────────
// existing includes & setup
// ──────────────────────────────────────────────────────────
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

// ──────────────────────────────────────────────────────────
// existing plan/queue/form logic
// ──────────────────────────────────────────────────────────
if (!empty($_GET["form"])) {
    $plan  = $_FORMIDS[$_GET["form"]][2];
    $queue = $_FORMIDS[$_GET["form"]][1];
    $form  = $_FORMIDS[$_GET["form"]][0];
}
elseif (
    (!isset($_REQUEST["forder"]) || $_REQUEST["forder"]=='')
    && $_GET['form']==''
    && !($_GET['pid'] && $_GET['q'] && $_GET['f'])
) {
    $plan  = $_FORMIDS['test'][2];
    $queue = $_FORMIDS['test'][1];
    $form  = $_FORMIDS['test'][0];
}
else {
    $plan  = $_GET["pid"];
    $queue = $_GET["q"];
    $form  = $_GET["f"];
}

if (isset($_REQUEST["forder"]) && $_REQUEST['forder']) {
    $order = $client->call($_UBER_API_URL,'order.get',[
        'hash' => $_REQUEST["forder"],
    ]);
    if (is_array($order["info"]["pack1"]["coupon"])) {
        $coupon = $client->call($_UBER_API_URL,'order.coupon_get',[
            'coupon_id' => $order["info"]["pack1"]["coupon"]["coupon_id"],
        ]);
    }
    $plan = $order["info"]["pack1"]["plan_id"];
}

$result    = $client->call($_UBER_API_URL,'uber.service_plan_get',[
    'plan_id' => (int)$plan,
]);
$priceData = new PriceData($result,$order,$coupon);
$priceJSON = $priceData->toJSON();

//Set other template variables
$tpl->plan            = $plan;
$tpl->queue           = $queue;
$tpl->form            = $form;
$tpl->priceJSON       = $priceJSON;
$tpl->servicePlanData = $result;
$tpl->title           = $result["title"];

// render your “new colo” template
$tpl->display('tpl/' . $_TEMPLATE . '/addplan-new-colo-tpl.php');
