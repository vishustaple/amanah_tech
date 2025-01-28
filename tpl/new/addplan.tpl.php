<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Amanah Tech</title>
	<link rel="stylesheet" type="text/css" href="lib/style1.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
		integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
	<link href='//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'
		type='text/css'>
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

												<h5 class="card_title d-flex justify-content-between">Hardware Configuration <span class="m-0 pe-3 " id="refresh_product_options" style="cursor:pointer">RESET</span></h5>
												
												<?php $firstName = 'first_prd_name';
												$firstPrice = 'first_prd_price';

												foreach ($this->servicePlanData["upgrades"] as $groupID => $groupInfo) {

													// echo"<pre>";print_r($groupInfo); ?>
													<div class="items_list">
														<div class="items_name">
															<h5><?= $groupInfo["pu_name"] ?></h5>
														</div>
														<div
															class="items_config get_all_prd_info set_hard_<?= array_key_first($groupInfo["options"]) ?>">
															<input type="hidden" class="set_val_selected_prd"
																name="pu<?= $groupInfo["options"][array_key_first($groupInfo["options"])]["pu_id"] ?>"
																id="<?= $groupInfo["options"][array_key_first($groupInfo["options"])]["po_id"] ?>"
																value="<?= $groupInfo["options"][array_key_first($groupInfo["options"])]["po_id"] ?>" />
															<h5 class="items_config_title set_prd_name <?= $firstName ?>">
																<?= $groupInfo["options"][array_key_first($groupInfo["options"])]['po_description'] ?>
															</h5>
															<h5 class="items_config_title new_price_data price_data set_price_html<?= $firstPrice ?>"
																data-optId="<?= $groupInfo["options"][array_key_first($groupInfo["options"])]["po_id"] ?>">
																<?= $groupInfo["options"][array_key_first($groupInfo["options"])]["pricing"]["1"]["price"] ?>
																<i class="fa fa-caret-down" aria-hidden="true"></i>
															</h5>
														</div>
														<div class="dropdown_data hidden">
															<ul>
																<?php $firstName = $firstPrice = '';
																$spogId = -1; ?>
																<?php $isFirstLoop = true; ?>
																<?php $isFirstItem = true; ?>
																<?php foreach ($groupInfo["options"] as $optionID => $optionInfo) { ?>
																	<li class="get_hard <?php if ($isFirstItem): ?>selected<?php $isFirstItem = false; ?><?php endif; ?>"
																		data-class_id="<?= array_key_first($groupInfo["options"]) ?>"
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
																				<i class="fa fa-caret-down"
																					aria-hidden="true"></i>
																			</h5>
																		</div>
																	</li>
																<?php } ?>
															</ul>
														</div>
													</div>
												<?php } ?>

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
																<option value="3">Quarterly - SAVE 5%</option>
																<option value="6">Semi-Annually - SAVE 7%</option>
																<option value="12">Annually - SAVE 10%</option>
															</select>
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
														<div class="summary-item"></div>
													</div>
													<div class="modifications-section first-modifications-section">
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
														class="text-light text-uppercase">Reconfigure</a></p>
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
															class="text-white">Back to summary</a></p>
												</div>
											</div>

											<div
												class="doc_step d-flex gap-3 justify-content-between align-items-center ">
												<p>Documents Signed</p>
												<div class="progress_bar"></div>
												<p class="pdf_signed_count">0 / 2</p>
											</div>
											<div class="privacy_policy">
												<section class="legal px-3 py-4">
													<div class="wrap1" id="policy_contant1" data-wrap="1">
														<h2 class="tac text-center">Service Level Agreement</h2>
														<p>This Service Level Agreement (SLA) is a part of any service
															agreement between the Customer and Amanah Tech Inc.
															(“Amanah”).</p>

														<h5>1. Overview</h5>
														<p>The purpose of this Service Level Agreement is to set forth
															the service levels at which Amanah is to provide certain
															Services to the Customer. The customer agrees that the
															remedies set out herein are the sole and exclusive remedy
															for Amanah’s failure to meet a Service Level Guarantee. This
															Service Levels Agreement applies only while the Customer
															accounts are in good standing.</p>

														<h5>2. Service Level Guarantee </h5>
														<p>“Service Level Guarantee” or “SLG” means, with respect to a
															specific Service, a level of performance at which Amanah is
															contractually obligated to deliver the Service to the
															Customer and which, depending on the specific Service
															ordered, is established with reference to one or more of the
															following metrics:</p>
														<p>2.1. Facility Power SLG: Amanah’s monthly SLG for Facility
															Power availability is 99.99%. This SLG applies to the
															delivery of power up to the electrical distribution panel
															provided, however, that the Customer remains solely
															responsible for proper utilization of the supplied power
															circuit, such proper utilization mandating that the power
															circuit not exceed 80% of its rated capacity. Any Service
															interruption that results from a power or environmental
															control failure within the Facility and lasts 4:32 minutes
															(four minutes and thirty-two seconds) in any calendar month
															is a ‘Facility Event’ constituting a failure to achieve this
															Facility Power SLG.</p>

														<p>2.2. Network Services SLG: Amanah guarantees that within each
															calendar month, bandwidth will be available 99.99% of the
															time. Any Service interruption that results from a loss of
															bandwidth and lasts 4:32 minutes (four minutes and
															thirty-two seconds) in any calendar month is a ‘Network
															Event’ constituting a failure to achieve this Network
															Services SLG.</p>

														<h5>3. Credit Requests</h5>
														<p>3.1. Prior to the end of the calendar month in which the
															Facility Event or Network Event occurs, the Customer shall
															be entitled to request a credit equal to one day of total
															monthly Fees for each full hour a Facility Event or Network
															Event continues, up to a maximum equivalent to the number of
															days remaining in the calendar month such Facility Event or
															Network Event initially occurred. Requests for credits must
															be submitted to sales@amanah.com. Upon receipt of the
															Customer’s request for such credit, Amanah shall apply for
															such credit against any amounts payable by the Customer
															under the service agreement in respect of Services delivered
															by Amanah in respect of the following calendar month. Any
															credits to which the Customer is entitled resulting from
															Amanah’s failure to meet its SLG’s in the last calendar
															month during the Initial Term or Renewal Term, as
															applicable, of the Agreement shall be paid out to the
															Customer by Amanah within 30 Business Days of the last day
															of said Initial Term or Renewal Term.</p>

														<h5>4. SLG Exclusions</h5>
														<p>The following periods of time represent exclusions from the
															SLG’s:</p>

														<p>4.1. Periods of scheduled and emergency maintenance and any
															other times that may be specifically agreed to with the
															Customer.</p>
														<p>4.2. Periods of downtime due to denial of service attacks,
															hacker activity or other malicious event or code targeted
															against Amanah or any user of Amanah’s network.</p>
														<p>4.3. Periods of downtime due to the Customer directed and
															requested work.</p>
														<p>4.4. Individual server or network component outages that do
															not impact the overall availability of the Service due to
															redundancy in the design.</p>
														<p>4.5. Standard Maintenance Windows</p>
														<p>Maintenance Windows will be scheduled in advance by Amanah on
															an as-needed basis. In addition, Amanah reserves the right
															to schedule Emergency Maintenance when deemed necessary in
															its sole discretion.</p>


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
																	0/2</p>

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
	<script src="lib/script1.js"></script>
</body>

</html>