<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Amanah Tech</title>
	<link rel="stylesheet" type="text/css" href="lib/style1.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
</head>
<script>
	var priceModelJSON = "<?= addslashes($this->priceJSON) ?>",
	priceObject = JSON.parse(priceModelJSON);
</script>
<body>
	<!-- Page Loader -->
    <div id="loader" class="loader-wrapper" style="display:none;">
        <div class="loader"></div>
    </div>
	<header class="main-header py-4">
		<div class="container">
			<div class="logo">
				<a href="#"><img src="img/single-logo1.png" alt="logo"></a>
			</div>
		</div> 
	</header>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center p-0 mt-3 mb-2">
				<div class="card px-3 pt-4 pb-0 mt-3 mb-3">
					<!-- <form id="msform"> -->
					<form action="changePeriod.php" method="POST" class="" id="orderForm">
						<input type="hidden" name="period" id="period-id" value="1" />
						<input type="hidden" name="quantity" id="quantity" value="1" />
						<input type="hidden" name="coupon" id="coupon" value="" />
						<input type="hidden" name="p" id="p" value="<?= isset($_GET["pid"]) ? $_GET["pid"] : $_FORMIDS[$_GET["form"]][2] ?>" />
						<input type="hidden" name="f" id="f" value="<?= isset($_GET["f"]) ? $_GET["f"] : $_FORMIDS[$_GET["form"]][0] ?>" />
						<input type="hidden" name="q" id="q" value="<?= isset($_GET["q"]) ? $_GET["q"] : $_FORMIDS[$_GET["form"]][1] ?>" />
						<input type="hidden" name="forder" id="forder" value="<?= $_GET["forder"] ?>" />
						<input type="hidden" name="regMethod" id="regMethod" value="login" />
						<input type="hidden" name="ajax" id="ajax" value="yes" />
						<!-- progressbar -->
						<ul id="progressbar">
							<li class="active" id="account"><strong> Select Hardware</strong></li>
							<li id="personal"><strong>Summary</strong></li>
							<li id="payment"><strong>Proceed to Checkout</strong></li>
							<li id="confirm"><strong>Log in</strong></li>
							<li id="checkout_sec"><strong>Checkout</strong></li>
							<li id="complete_sec"><strong>Complete</strong></li>
						</ul>
						<div class="progress">
							<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<br> <!-- fieldsets -->
						<fieldset>
						
							<div class="form-card">
								<div class="row">
									<div class="col-lg-9">
										<div class="card_list">
											
											<h5 class="card_title">Hardware Configuration</h5>
												<?php $firstName = 'first_prd_name';
												$firstPrice = 'first_prd_price';
												foreach($this->servicePlanData["upgrades"] as $groupID=>$groupInfo){ 
													// echo"<pre>";print_r($groupInfo);?>
													<div class="items_list">
														<div class="items_name">
															<h5><?= $groupInfo["pu_name"] ?></h5>
														</div>
														<div class="items_config get_all_prd_info set_hard_<?= array_key_first($groupInfo["options"]) ?>" >
															<input
																type="hidden" 
																class="set_val_selected_prd"
																name="pu<?= $groupInfo["options"][array_key_first($groupInfo["options"])]["pu_id"] ?>"
																id="<?= $groupInfo["options"][array_key_first($groupInfo["options"])]["po_id"] ?>"
																value="<?= $groupInfo["options"][array_key_first($groupInfo["options"])]["po_id"] ?>"
															/>
															<h5 class="items_config_title set_prd_name <?= $firstName ?>">
																<?= $groupInfo["options"][array_key_first($groupInfo["options"])]['pog_name'] ?> 
																<?= $groupInfo["options"][array_key_first($groupInfo["options"])]['po_description'] ?>
															</h5>
															<h5 class="items_config_title price_data set_price_html <?= $firstPrice ?>" data-optId = "<?= $groupInfo["options"][array_key_first($groupInfo["options"])]["po_id"] ?>">
																<?= $groupInfo["options"][array_key_first($groupInfo["options"])]["pricing"]["1"]["price"] ?>
																<i class="fa fa-caret-down" aria-hidden="true"></i>
															</h5>
														</div>
														<div class="dropdown_data hidden">
															<ul>
															<?php $firstName = $firstPrice = ''; $spogId=-1; ?>
															<?php $isFirstLoop=true; ?>
															<?php foreach($groupInfo["options"] as $optionID=>$optionInfo){ ?>
																<li class="get_hard"
																	data-class_id="<?= array_key_first($groupInfo["options"]) ?>" 
																	data-name="pu<?= $optionInfo["pu_id"] ?>"
																	data-id="<?= $optionInfo["po_id"] ?>"
																	data-value="<?= $optionInfo["po_id"] ?>">
																	<div class="items_config">
																		<h5 class="items_config_title get_prd_name">
																			<?php if($optionInfo["pog_id"]!=0){ ?> 
																				<?= $optionInfo["pog_name"] ?> 
																			<?php }?> 
																			<?= $optionInfo['po_description'] ?></h5>
																		<h5 class="items_config_title price_data get_price_html" data-optId = "<?= $optionInfo["po_id"] ?>">
																			<?= $optionInfo["pricing"][1]["price"] ?>
																			<i class="fa fa-caret-down" aria-hidden="true"></i>
																		</h5>
																	</div>
																</li>
															<?php } ?>
															</ul>
														</div>
													</div>
												<?php } ?>
											<!-- </form> -->
										</div>
									</div>
									<div class="col-lg-3">
										<div class="side_panel">
											<div class="sidebar-panel">
												<div class="billing-section">
													<div class="billing-period">
														<label for="billing-period">Billing Period</label>
														<select id="billing-period" class="form-control">
															<option value="1">Monthly</option>
															<option value="3">Quarterly</option>
															<option value="6">Semi-Annually</option>
															<option value="12">Annually</option>
														</select>
													</div>
													<div class="quantity-section">
														<label>Quantity</label>
														<div class="quantity-controls">
															<button class="btn-decrease">-</button>
															<input id="quantity_value" class="ajaxUpdateOrder" type="number" value="1" min="1" readonly />
															<button class="btn-increase">+</button>
														</div>
													</div>
												</div>
												<div class="summary-section">
													<h4>Order Summary</h4>
													<div class="summary-list-item">
														<span class="summary-list-item-label">
															Package Price
														</span>
														<span class="summary-list-item-price format-price package-price"></span>
													</div>

													<div class="summary-list-item">
														<span class="summary-list-item-label">
															Package Setup
														</span>
														<span class="summary-list-item-price format-price package-setup-price"></span>
													</div>
													<div class="summary-item"></div>
												</div>
												<div class="modifications-section first-modifications-section"></div>
												<div class="payment-section">
													<div class="payment-details">
														<div>
															<span class="summary-list-item-label">First Payment</span>
															<span class="summary-list-item-price format-price total-price"></span>
														</div>
														<div>
															<span class="summary-list-item-label perioud_cost">Monthly Cost</span>
															<span class="summary-list-item-price format-price order-subtotal-price"></span>
														</div>
													</div>
													<!-- <button class="btn-summary next" value="Next">PROCEED TO SUMMARY</button> -->
													<!-- <input type="button" name="next" class="next action-button" value="PROCEED TO SUMMARY" /> -->
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<input type="button" name="next" class="next action-button" value="PROCEED TO SUMMARY" />
							<!-- <input type="button" name="next" class="next action-button" value="Next" /> -->
						</fieldset>
						<fieldset>
							<div class="form-card">
								<div class="row">
									<div class="col-lg-9">
									<div class="terms_card">
											<div class="d-flex justify-content-between align-items-center">
												<h5 class="card_title">Order Summary</h5>
												<p class="m-0 pe-3 "><a href="javascript:void(0);" id="" class="text-white text-uppercase">Reconfigure</a></p>
											</div>
											</div>
										<div class="card_list order_hide_title order_summary_title"></div>
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
														<input type="text" name="coupon" id="summaryCoupon" placeholder="Coupon Code">
														<button class="apply_btn coupon-button ajaxUpdateOrder1">Apply</button>
													</div>
													<span class="coupon-msg disp-none">Voucher <span class="coupon-msg-code"></span> applied (<span class="coupon-msg-desc"></span>) <br /> </span>
													<span class="coupon-error disp-none">Coupon Does not Exist.<br /></span>
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
															<span class="summary-list-item-price format-price total-price"></span>
														</div>
														<div>
															<span class="summary-list-item-label perioud_cost">Monthly Cost</span>
															<span class="summary-list-item-price format-price order-subtotal-price"></span>
														</div>
													</div>
													<!-- <button class="btn-summary">PROCEED TO SUMMARY</button> -->
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- <input type="button" name="next" class="next action-button" value="Next" /> -->
							<input type="button" name="next" class="next action-button" value="Proceed to Terms and Policies" />
							<input type="button" name="previous" class="previous action-button-previous" value="Previous" />
						</fieldset>
						<fieldset>
							<div class="form-card">
								<div class="row">
									<div class="col-lg-9">
										<div class="card_list">
											<div class="terms_card">
											<div class="d-flex justify-content-between align-items-center">
												<h5 class="card_title">Terms and Policies</h5>
												<p class="m-0 pe-3 "><a href="javascript:void(0);" id="checkout_pre" class="text-white">Back to summary</a></p>
											</div>
											</div>
											
											<div class="doc_step d-flex gap-3 justify-content-between align-items-center ">
													<p>Documents Signed</p>
													<div class="progress_bar"></div>
													<p class="pdf_signed_count">0 / 2</p>
											</div>
											<div class="privacy_policy">
												<section class="legal px-3 py-4" >
													<div class="wrap1" id="policy_contant1" data-wrap="1">
														<h2 class="tac text-center">Service Level Agreement</h2>
														<p>This Service Level Agreement (SLA) is a part of any service agreement between the Customer and Amanah Tech Inc. (“Amanah”).</p>

														<h5>1. Overview</h5>
														<p>The purpose of this Service Level Agreement is to set forth the service levels at which Amanah is to provide certain Services to the Customer. The customer agrees that the remedies set out herein are the sole and exclusive remedy for Amanah’s failure to meet a Service Level Guarantee. This Service Levels Agreement applies only while the Customer accounts are in good standing.</p>

														<h5>2. Service Level Guarantee	</h5>
														<p>“Service Level Guarantee” or “SLG” means, with respect to a specific Service, a level of performance at which Amanah is contractually obligated to deliver the Service to the Customer and which, depending on the specific Service ordered, is established with reference to one or more of the following metrics:</p>
														<p>2.1. Facility Power SLG: Amanah’s monthly SLG for Facility Power availability is 99.99%. This SLG applies to the delivery of power up to the electrical distribution panel provided, however, that the Customer remains solely responsible for proper utilization of the supplied power circuit, such proper utilization mandating that the power circuit not exceed 80% of its rated capacity. Any Service interruption that results from a power or environmental control failure within the Facility and lasts 4:32 minutes (four minutes and thirty-two seconds) in any calendar month is a ‘Facility Event’ constituting a failure to achieve this Facility Power SLG.</p>

														<p>2.2. Network Services SLG: Amanah guarantees that within each calendar month, bandwidth will be available 99.99% of the time. Any Service interruption that results from a loss of bandwidth and lasts 4:32 minutes (four minutes and thirty-two seconds) in any calendar month is a ‘Network Event’ constituting a failure to achieve this Network Services SLG.</p>

														<h5>3. Credit Requests</h5>
														<p>3.1. Prior to the end of the calendar month in which the Facility Event or Network Event occurs, the Customer shall be entitled to request a credit equal to one day of total monthly Fees for each full hour a Facility Event or Network Event continues, up to a maximum equivalent to the number of days remaining in the calendar month such Facility Event or Network Event initially occurred. Requests for credits must be submitted to sales@amanah.com. Upon receipt of the Customer’s request for such credit, Amanah shall apply for such credit against any amounts payable by the Customer under the service agreement in respect of Services delivered by Amanah in respect of the following calendar month. Any credits to which the Customer is entitled resulting from Amanah’s failure to meet its SLG’s in the last calendar month during the Initial Term or Renewal Term, as applicable, of the Agreement shall be paid out to the Customer by Amanah within 30 Business Days of the last day of said Initial Term or Renewal Term.</p>

														<h5>4. SLG Exclusions</h5>
														<p>The following periods of time represent exclusions from the SLG’s:</p>

														<p>4.1. Periods of scheduled and emergency maintenance and any other times that may be specifically agreed to with the Customer.</p>
														<p>4.2. Periods of downtime due to denial of service attacks, hacker activity or other malicious event or code targeted against Amanah or any user of Amanah’s network.</p>
														<p>4.3. Periods of downtime due to the Customer directed and requested work.</p>
														<p>4.4. Individual server or network component outages that do not impact the overall availability of the Service due to redundancy in the design.</p>
														<p>4.5. Standard Maintenance Windows</p>
														<p>Maintenance Windows will be scheduled in advance by Amanah on an as-needed basis. In addition, Amanah reserves the right to schedule Emergency Maintenance when deemed necessary in its sole discretion.</p>


														<div class="signature1"></div>
													</div>

													<div class="wrap_2" id="policy_contant2" data-wrap="2">

													    <h2 class="tac text-center">Acceptable Use Policy</h2>
													    <p>For the purposes of this Acceptable Use Policy (the “AUP”), the “Customer” is an individual or organization that has entered into a service agreement with Amanah Tech Inc. (hereinafter, “Amanah”) for use of Amanah’s systems and Service. This AUP, including the list of Prohibited Activities (as defined below), is an integral part of each service agreement for services with Amanah. This AUP also applies to Amanah’s operational partners. This Policy was designed to prevent unacceptable uses of Amanah’s systems and Service and to ensure that Amanah is able to provide the level and quality of Service that Amanah’s Customers expect and consistent with its corporate values. Each Amanah Customer is responsible for ensuring that the use of Service provided to such customers complies with this AUP. Failure to comply with this AUP could result in termination of services by Amanah. Amanah reserves the right to modify the AUP at any time, effective upon posting at https://www.amanah.com/legal/AUP/. The continued use of the Amanah Systems and Service after an amended policy has been posted will be deemed as acceptance of the amended policy.</p>

													    <div class="list">
													      <h5>Prohibited Activities of Amanah Systems and Service</h5>
													      <p>1. Transmission, collection, distribution or storage of any material in violation of any applicable law or regulation is strictly prohibited. This includes, without limitation: (i) material protected by copyright, trademark, trade secret or other intellectual property right used without proper authorization, (ii) any activity that disseminates, promotes or facilitates child pornography, materials that involve non-consensual sexual pornography or any other illegal pornographic content, (iii) material that is obscene, defamatory, constitutes an illegal threat, or violates export control laws, (iv) posting any content that threatens, advocates, promotes or otherwise encourages violence or which provides instruction, information or assistance in causing or carrying out such violence; and (v) violating the personal privacy of another individual.</p>

													      <p>2. Sending Unsolicited Bulk Email (“UBE”, “spam”). The sending of any form of Unsolicited Bulk Email through Amanah’s network is prohibited. Likewise, the sending of UBE from another service provider advertising a web site, email address or utilizing any resource hosted on Amanah’s network, is prohibited. Amanah accounts or services may not be used to solicit customers from, or collect replies to, messages sent from another Internet Service Provider where those messages violate this Policy or that of the other provider:</p>

													       <p>3. Running Unconfirmed Mailing Lists. Subscribing email addresses to any mailing list without the express and verifiable permission of the email address owner is prohibited. All mailing lists run by Amanah customers must be Closed-loop (“Confirmed Opt-in”). The subscription confirmation message received from each address owner must be kept on file for the duration of the existence of the mailing list. Purchasing lists of email addresses from 3rd parties for mailing to from any Amanah-hosted domain, or referencing any Amanah account, is prohibited.</p>

													       <p>4. Advertising, transmitting, or otherwise making available any software, program, product, or service that is designed to violate this Policy or the policy of any other Internet Service Provider, which includes, but is not limited to, the facilitation of the means to send Unsolicited Bulk Email, initiation of flooding, phishing attacks, mail-bombing, denial of service attacks.</p>

													       <p>5. Operating an account on behalf of, or in connection with, or reselling any service to, persons or firms listed in the Spamhaus Register of Known Spam Operations (ROKSO) database.</p>
													       
													       <p>6. Unauthorized attempts by a user to gain access to any account or computer resource not belonging to that user (e.g., “cracking”).</p>

													        <p>7. Obtaining or attempting to obtain service by any means or device with the intent to avoid payment.</p>

													         <p>8. Unauthorized access, alteration, destruction, or any attempt thereof, of any information of any Amanah customers or end-users by any means or device.</p>
													         <p>9. Customers are required to responsibly manage hosted content and sub-customers so as to not attract network attacks including Denial of Service (DOS) or Distributed Denial of Service (DDoS) attacks. Customers must take rapid measures to move content to other delivery systems as required. Using Amanah’s Services to interfere with the use of the Amanah network by other customers or authorized users.</p>

													         <p>10. Using Amanah’s Services to host an online pharmacy not certified by the Canadian International Pharmacy Association.</p>

													         <p>11. Installation or distribution of “pirated” or other software products that are not appropriately licensed for use by Customer.</p>

													           <p>12. Actions that restrict or inhibit anyone – whether a Customer of Amanah or otherwise – in his or her use or enjoyment of Amanah’s products and services, or that generate excessive network traffic through the use of automated or manual routines that are not related to ordinary personal or business use of Internet services.</p>
													           <p>13. Executing any form of network monitoring that will intercept data not intended for the Customer.</p>
													           <p>14. Failing to comply with Amanah’s procedures relating to the activities of customers on Amanah-owned facilities.</p>
													           <p>15. Furnishing false or incorrect data on the order form contract (electronic or paper) including fraudulent use of credit card numbers or attempting to circumvent or alter the processes or procedures to measure time, bandwidth utilization or other methods to document “use” of Amanah’s products or services.</p>

													           <h5>Personal Information Protection and Electronic Documents Act Notice</h5>
													           <p>Amanah provides no assurance of confidentiality or privacy of any personal information transmitted through or stored on Amanah’s technology and makes no guarantees as to which entities or users will have access to or be excluded from Amanah’s network. Amanah reserves the right to monitor transmissions over its network for network maintenance, service quality assurance, or any other purpose permitted by the Personal Information Protection and Electronic Documents Act (PIPEDA) or other applicable laws. By using Amanah’s technology, you acknowledge and consent to the collection, use, and disclosure of your personal information as described in our privacy policy.</p>

													            <h5>Customer Responsibility for Customer’s Users</h5>
													           <p>Each Amanah`s Customer is responsible for the activities of its users and, by accepting service from Amanah, is agreeing to ensure that its customers/representatives or end-users abide by this Policy. Amanah’s Customer is solely responsible for use of their account, regardless if such use occurred without the account holder’s consent or knowledge. If Amanah believes, in its sole discretion, that a violation of this AUP (direct, or indirect, including violations by a third party) has occurred, it may take immediate responsive action. Amanah is entitled to remove the offending material, establish immediate or temporary filtering, deny access, isolate and preserve data, suspend or terminate the Amanah Service, engage law enforcement or take any other appropriate action, as determined by Amanah, in addition to any remedies provided by any agreement to provide Amanah Service. Amanah is not responsible for, and shall not be held liable for any damages resultant of any conduct, content, communications, goods and services available on or through Amanah’s systems and services. The failure to enforce this AUP, for whatever reason, shall not be construed as a waiver of any right to do so at any time. If any portion of this Policy is held invalid or unenforceable, that portion will be construed consistent with applicable law as nearly as possible, and the remaining portions will remain in full force and effect. This AUP shall be exclusively governed by, and construed in accordance with the governing law provision set out in the service agreement between Customer and Amanah.</p>

													           <h5>Questions?</h5>
													           <p>If you are unsure of whether any contemplated use or action is permitted, please contact Amanah at <a href="mailto:support@amanah.com">support@amanah.com</a></p>
														<div class="signature2"></div>
													</div>
													
												</section>
											</div>
											<div class="sign_box" >
												<div class="input-container">
													<div class="row">
														
														<div class="col-lg-8">
																<div class="signature-container">
																<canvas id="signaturePad" width="500" height="150"></canvas>
																<div class="button-group">
																	<button class="clear" id="clearButton">Clear</button>
																	<button class="save" id="saveButton" data-id="1" >Save</button>
																</div>
																</div>
														</div>	
														<div class="col-lg-4">
																	<h2>Draw your signature </h2>
																<input type="text"  name="save_signature" id="signatureInput" placeholder="Enter your name" style="padding: 10px; font-size: 16px; width: 300px;">
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
												<div class="payment-section">
													<div class="payment-details">
														<div>
															<span class="summary-list-item-label">First Payment</span>
															<span class="summary-list-item-price format-price total-price"></span>
														</div>
														<div>
															<span class="summary-list-item-label perioud_cost">Monthly Cost</span>
															<span class="summary-list-item-price format-price order-subtotal-price"></span>
														</div>
													</div>
													<button class="btn-summary" id="checkout_next">PROCEED TO CHECKOUT</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<input type="button" name="next" class="next action-button" id="click_checkout_next" value="PROCEED TO CHECKOUT" />
							<input type="button" name="previous" class="previous action-button-previous" id="click_checkout_pre" value="Previous" />
						</fieldset>


						<fieldset>
							<div class="form-card">
								<div class="login_step">
									<div class="login-box">
										<h2>SIGN IN</h2>
										<p>Don't have an account? <a href="#">Create an account</a></p>
										<form id="login-button">
											<label for="email">Email <span>*</span></label>
											<input type="email" name="emails" id="emails" placeholder="Enter your email" required>
											<label for="password">Password <span>*</span></label>
											<input type="password" name="passwords" id="passwords" placeholder="Enter your password" required>
											<span id="loginAuthError" class="login-error disp-none">Your email and password was not found.</span>
											<span id="multiAcctError" class="login-error disp-none">Multiple accounts found, please contact support.</span>
											<p class="spinme"></p>
											<button type="submit" class="login-button">SIGN IN</button>
										</form>
										<a href="#" class="forgot-password">Forgot password?</a>
									</div>

									<div class="signup-container">
										<div class="signup-header">
											<h2>CREATE YOUR ACCOUNT</h2>
											<a href="#">Already have an account? Sign In</a>
										</div>
										<form class="signup-form" id="register-button">
											<div class="form-group">
												<label for="email">Email <span>*</span></label>
												<input type="email" name="email" id="email" placeholder="Enter your email" required>
											</div>
											<div class="form-row">
												<div class="form-group">
													<label for="first-name">First Name <span>*</span></label>
													<input type="text" name="first-name" id="first-name" placeholder="Enter your first name" required>
												</div>
												<div class="form-group">
													<label for="last-name">Last Name <span>*</span></label>
													<input type="text" name="last-name" id="last-name" placeholder="Enter your last name" required>
												</div>
											</div>
											<div class="form-row">
												<div class="form-group">
													<label for="password">Password <span>*</span></label>
													<input type="password" name="password" id="password" placeholder="Enter your password" required>
												</div>
												<div class="form-group">
													<label for="retype-password">Retype Password <span>*</span></label>
													<input type="password" name="retype-password" id="retype-password" placeholder="Retype your password" required>
												</div>
											</div>
											<div class="form-row">
												<div class="form-group">
													<label for="country">Country <span>*</span></label>
													<select id="country" required>
														<option value="" disabled selected>Choose country</option>
														<option value="usa">United States</option>
														<option value="canada">Canada</option>
														<option value="uk">United Kingdom</option>
													</select>
												</div>
												<div class="form-group">
													<label for="state">State / Province <span>*</span></label>
													<input type="text" id="state" placeholder="Enter state or province" required>
												</div>
											</div>
											<div class="form-row">
												<div class="form-group">
													<label for="city">City <span>*</span></label>
													<input type="text" id="city" placeholder="Enter your city" required>
												</div>
												<div class="form-group">
													<label for="zip">ZIP / Postal <span>*</span></label>
													<input type="text" id="zip" placeholder="Enter your ZIP or postal code" required>
												</div>
											</div>
											<div class="form-row">
												<div class="form-group">
													<label for="address">Address <span>*</span></label>
													<input type="text" id="address" placeholder="Enter your address" required>
												</div>
												<div class="form-group">
													<label for="phone">Phone <span>*</span></label>
													<input type="tel" id="phone" placeholder="Enter your phone number" required>
												</div>
											</div>
											<div class="form-group checkbox-group">
												<input type="checkbox" id="marketing-consent">
												<label for="marketing-consent">Amanah may use my contact data to keep me informed of products, services and offerings</label>
											</div>
											<button type="submit" class="signup-button login-button">SIGN UP</button>
											<p class="disclaimer">
												You may unsubscribe from receiving marketing emails by clicking the unsubscribe link in each such email. We promise not to sell, trade or use your email for spam. View our Privacy Policy.
											</p>
										</form>
									</div>
								</div>
							</div>
							<input type="button" name="next" class="next action-button" value="Next" />
							<input type="button" name="previous" class="previous action-button-previous" value="Previous" />
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- partial -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="lib/script1.js"></script>
</body>

</html>