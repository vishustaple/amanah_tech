<?php 
session_start();
require_once(dirname(__FILE__) .'/core/config.php');
require_once(dirname(__FILE__) .'/core/functions.php');
require_once(dirname(__FILE__) .'/core/classes.php');
require_once(dirname(__FILE__) .'/core/Savant3.php');

$client = new uber_api_client($_API_USER,$_API_PASS);

setlocale(LC_MONETARY, 'en_US');

//Start the template engine
$tpl = new Savant3();
$tpl->session=$_SESSION;

//Get the order IDs
if(isSerializedArray($_SESSION["orders"])){ //If the session is an array
	$plans=unserialize($_SESSION["orders"]);
}
if(isset($plans[$_GET['forder']])){ //If the order ID we need is in there
	$orderID=$plans[$_GET['forder']];
	$tpl->forder=$_GET['forder'];
	$orderInfo = $client->call($_UBER_API_URL,'order.get',array(
		'order_id' => $orderID ,
	));
	

	// ................................................................................................
	// The purpose of this part is to create an associative array of the packs options, prices and such 
	// out of the five seperate arrays Ubersmith provices
	// ................................................................................................
	
	//Option IDs
	foreach($orderInfo['info']['pack1']["options"] as $key => $val){
		$addons[$key]['option_id']=$val;
	}
	
	//Option names
	foreach($orderInfo['info']['pack1']["options_desc"] as $key => $val){
		$addons[$key]['option_desc']=$val;
	}
	
	//Option group names
	foreach($orderInfo['info']['pack1']["groups_desc"] as $key => $val){
		$addons[$key]['group_desc']=$val;
	}
	
	//Monthly fees
	foreach($orderInfo['info']['pack1']["monthly_fee"] as $key => $val){
		$addons[$key]['monthly_fee']=$val;
	}
	
	
	//Setup fees
	foreach($orderInfo['info']['pack1']["setup_fee"] as $key => $val){
		$addons[$key]['setup_fee']=$val;
	}
	
		
	// ................................................................................................
	// The purpose of this section is process the coupon data. Ubersmith does not display the savings
	// given by a coupon so we have to calculate it ourselves
	// ................................................................................................
	if($orderInfo['info']['coupon'] != ""){
		//Set the prorate coefficient to correctly adjust for prorated orders
		if($orderInfo['info']['pack1']['prorated_total'] > 0)
			$prorateCoef=$orderInfo['info']['pack1']['prorated_total'] / $orderInfo['info']['pack1']['cost'];
		else
			$prorateCoef=1;
			
		//Get the coupon data
		$coupon = $client->call($_UBER_API_URL,'order.coupon_get',array(
			'coupon_code' => $orderInfo['info']['coupon'] ,
		));
		//If the coupon is specifically for this plan or if it is not set to a specific plan
		if($coupon['coupon']['plan_id']==$orderInfo['info']['pack1']['plan_id'] || $coupon['coupon']['plan_id']=='0'){
			$tpl->isCoupon=true;
			$tpl->couponInfo=$coupon['coupon'];
			
			//Get the coupon savings totals 
			$discountTotal = 0;
			//Get the savings total for the overall discount
			if($coupon['coupon']['discount_value'] != '0'){
				if($coupon['coupon']['dollar'] =='0'){
					$discountTotal += $orderInfo['info']['pack1']['cost'] * ($coupon['coupon']['discount_value']/100);
					$feeDiscountTotal += $orderInfo['info']['pack1']['cost'] * ($coupon['coupon']['discount_value']/100);
				}
				else{
					$discountTotal += $coupon['coupon']['discount_value'];
					$feeDiscountTotal += $coupon['coupon']['discount_value'];
				}
			}
			//Get the savings total for the setup discount
			if($coupon['coupon']['setup_discount_value'] != '0'){
				if($coupon['coupon']['setup_dollar'] =='0'){
					$discountTotal += $orderInfo['info']['pack1']['total_setup'] * ($coupon['coupon']['setup_discount_value']/100);
					$setupDiscountTotal += $orderInfo['info']['pack1']['total_setup'] * ($coupon['coupon']['setup_discount_value']/100); 
				}
				else{
					$discountTotal += $coupon['coupon']['setup_discount_value'];
					$setupDiscountTotal += $coupon['coupon']['setup_discount_value'];
				}
			}
			
			//Ubersmith does not show coupon savings for individual parts of an order until the order is submitted.
			//So we have to do this all by hand.
			foreach($coupon['options'] as $cOption){
				foreach($orderInfo['info']['pack1']['option'] as $key=>$val){
					if($cOption['po_id'] == $val && ($cOption['discount'] != 0 || $cOption['setup_discount'] != 0)){
						$feeDiscountTotal += ($cOption['discount']/100)*$orderInfo['info']['pack1']['monthly_fee'][revArrayLookup($orderInfo['info']['pack1']['option'],$cOption['po_id'])];
						$setupDiscountTotal += ($cOption['setup_discount']/100)*$orderInfo['info']['pack1']['setup_fee'][revArrayLookup($orderInfo['info']['pack1']['option'],$cOption['po_id'])];
						
						//Because Ubersmith does adjust for overall coupons but does not treat individual option discounts the same. 
						// We have to store the savings and apply them to the final price our selves
						$priceRecAdjustment=($cOption['discount']/100)*$orderInfo['info']['pack1']['monthly_fee'][revArrayLookup($orderInfo['info']['pack1']['option'],$cOption['po_id'])];
						$priceSetAdjustment=($cOption['setup_discount']/100)*$orderInfo['info']['pack1']['setup_fee'][revArrayLookup($orderInfo['info']['pack1']['option'],$cOption['po_id'])];
						
						$proratePriceRecAdjustment=(($cOption['discount']/100)*$orderInfo['info']['pack1']['monthly_fee'][revArrayLookup($orderInfo['info']['pack1']['option'],$cOption['po_id'])])*$prorateCoef;
						$proratePriceSetAdjustment=(($cOption['setup_discount']/100)*$orderInfo['info']['pack1']['setup_fee'][revArrayLookup($orderInfo['info']['pack1']['option'],$cOption['po_id'])])*$prorateCoef;
					}
				}
			}
			
			$cSavings->immediate=($discountTotal-$priceRecAdjustment) * $prorateCoef; //All immediate savings for the coupon
			if($coupon['coupon']['recurring']=='1')
				$cSavings->fees=$feeDiscountTotal; //All non-setup sevings for the coupon
			$cSavings->prorate=$feeDiscountTotal * $prorateCoef; //The fee savings for the prorated total
			$cSavings->setup=$setupDiscountTotal; //All setup related savings for the coupon
			$tpl->cSavings=$cSavings;
		}
	}
	
	//Compile the tax data
	foreach($orderInfo['info']['taxes'] as $key=>$val)
	{
		$tpl->taxes->listing[$key]=array(
			'name'=>$val['name'],
			'primary_total'=>$val['primary_total'],
			'prorated_total'=>$val['prorated_total'],
			'setup_total'=>$val['setup_total']
		);
	}
	
	//Set the tax data
	$tpl->taxes->total=$orderInfo['info']['pack1']['primary_taxes2'] + $orderInfo['info']['pack1']['setup_taxes2'];
	$tpl->taxes->primary=$orderInfo['info']['pack1']['primary_taxes2'];
	$tpl->taxes->setup=$orderInfo['info']['pack1']['setup_taxes2'];
	$tpl->taxes->prorate=$orderInfo['info']['pack1']['prorated_taxes2'];
	
	//Set the prorate date
	$tpl->prorateDate=$orderInfo['info']['pack1']['prorate_date'];
	//Assign the addon info to the template
	$tpl->addons=$addons;
	
	//Get the plan price to the template
	$tpl->planPrice=$orderInfo['info']['pack1']['price'];
	$tpl->planSetup=$orderInfo['info']['pack1']['total_setup'];
	
	//Give the totals to the template
	$tpl->total=$orderInfo['info']['pack1']['cost']-$priceRecAdjustment+$orderInfo['info']['pack1']['primary_taxes2'];
	
	//The above line is the theoretically correct code, the below emulates Ubersmith's behavior (Ubersmith aknowledges this as a bug)
	$tpl->proTotal=$orderInfo['info']['pack1']['prorated_total']-$priceRecAdjustment + $orderInfo['info']['pack1']['total_setup'] + $orderInfo['info']['pack1']['prorated_taxes2'] + $orderInfo['info']['pack1']['setup_taxes2'];// - $cSavings->prorate;
	
	$tpl->setup=$orderInfo['info']['pack1']['total_setup']-$priceSetAdjustment;// - $cSavings->setup;
	
	//The name of this plan
	$tpl->orderTitle=$orderInfo['info']['pack1']['title'];

	$tpl->display('tpl/' . $_TEMPLATE . '/receipt.tpl.php');
}