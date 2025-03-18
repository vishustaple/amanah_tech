<?php
class _PriceData_Price{
	public $price;
	public $setup;
	function __construct($price,$setup){
		$this->price = floatval($price);
		$this->setup = floatval($setup);
	}
}
class PriceData {
	public $valid="";
	public $appliedDesc="";
	public $packSetup="";
	public $packRec="";
	public $subTotal="";
	public $prorate="";
	public $dueToday="";
	public $upgrades = array(); //_PriceData_Price mapped by option ID
	public $period=1;
	public $quantity=1;
	public $forder="";

	/* 
	Constructs the data model from either Ubersmith order or plan data.
	*/
	function __construct($uberPlan, $uberOrder, $couponData) {

		//If no order is given then assume monthly and no forder
		if(is_array($uberOrder)){
			$this->period = $uberOrder["info"]["pack1"]["period"];
                        $this->quantity=$uberOrder["info"]["pack1"]["quantity"];
			$this->forder = $uberOrder["hash"];
		}
		else {
			$this->period=1;
                        $this->quantity=1;
                }

		//Re-index the results to be easier for the template to parse
		foreach($uberPlan["upgrades"] as $groupID=>$groupInfo){
			//Add all product option prices to the array
			foreach($groupInfo["options"] as $optionID=>$optionInfo){
				$periodPrice = $optionInfo["pricing"]["1"]["price"];
				$setupPrice = $optionInfo["pricing"]["1"]["setup_fee"];

				//Apply period savings 
				if($this->period==3) {
					$periodPrice *= 3;
				} 
				if($this->period==6) {
					$periodPrice *= 6*0.95;
				} 
				if($this->period==12) {
					$periodPrice *= 12*0.90;
				}

				//Apply coupon savings
				if($couponData != null){
					$couponOpt = $couponData["options"][$optionInfo["po_id"]];
					if(is_array($couponOpt)){
						$optDiscount=floatval($couponOpt["discount"]);
						$discountCoef=(100-$optDiscount)/100;
						//If this option discount is percent
						if($couponOpt["discount_type"] == 0){
							$periodPrice *= $discountCoef;
						} else {
							$periodPrice -= $optDiscount;
							//Cap absolute discount at 0
							if($periodPrice < 0){
								$periodPrice = 0;
							}
						}

						//Apply discount to setup options
						if($couponOpt["setup_discount_type"] == 0){
							$setupPrice *= (100-$couponOpt["setup_discount"])/100;
						} else {
							$setupPrice -= $couponOpt["setup_discount"];
							//Cap absolute discount at 0
							if($setupPrice < 0){
								$setupPrice = 0;
							}
						}
					}
				}

				$this->upgrades[$optionInfo["po_id"]] = new _PriceData_Price($periodPrice,$setupPrice);
			}
		}

		//Set quantity

		//Apply period discount to the pack
		$period = $uberOrder["info"]["pack1"]["period"];
		$packPrice = $uberPlan["pricing"]["1"]["price"];
		if($period == '3'){
			$packPrice = $uberPlan["pricing"]["1"]["price"] * 3;
		} else if($period == '6'){
			$packPrice = $uberPlan["pricing"]["1"]["price"] * 0.95 * 6;
		} else if($period == '12') {
			$packPrice = $uberPlan["pricing"]["1"]["price"] * 0.90 * 12;
		}

		//Set order wide fielsd for easy viewing
		$this->valid = true;
		$this->appliedDesc= $couponDesc;
		$this->subTotal = $packPrice;
		$this->packRec = $packPrice;
		$this->packSetup = $uberPlan["pricing"]["1"]["setup_fee"];
		if($uberOrder != null){
			$this->prorate = $uberOrder["info"]["pack1"]["prorated_total"];
			$this->subTotal = $uberOrder["info"]["pack1"]["cost"];
			$this->dueToday = $uberOrder["total"];
		} else {
			//TODO: Calculate prorate in future release
			$this->prorate = $this->subTotal;
			$this->dueToday = $this->subTotal;
		}
	}

	function toJSON(){
		return json_encode($this);
	}

	function getPlanPrice(){
		return $this->packRec;
	}
}
