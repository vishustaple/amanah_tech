<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Amanah Tech - Order Form</title>
	<link rel="stylesheet" type="text/css" href="lib/style1.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
		integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
	<link href='//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'
		type='text/css'>
		<link rel="icon" type="image/png" href="img/amanah-data-centers-logo.png">
		</head>
		<script>
			var priceModelJSON = "<?= addslashes($this->priceJSON) ?>",
				priceObject = JSON.parse(priceModelJSON);
		</script>
		<style>
			/* .logo img{
				max-width: 120px;
			} */
		</style>
<body>
	<!-- Page Loader -->
	<div id="loader" class="loader-wrapper" style="display:none;">
		<div class="loader"></div>
	</div>
	<header class="main-header py-2">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
			<div class="logo">
				<a href="https://www.amanah.com/"><img src="img/amanah-tech-logo-header.png" alt="logo"></a>
			</div>
			<div class="d-flex gap-3" style="font-size:13px">
            <p class="mb-0" style="color:#858585;text-transform:uppercase;">Speak To An Expert :<b> +1(416) 603-9825</b></p>
			<!-- <a href="#" class="text-decoration-none" style="font-size:13px">Live Chat</a> -->
			</div>
			</div>
		</div>
	</header>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center p-0 mt-3 mb-2">
				<div class="card px-3 pt-4 pb-0 mt-3 mb-3">
					<div id="orderForm">
						<!-- <form action="changePeriod.php" method="POST" class="" id="orderForm"> -->

						<!-- progressbar -->
						<ul id="progressbar">
							<li class="active" id="account"><strong>Configure</strong></li>
							<li id="personal"><strong>Summary</strong></li>
							<li id="payment"><strong>Terms and Policies</strong></li>
							<li id="confirm"><strong>Log in</strong></li>
							<li id="checkout_sec"><strong>Checkout</strong></li>
							<li id="complete_sec"><strong>Complete</strong></li>
						</ul>
						<div class="progress">
							<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
								aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<br> <!-- fieldsets -->
						<fieldset>
							<form id="orderForms">
								<input type="hidden" name="period" id="period-id" value="1" />
								<input type="hidden" name="quantity" id="quantity" value="1" />
								<input type="hidden" name="coupon" id="coupon" value="" />
								<input type="hidden" name="p" id="p"
									value="<?= isset($_GET["pid"]) ? $_GET["pid"] : $_FORMIDS[$_GET["form"]][2] ?>" />
								<input type="hidden" name="f" id="f"
									value="<?= isset($_GET["f"]) ? $_GET["f"] : $_FORMIDS[$_GET["form"]][0] ?>" />
								<input type="hidden" name="q" id="q"
									value="<?= isset($_GET["q"]) ? $_GET["q"] : $_FORMIDS[$_GET["form"]][1] ?>" />
								<input type="hidden" name="forder" id="forder" value="<?= $_GET["forder"] ?>" />
								<input type="hidden" name="regMethod" id="regMethod" value="login" />
								<input type="hidden" name="ajax" id="ajax" value="yes" />
								<div class="form-card">
									<div class="row">
										<div class="col-lg-9">
										<div class="card_list">
												<h5 class="card_title d-flex justify-content-between">
													Colocation Services
													<span class="m-0 pe-3" id="refresh_product_options" style="cursor:pointer;color:#DA6F1A;font-weight:bold">RESET</span>
												</h5>

												<?php
												$firstName = 'first_prd_name';
												$firstPrice = 'first_prd_price';
												$loopIndex = 0;

												foreach ($this->servicePlanData["upgrades"] as $groupID => $groupInfo):
													$options = $groupInfo["options"];
													$firstOptionKey = array_key_first($options);
													$firstOption = $options[$firstOptionKey];
													$isSecondLoop = ($loopIndex === 1);
												?>
													<div class="items_list">
														<div class="items_name">
															<h5>
																<?= $groupInfo["pu_name"] ?>
															</h5>
														</div>

														<div class="items_config get_all_prd_info set_hard_<?= $firstOptionKey ?>">
															<input type="hidden" class="set_val_selected_prd"
																name="pu<?= $firstOption["pu_id"] ?>"
																id="<?= $firstOption["po_id"] ?>"
																value="<?= $firstOption["po_id"] ?>" />

															<h5 class="items_config_title set_prd_name <?= $isSecondLoop ? 'first_prd_name' : '' ?>">
																<?= $firstOption['po_description'] ?>
															</h5>

															<?php
															$poId = htmlspecialchars($firstOption["po_id"]);
															$price = $firstOption["pricing"]["1"]["price"];
															$priceAttr = $isSecondLoop ? 'data-price="' . htmlspecialchars($price) . '"' : '';
															$additionalClass = $isSecondLoop ? 'first_prd_price' : '';
															$displayPrice = $price == 0 ? '' : htmlspecialchars($price);
															?>

															<h5 class="items_config_title new_price_data price_data set_price_html <?= $additionalClass ?>"
																data-optId="<?= $poId ?>" <?= $priceAttr ?>>
																<?= $displayPrice ?>
																<i class="fa fa-caret-down" aria-hidden="true"></i>
															</h5>

														</div>

														<div class="dropdown_data hidden">
															<ul>
																<?php
																$firstName = $firstPrice = '';
																$isFirstItem = true;

																foreach ($options as $optionID => $optionInfo):
																?>
																	<li class="get_hard <?= $isFirstItem ? 'selected' : '' ?>"
																		data-class_id="<?= $firstOptionKey ?>"
																		data-name="pu<?= $optionInfo["pu_id"] ?>"
																		data-id="<?= $optionInfo["po_id"] ?>"
																		data-value="<?= $optionInfo["po_id"] ?>">
																		<div class="items_config">
																			<h5 class="items_config_title get_prd_name">
																				<?= $optionInfo['po_description'] ?>
																			
																			</h5>

																			<h5 class="items_config_title price_data get_price_html"
																				data-optId="<?= $optionInfo["po_id"] ?>">
																				<?= $optionInfo["pricing"][1]["price"] ?>
																				<i class="fa fa-caret-down" aria-hidden="true"></i>
																			</h5>
																		</div>
																	</li>
																<?php
																	$isFirstItem = false;
																endforeach;
																?>
															</ul>
														</div>
													</div>
												<?php
													$loopIndex++;
												endforeach;
												?>
											</div>

										</div>
										<div class="col-lg-3">
											<div class="side_panel">
												<div class="sidebar-panel">
													<div class="billing-section">
														<div class="billing-period">
															<label for="billing-period">Billing Period</label>
															<div class="custom-select-wrapper">
																<select id="billing-period" class="form-control custom-select">
																	<option value="1">Monthly</option>
																	<option value="3">Quarterly - SAVE 5%</option>
																	<option value="6">Semi-Annually - SAVE 7%</option>
																	<option value="12">Annually - SAVE 10%</option>
																</select>
															</div>
														</div>
														<div class="quantity-section">
															<label>Quantity</label>
															<div class="quantity-controls">
																<button class="btn-decrease">-</button>
																<input id="quantity_value" class="ajaxUpdateOrder"
																	type="number" value="1" min="1" readonly />
																<button class="btn-increase">+</button>
															</div>
														</div>
													</div>
													<div class="summary-section">
														<h4>Order Summary</h4>
													 <div class="summary-list-item d-none">
															<span class="summary-list-item-label">
																Package Price
															</span>
															<span
																class="summary-list-item-price format-price package-price"></span>
														</div>
														<div class="summary-list-item d-none">
															<span class="summary-list-item-label">
																Package Setup
															</span>
															<span
																class="summary-list-item-price format-price package-setup-price"></span>
														</div> 
														<div class="summary-item "></div>
														<div class="summary-list-item d-none">
															<span class="summary-list-item-label">
															   Setup Fee
															</span>
															<span
																class="summary-list-item-price format-price package-setup-price summary-list-item-label"></span>
														</div> 
													</div>
													<div class="modifications-section first-modifications-section">
													</div>
													<div class="summary-section-add">
													<div class="summary-list-item">
															<span class="summary-list-item-label-new">
															   Setup Fee
															</span>
															<span
																class="summary-list-item-price format-price package-setup-price summary-list-item-label-new"></span>
														</div> 
													</div>
													<div class="payment-section">
														<div class="payment-details">
															<div>
																<span class="summary-list-item-label">First
																	Payment</span>
																<span
																	class="summary-list-item-price format-price total-price"></span>
															</div>
															<div>
																<span
																	class="summary-list-item-label perioud_cost">Monthly
																	Cost</span>
																<span
																	class="summary-list-item-price format-price order-subtotal-price"></span>
															</div>
														</div>
														<!-- <button class="btn-summary next" value="Next">PROCEED TO SUMMARY</button> -->
														<!-- <input type="button" name="next" class="next action-button" value="PROCEED TO SUMMARY" /> -->
													</div>

													<div class="btn_wrapper">
                                                 <label for="test" class="custom-btn">PROCEED TO SUMMARY</label>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
							<input type="button" id="test" name="next" class="next d-none action-button" value="PROCEED TO SUMMARY" />
							<!-- <input type="button" name="next" class="next action-button" value="Next" /> -->
						</fieldset>
						<fieldset>
							<div class="form-card">
								<div class="row">
									<div class="col-lg-9">
										<div class="terms_card">
											<div class="d-flex justify-content-between align-items-center">
												<h5 class="card_title">Order Summary</h5>
												<p class="m-0 pe-3"><a href="javascript:void(0);" id="checkout_pre_one"
														class=" text-uppercase" style="cursor:pointer;color:#DA6F1A;font-weight:bold" >Reconfigure</a></p>
											</div>
										</div>
										<div class="card_list order_hide_title order_summary_title"></div>
										<div class="card_list order_summary_data"></div>
									</div>
									<div class="col-lg-3">
										<div class="side_panel">
											<div class="sidebar-panel">
												<div class="billing-section summary_sidebar">
													<div class="billing-period">
														<label for="billing-period">Billing Period</label>
														<p class="prd_val"></p>
													</div>
													<div class="quantity-section">
														<label>Quantity</label>
														<p class="qty_val"></p>
													</div>


												</div>
												<div class="coupen_code pb-2 d-flex gap-2 justify-space-between">
													<input type="text" name="coupon" id="summaryCoupon"
														placeholder="Coupon Code">
													<button
														class="apply_btn coupon-button ajaxUpdateOrder1">Apply</button>
												</div>
												<span class="coupon-msg disp-none">Voucher <span
														class="coupon-msg-code"></span> applied (<span
														class="coupon-msg-desc"></span>) <br /> </span>
												<span class="coupon-error disp-none">Coupon Does not Exist. <i
														class="fa-solid fa-xmark"></i><br /></span>
												<!-- <span class="voucher-disclainer">*Voucher disclaimer specifying details goes here.</span> -->
												<div class="summary-section">
													<h4>Order Summary</h4>
													<div class="summary-item"></div>
													<div class="setup-item-option"></div>
												</div>
												<div class="modifications-section all-modifications-section"></div>
												<div class="payment-section">
													<div class="payment-details">
														<div>
															<span class="summary-list-item-label">First Payment</span>
															<span
																class="summary-list-item-price format-price total-price"></span>
														</div>
														<div>
															<span class="summary-list-item-label perioud_cost">Monthly
																Cost</span>
															<span
																class="summary-list-item-price format-price order-subtotal-price"></span>
														</div>
													</div>
													<!-- <button class="btn-summary">PROCEED TO SUMMARY</button> -->
												</div>
												<div class="btn_wrapper">
												<label for="test2" class="custom-btn">Proceed to Terms and Policies</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- <input type="button" name="next" class="next action-button" value="Next" /> -->
							<input type="button" name="next" id="test2" class="next d-none action-button "
								value="Proceed to Terms and Policies" />
							<input type="button" name="previous" class="previous action-button-previous"
								id="click_checkout_pre_one" value="Previous" />
						</fieldset>
						<fieldset>
							<div class="form-card">
								<div class="row">
									<div class="col-lg-9">
										<div class="card_list">
											<div class="terms_card">
												<div class="d-flex justify-content-between align-items-center">
													<h5 class="card_title">Terms and Policies</h5>
													<p class="m-0 pe-3 "><a href="javascript:void(0);" id="checkout_pre"
															style="cursor:pointer;color:#DA6F1A;font-weight:bold">Back to summary</a></p>
												</div>
											</div>

											<div
												class="doc_step d-flex gap-3 justify-content-between align-items-center ">
												<p>Documents Signed</p>
												<div class="progress_bar add-plan-new"></div>
												<p class="pdf_signed_count">0 / 1</p>
											</div>
											<div class="privacy_policy">
												<section class="legal px-3 py-4">
													<div class="wrap1" id="policy_contant1" data-wrap="1">
														<h2 class="tac text-center">Colocation Service Agreement</h2>
													
														<h6>
													1.1.  Term:   
													</h6>
													<p>
													Each Service’s Initial Term is indicated on the applicable Order Form 
													and the Initial Term will begin as of the Service Date. The Customer 
													will be deemed to have accepted the Service as of the Service Date.
													</p>
													<h6>
													1.2.  Renewal:
													</h6>
													<p>
													At the end of the Initial Term, each Service ordered hereunder 
													will renew for successive Renewal Terms equal in length to the Initial 
													Term unless and until terminated as provided herein.
													</p>
													<h6>
													2. SERVICE AND OPTIONS
													</h6>
													<p>
													Pursuant to the CSA, AMANAH will provide the Services to the Customer for the Service charges. 
													The Customer’s signature on the Order Form constitutes its acknowledgment and agreement to be 
													bound by the CSA. Capitalized terms are defined at the end of these Terms. Within the scope of 
													the Colocation Service, AMANAH provides a non-exclusive license to space to install, operate, 
													maintain, and access the Customer’s Equipment within AMANAH data center (the “Space”, either footprint only, 
													footprint with rack or cage/suite) and secured electrical power supply, cross connection, 
													and Internet as stated in the Order Form. AMANAH reserves all rights not specifically granted 
													to the Customer under such license. Subject to their availability, the Customer may select one 
													or more options associated with the Service such as listed in the Order Form, in which case the 
													Customer agrees to pay the related fees such as indicated in the Order Form:
													</p>
													<h6>
													2.1.  Electrical power
													</h6>
													<p>
													AMANAH shall provide the Customer with power if and as specified on the Customer’s Order Form, 
													at the rate specified on the Order Form. Notwithstanding the foregoing, AMANAH may increase 
													power pricing to the extent utility rates (or rates charged by landlords supplying power) 
													are increased for such power. If no power is specified on the Order Form, then AMANAH shall 
													have no obligation to provide power to the Space. The maximum utilization rate of any power 
													circuit is eighty percent (80%) of the power circuit’s capacity. If the Customer exceeds the 
													maximum utilization rate, the Customer must either (i) reduce power consumption to levels below 
													the maximum utilization rate or (ii) subject to availability, order additional power from AMANAH. 
													Notwithstanding the preceding, if the Customer’s power consumption in excess of the maximum 
													utilization rate creates, in AMANAH’s sole judgment, an unsafe or hazardous environment then
													AMANAH may immediately suspend providing power to the Customer until the Customer has cured
													the breach. For safety reasons, the Customer may not modify the data center’s power supply 
													systems beyond (and including) the circuit breaker provided by AMANAH to the Customer within
													the Space to connect to the Equipment. All work on the data center’s power supply systems beyond 
													(and including) such circuit breaker and/or outside of the Space must be carried out by AMANAH or 
													its representatives. AMANAH shall not be liable if the Customer, by the action of the Customer’s 
													personnel or its representatives or by the action of AMANAH’s personnel at the request of the 
													Customer, exceeds the rating of an electrical circuit, power strip, and/or circuit breaker.
													The Customer is responsible for providing their own power bar(s) and to coordinate with AMANAH to connect them to the power circuit.
													</p>
													<h6>
													2.2.  Uninterruptible Power Supply:
													</h6>
													<p>
													AMANAH shall provide electrical power supply through its UPS
													system for the main circuit (A-Power).
													AMANAH may provide electrical power supply through its UPS
													system for B-Power circuits at its sole discretion and subject to
													availability. Fees for B-power, as agreed in the Order Form, will
													be added to the Customer's invoice. B-Power circuits are
													intended as a backup for A-Power circuits only, and additional  charges will apply if used concurrently with A-Power circuits,
													which the Customer agrees to pay. AMANAH may provide B-
													Power from the same or different UPS as A-Power, subject to
													availability.
													</p>
													<h6>
													2.3.  Internet:
													</h6>
													<p>
													AMANAH shall provide the Customer with Internet if and as
													specified on the Customer's Order Form, at the rate specified  on the Order Form.
													</p>
													<p>
													2.3.1.   IP Address  Allocation: AMANAH will allocate an  IPv4/29 free of charge. If the Customer desires a larger
													allocation of IP address space, the Customer shall submit an
													application to AMANAH for the larger allocation, using Order
													Form. Each larger allocation of IPv4 address space will be  subject to an additional Monthly Fee. IP address space
													allocations are subject to the AUP and will be terminated and
													reclaimed when the Customer's Dedicated Internet Access  Services with AMANAH are terminated.
													</p>
													<h6>
													2.4.  Cross Connection :
													</h6>
													<p>
													AMANAH shall provide the Custom er with cross-connects if
													and as specified on the Customer's Order Form, at the rate  specified on the Order Form. Cross-connects may have an
													installation and a monthly recurring charge associated with
													their use. The Customer may only perform cabling within the
													Space.  All work on the data center's cabling system outside of  the Space, including cross-connections between contiguous
													spaces belonging to the same Customer shall be performed by AMANAH.
													AMANAH shall not be liable for any cabling provided and/or
													operated without its authorization or for any cabling performed
													by the Customer.
													</p>
													<h6>
													2.5. Service Use and Interruption: 
													</h6>
													<p>
													2.5.1.   The  Customer's use of AMANAH's Services or  Network may only be for lawful purposes and must comply with AMANAH's A UP. Transmission of any material in violation of  any law, regulation or the AUP is strictly prohibited. Access to
													other networks connected to AMANAH's Network must comply
													with such other networks' rules.    
													</p>
													<p>
													2.5.2.   AMANAH's obligations and  the Customer's  exclusive remedies for a delayed or failed installation of a
													Service or the failure of AMANAH's Network or any Service are
													stated in the AMANAH SLA.
													</p>
													<h6>
													3. SERVICE CHARGES AND BILLING.
													</h6>
													<p>
													3.1. 	Service charges are on the Order Form and do not
													include applicable Taxes unless so indicated. New services,
													and upgrades of existing Services will result in additional fees
													and/or charges.
													</p>
													<p>
													3.2.	Invoices are sent monthly in advance. The
													Customer agrees to pay all charges and applicable Taxes for
													the Service by the due date without counterclaim, set-off or
													deduction. A late charge shall be added to the Customer's  past-due balance in the amount of $20.00. AMANAH may
													change the specifications, Terms or charges for the Service by
													providing the Customer at least two (2) months advance written
													notice. The Customer agrees that its obligation to pay service
													charges and Taxes under this CSA shall survive the
													termination of the CSA.
													</p>
												    <p>
													3.3. The Customers claiming tax exemption must
													
													provide AMANAH with a properly executed exemption form.
													</p>
													<h6>
													4. CUSTOMER`S RESPONSIBILITIES
													</h6>
													<h6>
													4.1.  Installation of Equipment:  
													</h6>
													<p>
													The Customer, at its own expense, is solely responsible for
													itself, or its representatives, to order, deliver, unpack, and
													install the Equipment for use in the Space. The Customer
													represents and warrants that it is the owner or legal custodian
													of the Equipment and has full authority to install and operate
													the Equipment in the Space.
													</p>
													<h6>
													4.2.  Access:
													</h6>
													<p>
													4.2.1.	Shared Rackspace Customers are allowed escorted access 
													during business hours on Monday to Friday, from 9:00 am to 2:00 pm,
													provided that they give one (1) business day's prior notice. However, 
													any unscheduled or emergency access shall incur charges as per our 
													Remote Hands Support fees, for which the Customer is obligated to pay.
													</p>
													<p>
													4.2.2.	Private rack Customers are granted unrestricted
													and unescorted 24/7 access. The Customer may authorize up
													to two (2) individuals to access the Space, at no additional cost,
													subject to the terms of this Agreement. Access cards will be
													provided to the Customer at the AMANAH office and must be
													taken in person. Any authorized representatives of the
													Customer discovered in unauthorized areas may have their
													access rights immediately suspended or terminated.
													</p>
													<p>
													4.2.3. 	In the event of a default on the Customer's
													obligations under the CSA, including failure to pay Service
													charges when due, AMANAH reserves the right to suspend or
													terminate the Customer's access to the Space without notice.
													It is important to note that AMANAH assumes no responsibility
													for data backup or storage of the Customer's equipment or
													content.
													</p>
													<h6>
													4.3.  Prohibited Use:    
													</h6>
													<p>
													No photo equipment, video or voice recording equipment, food
													or drink, or hazardous material shall be brought into any
													AMANAH data center. Use of such items may result in
													suspension or termination of access rights. The Customer shall
													not do or allow any use, which in the opinion of AMANAH
													causes or is likely to cause damage or constitutes a nuisance
													or annoyance to the facility, equipment, personnel, or other
													customers.
													</p>
													<h6>
													4.4.  Removal of Equipment:    
													</h6>
													<p>
													Except as provided below, the Customer must remove all items
													of Equipment located in the Space by the expiry date of the
													CSA. In the event the Equipment is not removed, such
													Equipment will be considered abandoned, and AMANAH may,
													without liability to the Customer, remove, decommission, and
													dispose of the Equipment.
													</p>
													<h6>
													5. REMOTE HANDS SUPPORT
													</h6>
													<p>
													5.1. AMANAH provides, on the limited basis set forth
													herein, Remote Hands Support billed hourly, during business
													hours (1-hour minimum &amp; 30 minutes incremental) or after
													business hours (2 hours minimum &amp; 1 hour incremental).
													</p>
													<p>
													5.2. Customer agrees that AMANAH is not
													responsible for any loss or damage to property of any kind
													owned or leased by you or your employees, and agents,
													including but not limited to the Equipment affected during any
													Remote Hands process performed hereunder, regardless of
													cause. Customer agrees to indemnify and hold harmless
													AMANAH from any claims of loss or damage resulting from any
													Helping Hands events performed by AMANAH on Customer's  Equipment.
													</p>
													<h6>
													6. EMERGENCY SITUATION  
													</h6>
													<p>
													6.1. In the event of an emergency that presents a
													substantial risk of a Service outage, or damages to equipment
													or data belonging to AMANAH, a third party, the data center,
													or to any persons or property present therein, AMANAH may
													rearrange the Customer's Equipment (with the same care used  by AMANAH in rearranging its own equipment) as is
													reasonably necessary to respond to the emergency; and only
													as necessary, AMANAH  may disconnect Equipment if the
													emergency requires such disconnection to avoid damage.
													AMANAH shall use commercially reasonable efforts to notify
													the Customer prior to rearranging the Equipment or
													disconnecting the Equipment, and in any case, will notify the  Customer thereafter. AMANAH will return the Equipment to the
													original Space (if rearranged) or re-connect the Equipment as
													soon as reasonably practicable given the emergency.
													</p>
													<h6>
													7. TERMINATION, RESTRICTION OR SUSPENSION.
													</h6>
													<p>
													7.1. Prior to the Service Date, AMANAH may
													terminate the CSA if not approved by AMANAH corporate
													management (including a credit check). AMANAH also may
													restrict, suspend or terminate the CSA, The Customer's use of  or access to any Service, or both, at any time if (a) the
													Customer is in material breach of the CSA (including but not
													limited to the AUP) and, in AMANAH's sole judgment, an
													immediate restriction or suspension is necessary to protect the
													AMANAH Network or AMANAH's ability to provide services to
													other the Customers; or (b) the Customer's account  is unpaid  one (1) day after the due date.
													</p>
													<p>
													7.2. Either Party may terminate the CSA: (a) at the end
													of an Initial Term or at the end of a Renewal Term by providing
													the other Party with at least two (2) months prior written notice;
													(b) Notices provided during a monthly Renewal Term will not
													be effective until the end of the next month (i.e., notice received)
													April 20th is effective June 1st; and  (c) except as otherwise
													stated herein, during an Initial Term or Renewal Term if the
													other Party breaches any material term or condition of this CSA
													and fails to cure such breach within one (1) month after receipt
													of written notice of the same.
													</p>
													<p>
													7.3. All termination notices by the Customer must be
													sent separately for each Service and must be sent to
													sales@AMANAH.com.  
													<p>7.4. If a Service is terminated prior to the Service Date,
													the Customer shall pay AMANAH for all Initial Costs for su
													Service. If the Service is terminated after the Service Date, the
													Customer shall pay AMANAH (a) for the Service up through
													the date of termination; and (b) except in the case of
													termination by the Customer as provided in Section 7.2 above,
													the Initial Costs (unless already paid) and the Termination
													Charge. The Customer acknowledges that because actual
													damage to AMANAH caused by early termination of a Service
													order is uncertain and would be difficult to determine, the
													Termination Charge is a reasonable liquidated damage and is
													not a penalty. Any reconnections of the Service shall result in
													additional reconnection charges to the Customer at
													AMANAH's then -prevailing rates.  
													</p>
													<p>7.5. If the Customer defaults in any of its payment
													obligations under the CSA, the Customer agrees to pay
													AMANAH's reasonable expenses, including but not limited to
													legal and collection agency fees, incurred by AMANAH in
													enforcing its rights.
													</p>
													<h6>
													8. DISCLAIMER OF WARRANTY AND  LIMITATION OF LIABILITY
													</h6>
													<p>
													8.1. EXCEPT AS OTHERWISE EXPRESSLY SET
													FORTH HEREIN,  THE SERVICE ARE PROVIDED ﬁAS IS,ﬂ  AND NEITHER AMANAH NOR ANY OF I TS PROVIDERS,	
													LICENSORS,OFFICERS, EMPLOYEES, OR AGENTS
													MAKES ANY WARRANTY, CONDITION OR GUARANTEE
													WITH RESPECT TO THE SERVICE OR AS TO THE
													RESULTS TO BE OBTAINED FROM THE USE OF THE
													SERVICE, UNDER THIS CSA OR OTHERWISE. THE
													SERVICE IS PURCHASED WITH KNOWLEDGE OF THIS
													WARRANTY LIMITATION. AMANAH EXPRESSLY
													DISCLAIMS ALL OTHER WARRANTIES, CONDITIONS OR
													GUARANTEESOF ANY KIND, EITHER EXPRESS OR
													IMPLIED, INCLUDING, BUT NOT L IMITED TO ANY
													WARRANTIES OR CONDITIONS OF MERCHANTABILITY,
													NON-INFRINGEMENT, SATISFACTORY QUALITY,
													AND/OR FITNESS FOR A PARTICULAR PURPOSE.
													AMANAH DOES NOT MONITOR, AND DISCLAIMS ALL
													LIABILITY AND RESPONSIBILITY FOR, THE CONTENT OF
													ANY COMMUNICATION TRANSMITTED BY THE
													CUSTOMER OR OTHERS, AND DISCLAIMS ALL LIABILITY
													AND RESPONSIBILITY FOR UNAUTHORIZED USE OR
													MISUSE OF THE SERVICE.
													</p>
													<p>
													8.2. WITHOUT PREJUDICE TO OR LIMITING OF
													AMANAH'S RIGHT TO RECEIVE PAYMENT FOR THE
													SERVICE, AMANAH'S ENTIRE LIABILITY FOR ALL
													CLAIMS OF WHATEVER NATURE (INCLUDING CLAIMS
													BASED ON NEGLIGENCE) ARISING OUT OF THIS
													AGREEMENT AND ALL OTHERS BETWEEN THE
													CUSTOMER AND AMANAH, AND THE PROVISION BY
													AMANAH OF FACILITIES, TRANSMISSION, DATA, THE
													SERVICE OR EQUIPMENT INCLUDING, BUT NOT
													LIMITED TO, DAMAGE TO REAL/PERSONAL PROPERTY,
													SHALL NOT EXCEED THE L ESSER OF (A) THE AMOUNT
													PAID BY THE CUSTOMER FOR THE SERVICE AT ISSUE
													IN THE PRIOR SIX (6) MONTHS TO THE ACTION GIVING
													RISE TO THE CLAIM, OR (B) ONE HUNDRED THOUSAND
													DOLLARS ($100,000.00) IN TOTAL; PROVIDED,
													HOWEVER, THAT THE FOREGOING LIMITATIONS SHALL
													NOT APPLY FOR DEATH OR PERSONAL INJURY
													CAUSED BY AMANAH, OR FOR ANY OTHER LIABILITY
													WHICH MAY NOT BE EXCLUDED OR LIMITED UNDER
													APPLICABLE LAW.
													</p>
													<p>
													8.3. THE CUSTOMER RECOGNIZES THAT
													INTERNET CONSISTS OF MULTIPLE PARTICIPATING
													NETWORKS THAT ARE SEPARATELY OWNED AND NOT
													SUBJECT TO AMANAH'S CONTROL.  THE CUSTOMER  AGREES THAT AMANAH SHALL NOT BE LIABLE FOR
													DAMAGES INCURRED OR SUMS PAID WHEN THE
													SERVICE IS TEMPORARILY OR PERMANENTLY
													UNAVAILABLE DUE TO MALFUNCTION OF, OR
													CESSATION OF, INTERNET SERVICES BY NETWORK(S)
													OR INTERNET SERVICE PROVIDERS NOT SUBJECT TO
													AMANAH 'S CONTROL, OR FOR TRANSMISSION  ERRORS IN, CORRUPTION OF, OR THE SECURITY OF
													THE CUSTOMER INFORMATION CARRIED ON SUCH
													NETWORKS OR INTERNET SERVICE PROVIDERS.
													AMANAH SHALL HAVE NO LIABILITY HEREUNDER FOR
													DAMAGES INCURRED OR SUMS PAID DUE TO ANY
													FAULT OF THE CUSTOMER OR ANY THIRD PARTY, OR
													BY ANY HARMFUL COMPONENTS (SUCH AS
													COMPUTER VIRUSES, WORMS, COMPUTER
													SABOTAGE, AND 'DENIAL OF SERVICE' ATTACKS).
													AMANAH IS NOT LIABLE FOR ANY BREACH OF
													SECURITY ON THE CUSTOMER'S NETWORK,  REGARDLESS OF WHETHER ANY REMEDY PROVIDED
													IN THIS CSA FAILS OF ITS ESSENTIAL PURPOSE.
													WITHOUT LIMITING THE FOREGOING, THE CUSTOMER  AGREES THAT IT WILL NOT HOLD AMANAH
													RESPONSIBLE FOR (A) THIRD PARTY CLAIMS AGAINST
													THE CUSTOMER FOR DAMAGES, (B) LOSS OF OR
													DAMAGE TO THE CUSTOMER'S RECORDS OR  DATA OR  THOSE OF ANY THIRD PARTY, OR (C) LOSS OR
													DAMAGE TO THE CUSTOMER ASSOCIATED WITH THE
													INOPERABILITY OF THE CUSTOMER 'S EQUIPMENT OR  APPLICATIONS WITH ANY COMPONENT OF THE
													SERVICE OR THE AMANAH NETWORK. THE CUSTOMER
													AGREES TO MAKE ALL CLAIMS RELATED TO THE
													SERVICE DIRECTLY AGAINST AMANAH, AND WAIVES
													ANY RIGHT TO RECOVER DAMAGES (DIRECTLY OR BY
													INDEMNITY) RELATED TO THE SERVICE BY CLAIMING
													AGAINST OR THROUGH A THIRD PARTY TO THIS CSA.
													</p>
													<p>
													8.4. NEITHER AMANAH NOR ANYONE ELSE
													INVOLVED IN CREATING, PRODUCING, DELIVERING
													(INCLUDING SUSPENDING OR DISCONTINUING THE
													SERVICE) OR SUPPORTING THE SERVICE SHALL BE
													LIABLE TO THE CUSTOMER, ANY REPRESENTATIVE,
													OR ANY THIRD PARTY FOR ANY INDIRECT,
													INCIDENTAL, SPECIAL, PUNITIVE OR CONSEQUENTIAL
													DAMAGES ARISING OUT OF THE SERVICE OR INABILITY
													TO USE THE SERVICE, INCLUDING, WITHOUT
													LIMITATION, LOST REVENUE, LOST PROFITS, LOSS OF
													TECHNOLOGY, RIGHTS OR THE SERVICE, EVEN IF
													ADVISED OF THE POSSIBILITY OF SUCH DAMAGES,
													WHETHER UNDER THEORY OF CONTRACT OR TORT
													(INCLUDING NEGLIGENCE, STRICT LIABILITY OR
													OTHERWISE).
													</p>
													<p>
													8.5. NO ACTION OR PROCEEDING AGAINST
													AMANAH MAY BE COMMENCED BY THE CUSTOMER
													MORE THAN ONE (1) YEAR AFTER THE LAST DAY ON
													WHICH THE SERVICE WHICH IS THE BASIS FOR THE  ACTION IS RENDERED, AND THE CUSTOMER
													ACKNOWLEDGES THAT THIS LIMITATION
													CONSTITUTES AN EXPRESS WAIVER OF ANY RIGHTS
													UNDER ANY APPLICABLE STATUTE OF LIMITATIONS
													WHICH WOULD OTHERWISE AFFORD ADDITIONAL TIME
													FOR SUCH A CLAIM.
													</p>
													<p>
													</p>
													<h6>
													  9. INDEMNIFICATION
													</h6>
													<p>
													The Customer will indemnify, defend and hold harmless
													AMANAH and its directors, officers, employees, affiliates, and
													its agents and subcontractors from and against any claims,
													suits, actions, and proceedings from any and all third parties,
													and for payment of any Losses, to the extent such Losses arise
													(a) as a result of violation of the AUP or any applicable law or
													regulation; (b) from any and all claims by any of the Customer's  customers or other third party end users in connection with a
													Service (including, without limitation, any claims regarding
													content transmitted using a Service or violation of data
													protection legislation), regardless of the form of action, whether
													in contract, tort, warranty, or strict liability; provided, however,  that the Customer will have no obligation to indemnify and
													defend AMANAH against claims for damages for bodily injury
													or death caused by AMANAH's gross negligence or willful
													misconduct; or (c) from claims of copyright infringement and all
													manner of intellectual property claims, defamation claims,
													claims of publication of obscene, indecent, offensive, racist,
													unreasonably violent, threatening, intimidating or harassing
													material, and claims of infringement of data protection
													legislation, to the extent such Losses are based upon (i) the
													content of any information transmitted by the Customer or by
													any of the Customer's  customers or authorized end users, (ii)  the use and/or publication of any and all communications or
													information transmitted by the Customer or by any of
													Customer's  customers or authorized end user, or (iii) the use  of Service(s) by the Customer in any manner inconsistent with
													the terms of this CSA, including without limitation the AUP.
													</p>
													<h6>
													10. ADDITIONAL PROVISIONS.
													</h6>
													<p>
													10.1. Except as to payment obligations of the
													Customer, neither Party shall have any claim or right against
													the other Party for any failure of performance due to Force
													Majeure.
													</p>
													<p>
													10.2. Neither Party is the agent or legal representative
													of the other Party, and this CSA does not create a partnership
													joint venture, or fiduciary relationship between AMANAH an
													the Customer. Neither Party shall have any authority to agree
													for or bind the other Party in any manner whatsoever. This CS
													confers no rights, remedies, or claims of any kind upon an
													third party, including, without limitation, the Customer's  subscribers or end-users.
													</p>
													<p>
													10.3. This CSA for Service is made pursuant to and
													shall be construed and enforced in accordance with the law
													of Ontario, Canada, specifically those of Toronto, without
													regard to its choice of law principles. Any action arising out of
													or related to this CSA shall be brought in the Municipal or
													Provincial courts located in Toronto, Ontario, Canada, and the
													Customer consents to the jurisdiction and venue of such
													courts.
													</p>
													<p>
													10.4. Notices, if required, must be sent in writing by e-
													mail, courier, or first class mail (postage prepaid) to the
													appropriate contact point listed on the Order Form, and are
													considered made when received at that address; provided, that
													termination notices to AMANAH must be sent in accordance
													with Section 7.3 above. In the event of an emergency,
													AMANAH may only be able to provide verbal notice first; such
													verbal notice will be followed by written notice. The Customer
													is responsible for the accuracy of its information on the Order
													Form, including points of contact.
													</p>
													<p>
													10.5. The Customer may not assign this CSA without AMANAH’s prior written consent, which consent shall not unreasonably be withheld. Any such assignment without AMANAH’s prior written consent shall be void.
													</p>
													<p>
													10.6. If (but only if) required by AMANAH’s or the Customer’s agreement with the Customer’s Landlord: (a) any cessation or interruption in AMANAH’s Service does not 
													constitute a default or constructive eviction by the Customer’s Landlord, and (b) the Customer agrees to waive and release Landlord and its related parties from any 
													liability in connectionwith any damages whatsoever incurred by the Customer, including lost revenues, which arise, or are alleged to arise, out of any interruption of or defect in the AMANAH Service,
													REGARDLESS OF WHETHER SUCH INTERRUPTION OR DEFECT IS CAUSED BY THE ORDINARY NEGLIGENCE (BUT NOT THE GROSS NEGLIGENCE OR WILLFUL MISCONDUCT) OF A RELEASED PARTY.
													</p>
													<p>
													10.7. The AMANAH Network is owned by AMANAH, or
													its licensors, and is protected by copyright and other
													intellectual property laws. The Customer agrees that title to
													and ownership of the Services, in any form, shall at all times
													and in any event be held exclusively by AMANAH. The
													Customer shall be entitled to only such rights with respect to
													the Services as are specifically granted herein.
													</p>
													<p>
													10.8. This CSA and such other written agreements,
													documents, and instruments as may be executed i
													connection herewith are the final, entire, and complet
													agreement between the Customer and AMANAH an
													supersede all prior and contemporaneous negotiations an
													oral representations and agreements, all of which are merge
													and integrated into this CSA. No purchase order or simila
													document provided by the Customer to AMANAH shall be o
													any force and effect. Am endments to the CSA or any Service  shall be in writing and signed by both Parties.
													</p>
													<p>
													10.9. This CSA and any Addendum thereto may be
													executed in one or more counterparts all of which take
													together shall constitute one and the same instrument
													</p>
													<h6>
													DEFINITION    AMANAH
													</h6>
													<p>
													AMANAH Tech Inc. or subsidiaries or affiliates.
													</p>
													<h6>
													AUP
													</h6>
													<p>
													AMANAH's Acceptable Use Policy as posted by  AMANAH at  https://www.AMANAH.com/acceptable-use-policy/  AMANAH  reserves the right to amend its AUP at  any time, effective upon posting on the  AMANAH website.    
													</p>
													<h6>Network</h6>
													<p>
													The telecommunications network and network components owned, operated, or controlled  by  AMANAH.
													</p>
													<h6>The Customer</h6>
													<p>
													The current or potential client of AMANAH is identified in the  attached Order Form.  
													</p>
													<h6>CSA</h6>
													<p>
													The entire Colocation Service Agreement between AMANAH and th e Customer for the  provision  of the Service.    
													</p>
													<h6>Equipment</h6>
													<p>
													The Customer's  equipment.    

													</p>
													<h6> Force Majeure</h6>															<p>
													Causes beyond a Party's control, including but not limited to:  acts of God; fire; explosion;  vandalism; cable cut; storm; flood, or other similar occurrences; any law, order,   regulation,  direction, action, or request of any government, including federal, state, provin cial, municipal  and local governments claiming jurisdiction over a Party or the   Service, or of any  department, agency, commission, bureau, corporation, or other instrumentalit y of any such  government, or of any civil or mili tary authority; national emergencies;  unavailability of  materials  or rights-of-way; insurrections; riots, terrorist acts or wa rs  (declared/undeclared);  or  strikes, lock-outs, work stoppages, or other labor  difficulties, supplier failures, shortages,  breaches or delays.     
													</p>
													<h6>Initial Costs</h6>
													<p>
													Greater of (a) installation fees (if not paid); or (b) all thir d-party costs and charges incurred  by or charged to  AMANAH on behalf of the Customer for the Service, including but  not  limited to local loop fees,  cross-connect charges, and wiring fees.     Term
													</p>
													<h6>Initial</h6>
													<p>
													The initial length of term for the Services is as mentioned in the O rder Form..    
													</p>
													<h6>Landlord</h6>
													<p>
													The Customer's landlord, building owner or property/telecom manager.    
													</p>
													<h6>Losses</h6>
													<p>
													Costs, fees, liabilities, losses, damages, or penalties, inclu ding reasonable legal fees.   
													</p>
													<h6>Order Form</h6>
													<p>
													Cover form to which these Terms are attached, identifying the specif ic Service(s) to be  delivered.     
													</p>
													<h6>Party or Parties</h6>
													<p>
													A company or an organization that enters into this CSA with one or more other parties.
													</p>
													<h6>
													Renewal Term
													</h6>
													<p>
													Subsequent length of term for the Services after completion of the  Initial Term.    
													</p>
													<h6>Service</h6>
													<p>
													Include a range of essential features such as rack space, power, and cooling, netw ork  connectivity, physical security, and managed services.      
													</p>
													<h6>Service Date</h6>
													<p>
													The date on which the Customer first uses the Service(s).
													</p>
													<h6>
													SLA
													</h6>
													<p>
													AMANAH's Service Level Agreement as posted by  AMANAH at  https://www.AMANAH.com/service-level-agreement/ reserves the right to amend its SLA at any time,  effective upon posting on the  AMANAH website.   </p><h6>Space</h6> <p>
													Rented rack space from AMANAH.</p>
													<h6>	Tax or Taxes</h6>
													All taxes arising in any jurisdiction 
													<h6> Termination Charge</h6>
													<p>
													A single payment equal to the total remaining dollar value of the applicable S ervice order  through the Initial Term or Renewal Term, as applicable.
													</p>
													<h6>Terms</h6> 
													<p>
															Terms and conditions that apply to the Services AMANAH provid es to the Customer.
															</p>
														<div class="signature1"></div>
													</div>

													<div class="wrap_2" id="policy_contant2" data-wrap="2">

														<h2 class="tac text-center">Acceptable Use Policy</h2>
														<p>For the purposes of this Acceptable Use Policy (the “AUP”),
															the “Customer” is an individual or organization that has
															entered into a service agreement with Amanah Tech Inc.
															(hereinafter, “Amanah”) for use of Amanah’s systems and
															Service. This AUP, including the list of Prohibited
															Activities (as defined below), is an integral part of each
															service agreement for services with Amanah. This AUP also
															applies to Amanah’s operational partners. This Policy was
															designed to prevent unacceptable uses of Amanah’s systems
															and Service and to ensure that Amanah is able to provide the
															level and quality of Service that Amanah’s Customers expect
															and consistent with its corporate values. Each Amanah
															Customer is responsible for ensuring that the use of Service
															provided to such customers complies with this AUP. Failure
															to comply with this AUP could result in termination of
															services by Amanah. Amanah reserves the right to modify the
															AUP at any time, effective upon posting at
															https://www.amanah.com/legal/AUP/. The continued use of the
															Amanah Systems and Service after an amended policy has been
															posted will be deemed as acceptance of the amended policy.
														</p>

														<div class="list">
															<h5>Prohibited Activities of Amanah Systems and Service</h5>
															<p>1. Transmission, collection, distribution or storage of
																any material in violation of any applicable law or
																regulation is strictly prohibited. This includes,
																without limitation: (i) material protected by copyright,
																trademark, trade secret or other intellectual property
																right used without proper authorization, (ii) any
																activity that disseminates, promotes or facilitates
																child pornography, materials that involve non-consensual
																sexual pornography or any other illegal pornographic
																content, (iii) material that is obscene, defamatory,
																constitutes an illegal threat, or violates export
																control laws, (iv) posting any content that threatens,
																advocates, promotes or otherwise encourages violence or
																which provides instruction, information or assistance in
																causing or carrying out such violence; and (v) violating
																the personal privacy of another individual.</p>

															<p>2. Sending Unsolicited Bulk Email (“UBE”, “spam”). The
																sending of any form of Unsolicited Bulk Email through
																Amanah’s network is prohibited. Likewise, the sending of
																UBE from another service provider advertising a web
																site, email address or utilizing any resource hosted on
																Amanah’s network, is prohibited. Amanah accounts or
																services may not be used to solicit customers from, or
																collect replies to, messages sent from another Internet
																Service Provider where those messages violate this
																Policy or that of the other provider:</p>

															<p>3. Running Unconfirmed Mailing Lists. Subscribing email
																addresses to any mailing list without the express and
																verifiable permission of the email address owner is
																prohibited. All mailing lists run by Amanah customers
																must be Closed-loop (“Confirmed Opt-in”). The
																subscription confirmation message received from each
																address owner must be kept on file for the duration of
																the existence of the mailing list. Purchasing lists of
																email addresses from 3rd parties for mailing to from any
																Amanah-hosted domain, or referencing any Amanah account,
																is prohibited.</p>

															<p>4. Advertising, transmitting, or otherwise making
																available any software, program, product, or service
																that is designed to violate this Policy or the policy of
																any other Internet Service Provider, which includes, but
																is not limited to, the facilitation of the means to send
																Unsolicited Bulk Email, initiation of flooding, phishing
																attacks, mail-bombing, denial of service attacks.</p>

															<p>5. Operating an account on behalf of, or in connection
																with, or reselling any service to, persons or firms
																listed in the Spamhaus Register of Known Spam Operations
																(ROKSO) database.</p>

															<p>6. Unauthorized attempts by a user to gain access to any
																account or computer resource not belonging to that user
																(e.g., “cracking”).</p>

															<p>7. Obtaining or attempting to obtain service by any means
																or device with the intent to avoid payment.</p>

															<p>8. Unauthorized access, alteration, destruction, or any
																attempt thereof, of any information of any Amanah
																customers or end-users by any means or device.</p>
															<p>9. Customers are required to responsibly manage hosted
																content and sub-customers so as to not attract network
																attacks including Denial of Service (DOS) or Distributed
																Denial of Service (DDoS) attacks. Customers must take
																rapid measures to move content to other delivery systems
																as required. Using Amanah’s Services to interfere with
																the use of the Amanah network by other customers or
																authorized users.</p>

															<p>10. Using Amanah’s Services to host an online pharmacy
																not certified by the Canadian International Pharmacy
																Association.</p>

															<p>11. Installation or distribution of “pirated” or other
																software products that are not appropriately licensed
																for use by Customer.</p>

															<p>12. Actions that restrict or inhibit anyone – whether a
																Customer of Amanah or otherwise – in his or her use or
																enjoyment of Amanah’s products and services, or that
																generate excessive network traffic through the use of
																automated or manual routines that are not related to
																ordinary personal or business use of Internet services.
															</p>
															<p>13. Executing any form of network monitoring that will
																intercept data not intended for the Customer.</p>
															<p>14. Failing to comply with Amanah’s procedures relating
																to the activities of customers on Amanah-owned
																facilities.</p>
															<p>15. Furnishing false or incorrect data on the order form
																contract (electronic or paper) including fraudulent use
																of credit card numbers or attempting to circumvent or
																alter the processes or procedures to measure time,
																bandwidth utilization or other methods to document “use”
																of Amanah’s products or services.</p>

															<h5>Personal Information Protection and Electronic Documents
																Act Notice</h5>
															<p>Amanah provides no assurance of confidentiality or
																privacy of any personal information transmitted through
																or stored on Amanah’s technology and makes no guarantees
																as to which entities or users will have access to or be
																excluded from Amanah’s network. Amanah reserves the
																right to monitor transmissions over its network for
																network maintenance, service quality assurance, or any
																other purpose permitted by the Personal Information
																Protection and Electronic Documents Act (PIPEDA) or
																other applicable laws. By using Amanah’s technology, you
																acknowledge and consent to the collection, use, and
																disclosure of your personal information as described in
																our privacy policy.</p>

															<h5>Customer Responsibility for Customer’s Users</h5>
															<p>Each Amanah`s Customer is responsible for the activities
																of its users and, by accepting service from Amanah, is
																agreeing to ensure that its customers/representatives or
																end-users abide by this Policy. Amanah’s Customer is
																solely responsible for use of their account, regardless
																if such use occurred without the account holder’s
																consent or knowledge. If Amanah believes, in its sole
																discretion, that a violation of this AUP (direct, or
																indirect, including violations by a third party) has
																occurred, it may take immediate responsive action.
																Amanah is entitled to remove the offending material,
																establish immediate or temporary filtering, deny access,
																isolate and preserve data, suspend or terminate the
																Amanah Service, engage law enforcement or take any other
																appropriate action, as determined by Amanah, in addition
																to any remedies provided by any agreement to provide
																Amanah Service. Amanah is not responsible for, and shall
																not be held liable for any damages resultant of any
																conduct, content, communications, goods and services
																available on or through Amanah’s systems and services.
																The failure to enforce this AUP, for whatever reason,
																shall not be construed as a waiver of any right to do so
																at any time. If any portion of this Policy is held
																invalid or unenforceable, that portion will be construed
																consistent with applicable law as nearly as possible,
																and the remaining portions will remain in full force and
																effect. This AUP shall be exclusively governed by, and
																construed in accordance with the governing law provision
																set out in the service agreement between Customer and
																Amanah.</p>

															<h5>Questions?</h5>
															<p>If you are unsure of whether any contemplated use or
																action is permitted, please contact Amanah at <a
																	href="mailto:support@amanah.com">support@amanah.com</a>
															</p>
															<div class="signature2"></div>
														</div>

												</section>
											</div>
											<div class="sign_box">
												<div class="input-container">
													<div class="row">

														<div class="col-lg-6 px-0">
															<div class="signature-container">
																<canvas id="signaturePad" width="400"
																	height="200"></canvas>
																<button class="clear" id="clearButton">Clear
																	Pad</button>

															</div>
														</div>
														<div class="col-lg-6 py-3">
															<h2>Draw your signature </h2>
															<p class="text-left">Move your cursor or finger inside the
																dotted space</p>
															<p class="text-danger" id="signature_error"></p>
															<input type="text" name="save_signature" id="signatureInput"
																placeholder="Or type your name here"
																style="padding: 5px; font-size: 14px; width: 300px;">
															<div
																class="button-group d-flex justify-content-between align-items-center ">

																<p class="mb-0 pdf_signed_count_two">Signed Documents:
																	0/1</p>

																<button class="save" id="saveButton" data-id="1">Accept
																	add Sign <i class="fa fa-check"
																		aria-hidden="true"></i>
																</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="side_panel">
											<div class="sidebar-panel">
												<div class="billing-section summary_sidebar">
													<div class="billing-period">
														<label for="billing-period">Billing Period</label>
														<p class="prd_val"></p>
													</div>
													<div class="quantity-section">
														<label>Quantity</label>
														<p class="qty_val"></p>
													</div>
												</div>
												<div class="summary-section">
													<h4>Order Summary</h4>
													<div class="summary-item"></div>
												</div>
												<div class="modifications-section all-modifications-section"></div>
												<div class="payment-section mb-0">
													<div class="payment-details">
														<div>
															<span class="summary-list-item-label">First Payment</span>
															<span
																class="summary-list-item-price format-price total-price"></span>
														</div>
														<div>
															<span class="summary-list-item-label perioud_cost">Monthly
																Cost</span>
															<span
																class="summary-list-item-price format-price order-subtotal-price"></span>
														</div>
														
													</div>
													<div class="btn_wrapper">
													<button class="btn-summary custom-btn" id="checkout_next" disabled>PROCEED TO
														CHECKOUT</button>
														</div>
													
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<input type="button" name="next" class="next action-button d-none" id="click_checkout_next"
								value="PROCEED TO CHECKOUT" />
							<input type="button" name="previous" class="previous action-button-previous"
								id="click_checkout_pre" value="Previous" />
						</fieldset>


						<fieldset>
							<div class="form-card">
								<div class="login_step">
									<div class="login-box">
										<div
											class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
											<h2 class="mb-0">SIGN IN</h2>
											<p class="mb-0">Don't have an account? <a href="#"
													class="create-account">Create an account</a></p>
										</div>
										<form id="loginform" novalidate>
											<input type="hidden" class="login_forder">
											<div class="form-group">
												<label for="email">Email <span>*</span></label>
												<input type="email" name="logemail" id="logemail" class="form-control"
													placeholder="Enter your email" required>
												<div class="invalid-feedback">
													Please provide a valid email address.
												</div>
											</div>
											<div class="form-group">
												<label for="password">Password <span>*</span></label>
												<input type="password" name="logpassword" id="logpassword"
													class="form-control" placeholder="Enter your password" required>
												<div class="invalid-feedback">
													Please provide a Password.
												</div>
											</div>
											<div class="form-group">
												<span id="loginAuthError" class="error-msg login-error disp-none">Your
													email and password was not found.</span>
											</div>
											<div class="form-group">
												<span id="multiAcctError"
													class="error-msg login-error disp-none">Multiple accounts found,
													please contact support.</span>
											</div>
											<div class="form-group">
												<p class="spinme"></p>
											</div>
											<button class="login-button" id="login-button">SIGN IN</button>
										</form>
										<a href="#" class="forgot-password">Forgot password?</a>
									</div>

									<!-- Forgot password -->
									<div class="forgot-sec">
										<div
											class="d-flex justify-content-between align-items-center mb-3  border-bottom forgot-header">
											<h2 class="mb-0">Retrieve Your Password</h2>
										</div>
										<form id="forgotpassword" novalidate>
											<div class="form-group">
												<label for="email">Email <span>*</span></label>
												<input type="email" name="forgot-email" class="form-control"
													id="forgot-email" placeholder="Enter your email" required>
												<div class="invalid-feedback">
													Please provide a valid email address.
												</div>
											</div>
											<button class="send-forgot-button" id="">RESET PASSWORD</button>
											<span class="forgot-spinme"></span>
											<div class="sign-check send-forgot-success send-forgot-result"
												style="display:none; margin-top: 10px;">
												Instructions to reset your password have been send to the requested
												email if it exists in our system.
											</div>
											<div
												class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top extra-links">
												<a href="" class="login-link">Login</a>
												<!-- <a href="">I have a Reset Code</a> -->
											</div>
										</form>
									</div>
								</div>
								<!-- Forgot password -->

								<div class="signup-container">
									<div class="signup-header">
										<div
											class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
											<h2 class="mb-0">CREATE YOUR ACCOUNT</h2>
											<p class="mb-0">Already have an account?<a href="#"> Sign In</a></p>
										</div>
									</div>
									<form class="signup-form" id="regForm" novalidate>
										<input type="hidden" id="rer_forder">
										<div class="form-group">
											<label for="regEmail">Email <span>*</span></label>
											<input type="email" name="regEmail" id="regEmail" class="form-control"
												placeholder="Enter your email" required>
											<div class="invalid-feedback">
												Please provide a valid email address.
											</div>
										</div>
										<div class="form-row">
											<div class="form-group">
												<label for="regFirst">First Name <span>*</span></label>
												<input type="text" name="regFirst" id="regFirst" class="form-control"
													placeholder="Enter your first name" required>
												<div class="invalid-feedback">
													First name is required.
												</div>
											</div>
											<div class="form-group">
												<label for="regLast">Last Name <span>*</span></label>
												<input type="text" name="regLast" id="regLast" class="form-control"
													placeholder="Enter your last name" required>
												<div class="invalid-feedback">
													Last name is required.
												</div>
											</div>
										</div>
										<div class="form-row">
											<div class="form-group">
												<label for="regPassword">Password <span>*</span></label>
												<input type="password" name="regPassword" id="regPassword"
													class="form-control" placeholder="Enter your password" required>
												<div class="invalid-feedback">
													Password is required.
												</div>
											</div>
											<div class="form-group">
												<label for="regPasswordCnf">Retype Password <span>*</span></label>
												<input type="password" name="regPasswordCnf" id="regPasswordCnf"
													class="form-control" placeholder="Retype your password" required>
												<div class="invalid-feedback">
													Please retype your password.
												</div>
											</div>
										</div>
										<div class="form-row">
											<div class="form-group">
												<label for="regCountry">Country <span>*</span></label>
												<select class="country-select tax-form-data form-control"
													name="regCountry" id="regCountry" required>
													<option value="" disabled="" selected="selected">Select a Country
													</option>
													<option value="CA">Canada</option>
													<option value="US">United States</option>
													<option value="seperator" disabled="">--------</option>
													<option value="AF">Afghanistan</option>
													<option value="AX">Åland Islands</option>
													<option value="AL">Albania</option>
													<option value="DZ">Algeria</option>
													<option value="AS">American Samoa</option>
													<option value="AD">Andorra</option>
													<option value="AO">Angola</option>
													<option value="AI">Anguilla</option>
													<option value="AQ">Antarctica</option>
													<option value="AG">Antigua and Barbuda</option>
													<option value="AR">Argentina</option>
													<option value="AM">Armenia</option>
													<option value="AW">Aruba</option>
													<option value="AU">Australia</option>
													<option value="AT">Austria</option>
													<option value="AZ">Azerbaijan</option>
													<option value="BS">Bahamas</option>
													<option value="BH">Bahrain</option>
													<option value="BD">Bangladesh</option>
													<option value="BB">Barbados</option>
													<option value="BY">Belarus</option>
													<option value="BE">Belgium</option>
													<option value="BZ">Belize</option>
													<option value="BJ">Benin</option>
													<option value="BM">Bermuda</option>
													<option value="BT">Bhutan</option>
													<option value="BO">Bolivia</option>
													<option value="BA">Bosnia and Herzegovina</option>
													<option value="BW">Botswana</option>
													<option value="BV">Bouvet Island</option>
													<option value="BR">Brazil</option>
													<option value="IO">British Indian Ocean Territory</option>
													<option value="BN">Brunei Darussalam</option>
													<option value="BG">Bulgaria</option>
													<option value="BF">Burkina Faso</option>
													<option value="BI">Burundi</option>
													<option value="KH">Cambodia</option>
													<option value="CM">Cameroon</option>
													<option value="CV">Cape Verde</option>
													<option value="KY">Cayman Islands</option>
													<option value="CF">Central African Republic</option>
													<option value="TD">Chad</option>
													<option value="CL">Chile</option>
													<option value="CN">China</option>
													<option value="CX">Christmas Island</option>
													<option value="CC">Cocos (Keeling) Islands</option>
													<option value="CO">Colombia</option>
													<option value="KM">Comoros</option>
													<option value="CG">Congo</option>
													<option value="CD">Congo, The Democratic Republic of The</option>
													<option value="CK">Cook Islands</option>
													<option value="CR">Costa Rica</option>
													<option value="CI">Cote D\'ivoire</option>
													<option value="HR">Croatia</option>
													<option value="CU">Cuba</option>
													<option value="CY">Cyprus</option>
													<option value="CZ">Czech Republic</option>
													<option value="DK">Denmark</option>
													<option value="DJ">Djibouti</option>
													<option value="DM">Dominica</option>
													<option value="DO">Dominican Republic</option>
													<option value="EC">Ecuador</option>
													<option value="EG">Egypt</option>
													<option value="SV">El Salvador</option>
													<option value="GQ">Equatorial Guinea</option>
													<option value="ER">Eritrea</option>
													<option value="EE">Estonia</option>
													<option value="ET">Ethiopia</option>
													<option value="FK">Falkland Islands (Malvinas)</option>
													<option value="FO">Faroe Islands</option>
													<option value="FJ">Fiji</option>
													<option value="FI">Finland</option>
													<option value="FR">France</option>
													<option value="GF">French Guiana</option>
													<option value="PF">French Polynesia</option>
													<option value="TF">French Southern Territories</option>
													<option value="GA">Gabon</option>
													<option value="GM">Gambia</option>
													<option value="GE">Georgia</option>
													<option value="DE">Germany</option>
													<option value="GH">Ghana</option>
													<option value="GI">Gibraltar</option>
													<option value="GR">Greece</option>
													<option value="GL">Greenland</option>
													<option value="GD">Grenada</option>
													<option value="GP">Guadeloupe</option>
													<option value="GU">Guam</option>
													<option value="GT">Guatemala</option>
													<option value="GG">Guernsey</option>
													<option value="GN">Guinea</option>
													<option value="GW">Guinea-bissau</option>
													<option value="GY">Guyana</option>
													<option value="HT">Haiti</option>
													<option value="HM">Heard Island and Mcdonald Islands</option>
													<option value="VA">Holy See (Vatican City State)</option>
													<option value="HN">Honduras</option>
													<option value="HK">Hong Kong</option>
													<option value="HU">Hungary</option>
													<option value="IS">Iceland</option>
													<option value="IN">India</option>
													<option value="ID">Indonesia</option>
													<option value="IR">Iran, Islamic Republic of</option>
													<option value="IQ">Iraq</option>
													<option value="IE">Ireland</option>
													<option value="IM">Isle of Man</option>
													<option value="IL">Israel</option>
													<option value="IT">Italy</option>
													<option value="JM">Jamaica</option>
													<option value="JP">Japan</option>
													<option value="JE">Jersey</option>
													<option value="JO">Jordan</option>
													<option value="KZ">Kazakhstan</option>
													<option value="KE">Kenya</option>
													<option value="KI">Kiribati</option>
													<option value="KP">Korea, Democratic People\'s Republic of</option>
													<option value="KR">Korea, Republic of</option>
													<option value="KW">Kuwait</option>
													<option value="KG">Kyrgyzstan</option>
													<option value="LA">Lao People\'s Democratic Republic</option>
													<option value="LV">Latvia</option>
													<option value="LB">Lebanon</option>
													<option value="LS">Lesotho</option>
													<option value="LR">Liberia</option>
													<option value="LY">Libyan Arab Jamahiriya</option>
													<option value="LI">Liechtenstein</option>
													<option value="LT">Lithuania</option>
													<option value="LU">Luxembourg</option>
													<option value="MO">Macao</option>
													<option value="MK">Macedonia, The Former Yugoslav Republic of
													</option>
													<option value="MG">Madagascar</option>
													<option value="MW">Malawi</option>
													<option value="MY">Malaysia</option>
													<option value="MV">Maldives</option>
													<option value="ML">Mali</option>
													<option value="MT">Malta</option>
													<option value="MH">Marshall Islands</option>
													<option value="MQ">Martinique</option>
													<option value="MR">Mauritania</option>
													<option value="MU">Mauritius</option>
													<option value="YT">Mayotte</option>
													<option value="MX">Mexico</option>
													<option value="FM">Micronesia, Federated States of</option>
													<option value="MD">Moldova, Republic of</option>
													<option value="MC">Monaco</option>
													<option value="MN">Mongolia</option>
													<option value="ME">Montenegro</option>
													<option value="MS">Montserrat</option>
													<option value="MA">Morocco</option>
													<option value="MZ">Mozambique</option>
													<option value="MM">Myanmar</option>
													<option value="NA">Namibia</option>
													<option value="NR">Nauru</option>
													<option value="NP">Nepal</option>
													<option value="NL">Netherlands</option>
													<option value="AN">Netherlands Antilles</option>
													<option value="NC">New Caledonia</option>
													<option value="NZ">New Zealand</option>
													<option value="NI">Nicaragua</option>
													<option value="NE">Niger</option>
													<option value="NG">Nigeria</option>
													<option value="NU">Niue</option>
													<option value="NF">Norfolk Island</option>
													<option value="MP">Northern Mariana Islands</option>
													<option value="NO">Norway</option>
													<option value="OM">Oman</option>
													<option value="PK">Pakistan</option>
													<option value="PW">Palau</option>
													<option value="PS">Palestinian Territory, Occupied</option>
													<option value="PA">Panama</option>
													<option value="PG">Papua New Guinea</option>
													<option value="PY">Paraguay</option>
													<option value="PE">Peru</option>
													<option value="PH">Philippines</option>
													<option value="PN">Pitcairn</option>
													<option value="PL">Poland</option>
													<option value="PT">Portugal</option>
													<option value="PR">Puerto Rico</option>
													<option value="QA">Qatar</option>
													<option value="RE">Reunion</option>
													<option value="RO">Romania</option>
													<option value="RU">Russian Federation</option>
													<option value="RW">Rwanda</option>
													<option value="SH">Saint Helena</option>
													<option value="KN">Saint Kitts and Nevis</option>
													<option value="LC">Saint Lucia</option>
													<option value="PM">Saint Pierre and Miquelon</option>
													<option value="VC">Saint Vincent and The Grenadines</option>
													<option value="WS">Samoa</option>
													<option value="SM">San Marino</option>
													<option value="ST">Sao Tome and Principe</option>
													<option value="SA">Saudi Arabia</option>
													<option value="SN">Senegal</option>
													<option value="RS">Serbia</option>
													<option value="SC">Seychelles</option>
													<option value="SL">Sierra Leone</option>
													<option value="SG">Singapore</option>
													<option value="SK">Slovakia</option>
													<option value="SI">Slovenia</option>
													<option value="SB">Solomon Islands</option>
													<option value="SO">Somalia</option>
													<option value="ZA">South Africa</option>
													<option value="GS">South Georgia and The South Sandwich Islands
													</option>
													<option value="ES">Spain</option>
													<option value="LK">Sri Lanka</option>
													<option value="SD">Sudan</option>
													<option value="SR">Suriname</option>
													<option value="SJ">Svalbard and Jan Mayen</option>
													<option value="SZ">Swaziland</option>
													<option value="SE">Sweden</option>
													<option value="CH">Switzerland</option>
													<option value="SY">Syrian Arab Republic</option>
													<option value="TW">Taiwan, Province of China</option>
													<option value="TJ">Tajikistan</option>
													<option value="TZ">Tanzania, United Republic of</option>
													<option value="TH">Thailand</option>
													<option value="TL">Timor-leste</option>
													<option value="TG">Togo</option>
													<option value="TK">Tokelau</option>
													<option value="TO">Tonga</option>
													<option value="TT">Trinidad and Tobago</option>
													<option value="TN">Tunisia</option>
													<option value="TR">Turkey</option>
													<option value="TM">Turkmenistan</option>
													<option value="TC">Turks and Caicos Islands</option>
													<option value="TV">Tuvalu</option>
													<option value="UG">Uganda</option>
													<option value="UA">Ukraine</option>
													<option value="AE">United Arab Emirates</option>
													<option value="GB">United Kingdom</option>
													<option value="UM">United States Minor Outlying Islands</option>
													<option value="UY">Uruguay</option>
													<option value="UZ">Uzbekistan</option>
													<option value="VU">Vanuatu</option>
													<option value="VE">Venezuela</option>
													<option value="VN">Viet Nam</option>
													<option value="VG">Virgin Islands, British</option>
													<option value="VI">Virgin Islands, U.S.</option>
													<option value="WF">Wallis and Futuna</option>
													<option value="EH">Western Sahara</option>
													<option value="YE">Yemen</option>
													<option value="ZM">Zambia</option>
													<option value="ZW">Zimbabwe</option>
												</select>
												<div class="invalid-feedback">
													Please select a country.
												</div>
											</div>
											<div class="form-group regStateClass">
												<label for="regState">State / Province <span>*</span></label>
												<select name="regState" id="regState"
													class="styledDropdown form-control">
													<option value="">Select a State/Provice</option>
												</select>
												<div class="invalid-feedback">
													Please select a State.
												</div>
											</div>
										</div>
										<div class="form-row">
											<div class="form-group">
												<label for="regCity">City <span>*</span></label>
												<input type="text" name="regCity" id="regCity" class="form-control"
													placeholder="Enter your city" required>
												<div class="invalid-feedback">
													City is required.
												</div>
											</div>
											<div class="form-group">
												<label for="regZip">ZIP / Postal <span>*</span></label>
												<input type="text" name="regZip" id="regZip" class="form-control"
													placeholder="Enter your ZIP or postal code" required>
												<div class="invalid-feedback">
													Postal Code is required.
												</div>
											</div>
										</div>
										<div class="form-row">
											<div class="form-group">
												<label for="regAddress">Address <span>*</span></label>
												<input type="text" name="regAddress" id="regAddress"
													class="form-control" placeholder="Enter your address" required>
												<div class="invalid-feedback">
													Address is required.
												</div>
											</div>
											<div class="form-group">
												<label for="regPhone">Phone <span>*</span></label>
												<input type="tel" name="regPhone" id="regPhone" class="form-control"
													placeholder="Enter your phone number" required>
												<div class="invalid-feedback">
													Phone number is required.
												</div>
											</div>
										</div>
										<div class="form-group">
											<span id="regTakenError" class="error-msg reg-taken-error disp-none">This
												email has already been registered in our system.</span>
										</div>
										<!-- <div class="form-group">
												<span id="regValidError" class="error-msg reg-valid-error disp-none">Please enter a valid email and a password at least 6 characters long.</span>
											</div> -->
										<div class="form-group">
											<span id="regOtherError"
												class="error-msg reg-valid-error-custom disp-none"></span>
										</div>
										<div class="form-group">
											<p class="spinme"></p>
										</div>
										<div class="form-group checkbox-group">
											<input type="checkbox" id="marketing-consent">
											<label for="marketing-consent" class="terms-content">Amanah may use my
												contact data to keep me informed of products, services and
												offerings</label>
										</div>
										<button class="signup-button login-button" id="register-button">SIGN UP</button>
										<p class="disclaimer">
											You may unsubscribe from receiving marketing emails by clicking the
											unsubscribe link in each such email. We promise not to sell, trade or use
											your email for spam. View our <a
												href="https://www.amanah.com/privacy-policy/" target="_blank">Privacy
												Policy</a>.
										</p>
									</form>
								</div>
							</div>
							<input type="button" name="next" class="next action-button" id="go_to_checkout"
								value="Next" />
							<!-- <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> -->
						</fieldset>

						<fieldset>
							<div class="form-card">
								<div class="row">
									<div class="col-lg-9">
										<div class="checkout-form">
											<h3> Checkout</h3>
											<form id="checkout_form">
												<input type="hidden" name="s" value="1" />
												<input type="hidden" name="forder" id="chforder" />
												<input type="hidden" name="pm" id="pm" value="pp" />
												<div class="form-inner-container">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<span>
																	<label>First Name*</label>
																	<input type="text" placeholder="First Name"
																		name="fname" id="fname" required>
																</span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<span>
																	<label>Last Name*</label>
																	<input type="text" placeholder="Last Name"
																		name="lname" id="lname" required>
																</span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<span>
																	<label>Email Address*</label>
																	<input type="text" placeholder="Email Address"
																		name="email" id="chemail" required>
																</span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<span>
																	<label>Phone Number*</label>
																	<input type="text" placeholder="Phone Number"
																		name="phone" id="chphone" required>
																</span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<span>
																	<label>Address*</label>
																	<input type="text" placeholder="Address"
																		name="address" id="chaddress" required>
																</span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<span>
																	<label>City*</label>
																	<input type="text" placeholder="City" name="city"
																		id="chcity" required>
																</span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<span>
																	<label>State/Province</label>
																	<!-- <input type="text" class="disp-inline"
																		placeholder="State" name="state" id="statedropdown"> -->
																	<select name="statedropdown" id="chstate"
																		class="styledDropdown  tax-form-data">
																		<option value="">Select a State/Provice</option>
																		<option style="font-weight:bold;" value=""
																			disabled="">---------- Canada ----------
																		</option>
																		<option value="AB">Alberta</option>
																		<option value="BC">British Columbia</option>
																		<option value="MB">Manitoba</option>
																		<option value="NB">New Brunswick</option>
																		<option value="NF">Newfoundland</option>
																		<option value="NT">Northwest Territories
																		</option>
																		<option value="NS">Nova Scotia</option>
																		<option value="NU">Nunavut</option>
																		<option value="ON">Ontario</option>
																		<option value="PE">Prince Edward Island</option>
																		<option value="QC">Quebec</option>
																		<option value="SK">Saskatchewan</option>
																		<option value="YT">Yukon Territory</option>
																		<option style="font-weight:bold;" value=""
																			disabled="">---------- United States
																			----------
																		</option>
																		<option value="AK">Alaska</option>
																		<option value="AL">Alabama</option>
																		<option value="AR">Arkansas</option>
																		<option value="AZ">Arizona</option>
																		<option value="CA">California</option>
																		<option value="CO">Colorado</option>
																		<option value="CT">Connecticut</option>
																		<option value="DC">District of Columbia</option>
																		<option value="DE">Delaware</option>
																		<option value="FL">Florida</option>
																		<option value="GA">Georgia</option>
																		<option value="HI">Hawaii</option>
																		<option value="IA">Iowa</option>
																		<option value="ID">Idaho</option>
																		<option value="IL">Illinois</option>
																		<option value="IN">Indiana</option>
																		<option value="KS">Kansas</option>
																		<option value="KY">Kentucky</option>
																		<option value="LA">Louisiana</option>
																		<option value="MA">Massachusetts</option>
																		<option value="MD">Maryland</option>
																		<option value="ME">Maine</option>
																		<option value="MI">Michigan</option>
																		<option value="MN">Minnesota</option>
																		<option value="MO">Missouri</option>
																		<option value="MS">Mississippi</option>
																		<option value="MT">Montana</option>
																		<option value="NC">North Carolina</option>
																		<option value="ND">North Dakota</option>
																		<option value="NE">Nebraska</option>
																		<option value="NH">New Hampshire</option>
																		<option value="NJ">New Jersey</option>
																		<option value="NM">New Mexico</option>
																		<option value="NV">Nevada</option>
																		<option value="NY">New York</option>
																		<option value="OH">Ohio</option>
																		<option value="OK">Oklahoma</option>
																		<option value="OR">Oregon</option>
																		<option value="PA">Pennsylvania</option>
																		<option value="PR">Puerto Rico</option>
																		<option value="RI">Rhode Island</option>
																		<option value="SC">South Carolina</option>
																		<option value="SD">South Dakota</option>
																		<option value="TN">Tennessee</option>
																		<option value="TX">Texas</option>
																		<option value="UT">Utah</option>
																		<option value="VA">Virginia</option>
																		<option value="VT">Vermont</option>
																		<option value="WA">Washington</option>
																		<option value="WI">Wisconsin</option>
																		<option value="WV">West Virginia</option>
																		<option value="WY">Wyoming</option>
																	</select>
																</span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<span>
																	<label>Zip Code / Postcode*</label>
																	<input type="text" placeholder="Zip Code / Postcode"
																		name="zip" id="chzip" required>
																</span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<span>
																	<label>Country*</label>
																	<select class="country-select tax-form-data"
																		name="country" id="chcountry" required>
																		<option value="" disabled=""
																			selected="selected">
																			Select a Country</option>
																		<option value="CA">Canada</option>
																		<option value="US">United States</option>
																		<option value="seperator" disabled="">--------
																		</option>
																		<option value="AF">Afghanistan</option>
																		<option value="AX">Åland Islands</option>
																		<option value="AL">Albania</option>
																		<option value="DZ">Algeria</option>
																		<option value="AS">American Samoa</option>
																		<option value="AD">Andorra</option>
																		<option value="AO">Angola</option>
																		<option value="AI">Anguilla</option>
																		<option value="AQ">Antarctica</option>
																		<option value="AG">Antigua and Barbuda</option>
																		<option value="AR">Argentina</option>
																		<option value="AM">Armenia</option>
																		<option value="AW">Aruba</option>
																		<option value="AU">Australia</option>
																		<option value="AT">Austria</option>
																		<option value="AZ">Azerbaijan</option>
																		<option value="BS">Bahamas</option>
																		<option value="BH">Bahrain</option>
																		<option value="BD">Bangladesh</option>
																		<option value="BB">Barbados</option>
																		<option value="BY">Belarus</option>
																		<option value="BE">Belgium</option>
																		<option value="BZ">Belize</option>
																		<option value="BJ">Benin</option>
																		<option value="BM">Bermuda</option>
																		<option value="BT">Bhutan</option>
																		<option value="BO">Bolivia</option>
																		<option value="BA">Bosnia and Herzegovina
																		</option>
																		<option value="BW">Botswana</option>
																		<option value="BV">Bouvet Island</option>
																		<option value="BR">Brazil</option>
																		<option value="IO">British Indian Ocean
																			Territory
																		</option>
																		<option value="BN">Brunei Darussalam</option>
																		<option value="BG">Bulgaria</option>
																		<option value="BF">Burkina Faso</option>
																		<option value="BI">Burundi</option>
																		<option value="KH">Cambodia</option>
																		<option value="CM">Cameroon</option>
																		<option value="CV">Cape Verde</option>
																		<option value="KY">Cayman Islands</option>
																		<option value="CF">Central African Republic
																		</option>
																		<option value="TD">Chad</option>
																		<option value="CL">Chile</option>
																		<option value="CN">China</option>
																		<option value="CX">Christmas Island</option>
																		<option value="CC">Cocos (Keeling) Islands
																		</option>
																		<option value="CO">Colombia</option>
																		<option value="KM">Comoros</option>
																		<option value="CG">Congo</option>
																		<option value="CD">Congo, The Democratic
																			Republic of
																			The</option>
																		<option value="CK">Cook Islands</option>
																		<option value="CR">Costa Rica</option>
																		<option value="CI">Cote D'ivoire</option>
																		<option value="HR">Croatia</option>
																		<option value="CU">Cuba</option>
																		<option value="CY">Cyprus</option>
																		<option value="CZ">Czech Republic</option>
																		<option value="DK">Denmark</option>
																		<option value="DJ">Djibouti</option>
																		<option value="DM">Dominica</option>
																		<option value="DO">Dominican Republic</option>
																		<option value="EC">Ecuador</option>
																		<option value="EG">Egypt</option>
																		<option value="SV">El Salvador</option>
																		<option value="GQ">Equatorial Guinea</option>
																		<option value="ER">Eritrea</option>
																		<option value="EE">Estonia</option>
																		<option value="ET">Ethiopia</option>
																		<option value="FK">Falkland Islands (Malvinas)
																		</option>
																		<option value="FO">Faroe Islands</option>
																		<option value="FJ">Fiji</option>
																		<option value="FI">Finland</option>
																		<option value="FR">France</option>
																		<option value="GF">French Guiana</option>
																		<option value="PF">French Polynesia</option>
																		<option value="TF">French Southern Territories
																		</option>
																		<option value="GA">Gabon</option>
																		<option value="GM">Gambia</option>
																		<option value="GE">Georgia</option>
																		<option value="DE">Germany</option>
																		<option value="GH">Ghana</option>
																		<option value="GI">Gibraltar</option>
																		<option value="GR">Greece</option>
																		<option value="GL">Greenland</option>
																		<option value="GD">Grenada</option>
																		<option value="GP">Guadeloupe</option>
																		<option value="GU">Guam</option>
																		<option value="GT">Guatemala</option>
																		<option value="GG">Guernsey</option>
																		<option value="GN">Guinea</option>
																		<option value="GW">Guinea-bissau</option>
																		<option value="GY">Guyana</option>
																		<option value="HT">Haiti</option>
																		<option value="HM">Heard Island and Mcdonald
																			Islands
																		</option>
																		<option value="VA">Holy See (Vatican City State)
																		</option>
																		<option value="HN">Honduras</option>
																		<option value="HK">Hong Kong</option>
																		<option value="HU">Hungary</option>
																		<option value="IS">Iceland</option>
																		<option value="IN">India</option>
																		<option value="ID">Indonesia</option>
																		<option value="IR">Iran, Islamic Republic of
																		</option>
																		<option value="IQ">Iraq</option>
																		<option value="IE">Ireland</option>
																		<option value="IM">Isle of Man</option>
																		<option value="IL">Israel</option>
																		<option value="IT">Italy</option>
																		<option value="JM">Jamaica</option>
																		<option value="JP">Japan</option>
																		<option value="JE">Jersey</option>
																		<option value="JO">Jordan</option>
																		<option value="KZ">Kazakhstan</option>
																		<option value="KE">Kenya</option>
																		<option value="KI">Kiribati</option>
																		<option value="KP">Korea, Democratic People's
																			Republic of</option>
																		<option value="KR">Korea, Republic of</option>
																		<option value="KW">Kuwait</option>
																		<option value="KG">Kyrgyzstan</option>
																		<option value="LA">Lao People's Democratic
																			Republic
																		</option>
																		<option value="LV">Latvia</option>
																		<option value="LB">Lebanon</option>
																		<option value="LS">Lesotho</option>
																		<option value="LR">Liberia</option>
																		<option value="LY">Libyan Arab Jamahiriya
																		</option>
																		<option value="LI">Liechtenstein</option>
																		<option value="LT">Lithuania</option>
																		<option value="LU">Luxembourg</option>
																		<option value="MO">Macao</option>
																		<option value="MK">Macedonia, The Former
																			Yugoslav
																			Republic of</option>
																		<option value="MG">Madagascar</option>
																		<option value="MW">Malawi</option>
																		<option value="MY">Malaysia</option>
																		<option value="MV">Maldives</option>
																		<option value="ML">Mali</option>
																		<option value="MT">Malta</option>
																		<option value="MH">Marshall Islands</option>
																		<option value="MQ">Martinique</option>
																		<option value="MR">Mauritania</option>
																		<option value="MU">Mauritius</option>
																		<option value="YT">Mayotte</option>
																		<option value="MX">Mexico</option>
																		<option value="FM">Micronesia, Federated States
																			of
																		</option>
																		<option value="MD">Moldova, Republic of</option>
																		<option value="MC">Monaco</option>
																		<option value="MN">Mongolia</option>
																		<option value="ME">Montenegro</option>
																		<option value="MS">Montserrat</option>
																		<option value="MA">Morocco</option>
																		<option value="MZ">Mozambique</option>
																		<option value="MM">Myanmar</option>
																		<option value="NA">Namibia</option>
																		<option value="NR">Nauru</option>
																		<option value="NP">Nepal</option>
																		<option value="NL">Netherlands</option>
																		<option value="AN">Netherlands Antilles</option>
																		<option value="NC">New Caledonia</option>
																		<option value="NZ">New Zealand</option>
																		<option value="NI">Nicaragua</option>
																		<option value="NE">Niger</option>
																		<option value="NG">Nigeria</option>
																		<option value="NU">Niue</option>
																		<option value="NF">Norfolk Island</option>
																		<option value="MP">Northern Mariana Islands
																		</option>
																		<option value="NO">Norway</option>
																		<option value="OM">Oman</option>
																		<option value="PK">Pakistan</option>
																		<option value="PW">Palau</option>
																		<option value="PS">Palestinian Territory,
																			Occupied
																		</option>
																		<option value="PA">Panama</option>
																		<option value="PG">Papua New Guinea</option>
																		<option value="PY">Paraguay</option>
																		<option value="PE">Peru</option>
																		<option value="PH">Philippines</option>
																		<option value="PN">Pitcairn</option>
																		<option value="PL">Poland</option>
																		<option value="PT">Portugal</option>
																		<option value="PR">Puerto Rico</option>
																		<option value="QA">Qatar</option>
																		<option value="RE">Reunion</option>
																		<option value="RO">Romania</option>
																		<option value="RU">Russian Federation</option>
																		<option value="RW">Rwanda</option>
																		<option value="SH">Saint Helena</option>
																		<option value="KN">Saint Kitts and Nevis
																		</option>
																		<option value="LC">Saint Lucia</option>
																		<option value="PM">Saint Pierre and Miquelon
																		</option>
																		<option value="VC">Saint Vincent and The
																			Grenadines
																		</option>
																		<option value="WS">Samoa</option>
																		<option value="SM">San Marino</option>
																		<option value="ST">Sao Tome and Principe
																		</option>
																		<option value="SA">Saudi Arabia</option>
																		<option value="SN">Senegal</option>
																		<option value="RS">Serbia</option>
																		<option value="SC">Seychelles</option>
																		<option value="SL">Sierra Leone</option>
																		<option value="SG">Singapore</option>
																		<option value="SK">Slovakia</option>
																		<option value="SI">Slovenia</option>
																		<option value="SB">Solomon Islands</option>
																		<option value="SO">Somalia</option>
																		<option value="ZA">South Africa</option>
																		<option value="GS">South Georgia and The South
																			Sandwich Islands</option>
																		<option value="ES">Spain</option>
																		<option value="LK">Sri Lanka</option>
																		<option value="SD">Sudan</option>
																		<option value="SR">Suriname</option>
																		<option value="SJ">Svalbard and Jan Mayen
																		</option>
																		<option value="SZ">Swaziland</option>
																		<option value="SE">Sweden</option>
																		<option value="CH">Switzerland</option>
																		<option value="SY">Syrian Arab Republic</option>
																		<option value="TW">Taiwan, Province of China
																		</option>
																		<option value="TJ">Tajikistan</option>
																		<option value="TZ">Tanzania, United Republic of
																		</option>
																		<option value="TH">Thailand</option>
																		<option value="TL">Timor-leste</option>
																		<option value="TG">Togo</option>
																		<option value="TK">Tokelau</option>
																		<option value="TO">Tonga</option>
																		<option value="TT">Trinidad and Tobago</option>
																		<option value="TN">Tunisia</option>
																		<option value="TR">Turkey</option>
																		<option value="TM">Turkmenistan</option>
																		<option value="TC">Turks and Caicos Islands
																		</option>
																		<option value="TV">Tuvalu</option>
																		<option value="UG">Uganda</option>
																		<option value="UA">Ukraine</option>
																		<option value="AE">United Arab Emirates</option>
																		<option value="GB">United Kingdom</option>
																		<option value="UM">United States Minor Outlying
																			Islands</option>
																		<option value="UY">Uruguay</option>
																		<option value="UZ">Uzbekistan</option>
																		<option value="VU">Vanuatu</option>
																		<option value="VE">Venezuela</option>
																		<option value="VN">Viet Nam</option>
																		<option value="VG">Virgin Islands, British
																		</option>
																		<option value="VI">Virgin Islands, U.S.</option>
																		<option value="WF">Wallis and Futuna</option>
																		<option value="EH">Western Sahara</option>
																		<option value="YE">Yemen</option>
																		<option value="ZM">Zambia</option>
																		<option value="ZW">Zimbabwe</option>
																	</select>
																</span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<span>
																	<label>Company Name</label>
																	<input type="text" name="company" id="chcompany"
																		placeholder="Company Name">
																</span>
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<span>
																	<label class="paylabel">&nbsp;</label>
																	<span
																		class="d-flex gap-3 align-items-center payswitchbox">
																		<i class="fa fa-credit-card-alt fa-3x payswitch pay-icon pay-icon-selected"
																			id="cclink" aria-hidden="true"
																			style="background-color: #ba9559;"></i>
																		<img class="payswitch pay-icon paypal-image"
																			id="pplink" aria-hidden="true"
																			src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/PP_logo_h_150x38.png" style="padding:10px">
																	</span>
																</span>
																<span class="form-display-text ppspan disp-none">Review
																	order and pay with PayPal below.</span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<span class="ccspan">
																	<label>Card Number</label>
																	<input type="text" name="ccNum" id="ccNum"
																		class="cc_field" placeholder="Card Number"
																		required onkeyup="validateCardNumber(this)">
																</span>
																<small id="ccNumError" class="text-danger"
																	style="display:none;"></small>

															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<span class="ccspan">
																	<label>Expiry Month</label>
																	<div class="fields-20-20 d-flex gap-3">
																		<span class="ccspan">
																			<input type="text" class="cc_field"
																				name="ccm" placeholder="MM" id="ccm"
																				required onkeyup="validateMonth(this)">
																		</span>
																		<br>


																	</div>
																</span>
																<small id="expiryMonth" class="text-danger"></small>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<span class="ccspan">
																	<label>Expiry Year</label>
																	<input type="text" class="cc_field" name="ccy"
																		placeholder="YY" id="ccy" required
																		onkeyup="validateYear(this)">
																</span><br>
																<small id="expiryYear" class="text-danger"></small>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<span class="ccspan">
																	<label>Card CVV</label>
																	<input type="text" class="cc_field" name="cccvv2"
																		placeholder="Card CVV" id="cccvv2" required
																		onkeyup="validateCVV(this)">
																</span>
																<small id="cvvError" class="text-danger"></small>
															</div>
														</div>
														<div class="col-md-10">
															<div class="form-group"
																style="display: flex; align-items: center;flex-wrap:wrap">
																<div style="margin-right: 10px;">
																	<input type="checkbox" required id="term_condition">
																</div>
																<div>
																	<span>I agree with Amanah's
																		<a href="https://order.amanah.com/tos.html"
																			target="_blank">Term of Service</a>
																	</span>
																</div>
																<div style="width:100%;padding-bottom:10px">
																	<p>
																		<small id="term_condition_error"
																			class="text-danger"
																			style="display:none; margin-left: 5px;"></small>
																	</p>
																</div>
															</div>
														</div>






													</div>

													<div class="checkout-submit">
														<button class="paypal-button disp-none submitButton"
															id="pp-submit">Pay with PayPal</button>

														<button class="sub-order-button submitButton"
															id="sub-order-button">Submit Order</button>
														<!-- <button id="submitButton">Checkout</button> -->
													</div>
												</div>
											</form>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="side_panel">
											<div class="sidebar-panel">
												<div class="billing-section summary_sidebar">
													<div class="billing-period">
														<label for="billing-period">Billing Period</label>
														<p class="prd_val"></p>
													</div>
													<div class="quantity-section">
														<label>Quantity</label>
														<p class="qty_val"></p>
													</div>
												</div>


												<!-- <span class="voucher-disclainer">*Voucher disclaimer specifying details goes here.</span> -->
												<div class="summary-section">
													<h4>Order Summary</h4>
													<div class="summary-item"></div>
												</div>
												<div class="modifications-section all-modifications-section"></div>
												<div class="payment-section">
													<div class="payment-details">
														<div>
															<span class="summary-list-item-label">First Payment</span>
															<span
																class="summary-list-item-price format-price total-price"></span>
														</div>
														<div>
															<span class="summary-list-item-label perioud_cost">Monthly
																Cost</span>
															<span
																class="summary-list-item-price format-price order-subtotal-price"></span>
														</div>
													</div>
													<!-- <button class="btn-summary">PROCEED TO SUMMARY</button> -->
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- </div> -->
							<input type="button" name="next" class="next action-button" id="go_to_final_submit"
								value="Next" />
							<!-- <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> -->
						</fieldset>
						<fieldset>
							<div class="maincontent">
								<div id="final_order_submition"></div>
							</div>

						</fieldset>
					</div>
				</div>
			</div>
		</div>
	</div>

 <!-- footer -->
  <footer>
	<div class="container">
		<div class="d-flex justify-content-between items-align-center">
			<div>
				<p class="text-light mb-0" style="font-size:12px"> &copy; 2025 AMANAH TECH | All Rights Reserved | We are a Canadian Colocation Data Center Company</p>
			</div>
			<div class="footer_links d-flex items-align-center gap-3" style="font-size:13px">
              <a href="https://www.amanah.com/privacy-policy/" class="text-light">Privacy Policy</a>
			  <a href="https://www.amanah.com/acceptable-use-policy" class="text-light">Acceptable Use Policy</a>
			  <a href="https://www.amanah.com/legal-matters" class="text-light">Legal Matters</a>
			  <a href="https://www.amanah.com/service-level-agreement" class="text-light">Service-Level Agreement</a>
			</div>
		</div>
	</div>
  </footer>

	<!-- partial -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="lib/script2.js"></script>
</body>

</html>