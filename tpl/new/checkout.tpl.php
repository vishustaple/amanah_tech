<html>
	<head>
		<!-- Declerations -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Amanah Tech</title>

		<!-- Stylesheets and Libraries -->
		<link rel="stylesheet" type="text/css" href="lib/style.css">
		<link rel="stylesheet" type="text/css" href="lib/checkout.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
		<script>
			var defCountry = "<?= addslashes($this->country) ?>";
			var defState = "<?= addslashes($this->state) ?>";
			var forder = "<?= $this->forder ?>";
		</script>
		<script src="lib/checkout.js"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<link href='//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>

		<link href="https://cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.css" type="text/css" rel="stylesheet" />
		<script src="https://cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>

		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet"> 
	</head>

	<body>
		<header>
			<img src="img/single-logo.png" />
		</header>

		<div class="maincontent checkout-page">
			<div class="pages">
				<a href="addplan.php?forder=<?= $this->forder ?>"><i class="fas fa-pencil-alt"></i></span> Order Review</a>
				<a href="javascript:void(0)" class="active"><i class="far fa-credit-card"></i></span> Checkout</a>
			</div>
			
			<div class="forms-container">
				<div class="checkout-form">
					<h2>Checkout</h2>
						<span class="required-field">* Required Fields</span>
						<form action="checkout.php" method="POST">
							<input type="hidden" name="s" value="1" />
							<input type="hidden" name="forder" value="<?= $this->forder ?>" />
							<input type="hidden" name="pm" id="pm" value="" />
							<div class="form-inner-container">
								<span>
									<label>First Name*</label> 
									<input type="text" placeholder="First Name" name="fname" value="<?= $this->fname ?>" required oninvalid="this.setCustomValidity('Please enter a first name')" />
								</span>

								<span>
									<label>Last Name*</label> 
									<input type="text" placeholder="Last Name" name="lname" value="<?= $this->lname ?>" required oninvalid="this.setCustomValidity('Please enter a last name')" />
								</span>

								<span>
									<label>Email Address*</label> 
									<input type="text" placeholder="Email Address" name="email" value="<?= $this->email ?>" required oninvalid="this.setCustomValidity('Please enter an email address')" /> 
								</span>

								<span>
									<label>Phone Number*</label> 
									<input type="text" placeholder="Phone Number" name="phone" value="<?= $this->phone ?>" required oninvalid="this.setCustomValidity('Please enter a phone number')" />
								</span>

								<span>
									<label>Address*</label>
									<input type="text" placeholder="Address" name="address" value="<?= $this->address ?>" required oninvalid="this.setCustomValidity('Please enter an address')" /> 
								</span>

								<span>
									<label>City*</label> 
									<input type="text" placeholder="City" name="city" id="city"  value="<?= $this->city ?>" required oninvalid="this.setCustomValidity('Please enter a city')" />
								</span>

								<span>
									<label>State/Province</label> 
									<input type="text" class="" placeholder="State" name="state" id="state" value="<?= $this->state ?>" oninvalid="this.setCustomValidity('Please enter a state/Province')" />
									<select name='statedropdown' id="statedropdown" class="styledDropdown disp-none tax-form-data">
										<option value=''>Select a State/Provice</option>
										<option style="font-weight:bold;" value='' value="" disabled>---------- Canada ----------</option>
										<option value='AB'>Alberta</option>
										<option value='BC'>British Columbia</option>
										<option value='MB'>Manitoba</option>
										<option value='NB'>New Brunswick</option>
										<option value='NF'>Newfoundland</option>
										<option value='NT'>Northwest Territories</option>
										<option value='NS'>Nova Scotia</option>
										<option value='NU'>Nunavut</option>
										<option value='ON'>Ontario</option>
										<option value='PE'>Prince Edward Island</option>
										<option value='QC'>Quebec</option>
										<option value='SK'>Saskatchewan</option>
										<option value='YT'>Yukon Territory</option>
										<option style="font-weight:bold;" value="" disabled>---------- United States ----------</option>
										<option value='AK'>Alaska</option>
										<option value='AL'>Alabama</option>
										<option value='AR'>Arkansas</option>
										<option value='AZ'>Arizona</option>
										<option value='CA'>California</option>
										<option value='CO'>Colorado</option>
										<option value='CT'>Connecticut</option>
										<option value='DC'>District of Columbia</option>
										<option value='DE'>Delaware</option>
										<option value='FL'>Florida</option>
										<option value='GA'>Georgia</option>
										<option value='HI'>Hawaii</option>
										<option value='IA'>Iowa</option>
										<option value='ID'>Idaho</option>
										<option value='IL'>Illinois</option>
										<option value='IN'>Indiana</option>
										<option value='KS'>Kansas</option>
										<option value='KY'>Kentucky</option>
										<option value='LA'>Louisiana</option>
										<option value='MA'>Massachusetts</option>
										<option value='MD'>Maryland</option>
										<option value='ME'>Maine</option>
										<option value='MI'>Michigan</option>
										<option value='MN'>Minnesota</option>
										<option value='MO'>Missouri</option>
										<option value='MS'>Mississippi</option>
										<option value='MT'>Montana</option>
										<option value='NC'>North Carolina</option>
										<option value='ND'>North Dakota</option>
										<option value='NE'>Nebraska</option>
										<option value='NH'>New Hampshire</option>
										<option value='NJ'>New Jersey</option>
										<option value='NM'>New Mexico</option>
										<option value='NV'>Nevada</option>
										<option value='NY'>New York</option>
										<option value='OH'>Ohio</option>
										<option value='OK'>Oklahoma</option>
										<option value='OR'>Oregon</option>
										<option value='PA'>Pennsylvania</option>
										<option value='PR'>Puerto Rico</option>
										<option value='RI'>Rhode Island</option>
										<option value='SC'>South Carolina</option>
										<option value='SD'>South Dakota</option>
										<option value='TN'>Tennessee</option>
										<option value='TX'>Texas</option>
										<option value='UT'>Utah</option>
										<option value='VA'>Virginia</option>
										<option value='VT'>Vermont</option>
										<option value='WA'>Washington</option>
										<option value='WI'>Wisconsin</option>
										<option value='WV'>West Virginia</option>
										<option value='WY'>Wyoming</option>
									</select>
								</span>

								<span>
									<label>Zip Code / Postcode*</label> 
									<input type="text" placeholder="Zip Code / Postcode" value="<?= $this->postal ?>" name="zip" required oninvalid="this.setCustomValidity('Please enter a postal code')" />
								</span>

								<span>
									<label>Country*</label> 
									<select class="country-select tax-form-data"  name="country" id="country" required oninvalid="this.setCustomValidity('Please select a country')">
										<option value="" disabled="" selected="selected">Select a Country</option>
										<option value="CA">Canada</option>
										<option value="US">United States</option>
										<option value='seperator' disabled="">--------</option>
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
										<option value="KP">Korea, Democratic People's Republic of</option>
										<option value="KR">Korea, Republic of</option>
										<option value="KW">Kuwait</option>
										<option value="KG">Kyrgyzstan</option>
										<option value="LA">Lao People's Democratic Republic</option>
										<option value="LV">Latvia</option>
										<option value="LB">Lebanon</option>
										<option value="LS">Lesotho</option>
										<option value="LR">Liberia</option>
										<option value="LY">Libyan Arab Jamahiriya</option>
										<option value="LI">Liechtenstein</option>
										<option value="LT">Lithuania</option>
										<option value="LU">Luxembourg</option>
										<option value="MO">Macao</option>
										<option value="MK">Macedonia, The Former Yugoslav Republic of</option>
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
										<option value="GS">South Georgia and The South Sandwich Islands</option>
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
								</span>

								<span>
									<label>Company Name</label> 
									<input type="text" name="company" value="<?= $this->company ?>" placeholder="Company Name" />
								</span>
								

								<span>
									<label class="paylabel">&nbsp;</label> 
									<span class="payswitchbox">
										<i class="fa fa-credit-card-alt fa-3x payswitch pay-icon pay-icon-selected" id="cclink" aria-hidden="true"></i>
										<img class="payswitch pay-icon paypal-image" id="pplink" aria-hidden="true" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/PP_logo_h_150x38.png"></img>
									</span>
								</span>

								<span class="form-display-text ppspan disp-none">Review order and pay with PayPal below.</span>

								<span class="ccspan">
									<label>Card Number</label>
									<input type="text" name="ccNum" id="ccNum" class="cc_field" placeholder="Card Number" required />
								</span>

								<span class="ccspan">
									<label>Expiry Date</label> 
									<div class="fields-50-50">
											<input type="text" class="cc_field"  name="ccm" placeholder="MM" required />
											<input type="text" class="cc_field"  name="ccy" placeholder="YY" required />
									</div>
								</span>

								<span class="ccspan">
									<label>Card CVV</label> 
									<input type="text" class="cc_field"  name="cccvv2" placeholder="Card CVV" required>
								</span>
							</div>

						<div class="form-order-summary">
							<h2>Order Summary</h2>
							<div class="view-server-details-container">
								<a class="view-server-details" href="javascript:void(0)">
									<span class="fos-view">View</span>
									<span class="fos-hide disp-none">Hide</span> 
									Order Details <span class="fos-arrow"><i class="fa fa-angle-double-up"></i></span>
								</a>
							</div>
							<div class="order-review-box">
								<div class="table-wrapper">
									<table cellspacing="0">
										<tbody>
											<tr>
												<td>Service</td>
												<td>Billed</td>
												<td>Qty</td>
												<td>Price</td>
												<td>Total</td>
												<td></td>
											</tr>
											<tr>
												<td><?= $this->title ?></td>
												<td class="format-period"><?= $this->period ?></td>
												<td><?= $this->quantity ?></td>
												<td class="format-price"><?= $this->packPrice ?></td>
												<td class="format-price"><?= $this->packTotal ?></td>
											</tr>
											<?php foreach($this->details as $key=>$upg): ?>
											<tr class="hidden-detail">
												<td><?= $upg["title"] ?></td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td class="format-price"><?= $upg["price"] ?></td>
												<td class="format-price"><?= $upg["price"]*$this->quantity ?></td>
											</tr>
											<?php endforeach; ?>
											<tr class="disp-none tax-item tax-item-ANY">
												<td>
													<span class="tax-item tax-item-ON">Ontario Tax (13%)</span>
													<span class="tax-item tax-item-CA">Canada Tax (6%)</span>
												</td>
												<td class=""></td>
												<td></td>
												<td>
													<span class="tax-item tax-item-ON format-price"><?= $this->packPrice*$this->_TAX_RATE["CAN-ON"] ?></span>
													<span class="tax-item tax-item-CA format-price"><?= $this->packPrice*$this->_TAX_RATE["CAN-REST"] ?></span>
												</td>
												<td>
													<span class="tax-item tax-item-ON format-price"><?= $this->packTotal*$this->_TAX_RATE["CAN-ON"] ?></span>
													<span class="tax-item tax-item-CA format-price"><?= $this->packTotal*$this->_TAX_RATE["CAN-REST"] ?></span>
												</td>
											</tr>

											<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td><b>SETUP</b></td>
												<td><b>SUBTOTAL</b></td>
												<td><b>TOTAL</b></td>
											</tr>
											<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>
													<span class="tax-item tax-item-NONE format-price"><?= $this->totalSetup ?></span>
													<span class="tax-item tax-item-ON format-price"><?= $this->totalSetup*(1+$this->_TAX_RATE["CAN-ON"]) ?></span>
													<span class="tax-item tax-item-CA format-price"><?= $this->totalSetup*(1+$this->_TAX_RATE["CAN-REST"]) ?></span>
												</td>
												<td class="">
													<span class="tax-item tax-item-NONE format-price"><?= $this->subTotal ?></span>
													<span class="tax-item tax-item-ON format-price"><?= $this->packTotal*(1+$this->_TAX_RATE["CAN-ON"]) ?></span>
													<span class="tax-item tax-item-CA format-price"><?= $this->packTotal*(1+$this->_TAX_RATE["CAN-REST"]) ?></span>
												</td>
												<td class="">
													<span class="tax-item tax-item-NONE format-price"><?= $this->total ?></span>
													<span class="tax-item tax-item-ON format-price"><?= $this->total*(1+$this->_TAX_RATE["CAN-ON"]) ?></span>
													<span class="tax-item tax-item-CA format-price"><?= $this->total*(1+$this->_TAX_RATE["CAN-REST"]) ?></span>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>

<!--
						<span class="notice">
							Please note that your first bill period will be prorated to the upcoming 17th.<br />
							After that, an invoice for the full amount will be billed on the 7th of each month, due the 17th. 
						</span>
-->
						<div class="amount-due-final">
							<hr />
							<strong>Amount Due Now: 
								<span class="tax-item tax-item-NONE format-price"><?= $this->total ?></span>
								<span class="tax-item tax-item-ON format-price"><?= $this->total*(1+$this->_TAX_RATE["CAN-ON"]) ?></span>
								<span class="tax-item tax-item-CA format-price"><?= $this->total*(1+$this->_TAX_RATE["CAN-REST"]) ?></span>
							</strong>
							<hr />
							<strong>Amount Due Each Billing Period: 
								<span class="tax-item tax-item-NONE format-price"><?= $this->subTotal ?></span>
								<span class="tax-item tax-item-ON format-price"><?= $this->subTotal*(1+$this->_TAX_RATE["CAN-ON"]) ?></span>
								<span class="tax-item tax-item-CA format-price"><?= $this->subTotal*(1+$this->_TAX_RATE["CAN-REST"]) ?></span>
							</strong>
						</div>

						<label class="terms-agree">
						    * <input type="checkbox" required  />
						    I agree to the Amanah's <a href="https://billing.amanah.com/form/tos.html" target="_blank"  data-featherlight="iframe" data-featherlight-variant="toswidth" >Terms of Service</a>.
						</label>

						<div class="payment-buttons">
							<button class="paypal-button disp-none" id="pp-submit">Pay with PayPal</button>

							<button class="sub-order-button" id="sub-order-button">Submit Order</button>
						</div>

					</form>



					<div class="lightbox disp-none" id="mylightbox1">
						<div class="lightbox-title">
							<h2>Acceptable Use Policy</h2>
						</div>
					</div>
				</div>
			</div>

		</div>

	</body>
</html>