<html>
	<head>
		<!-- Declerations -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Amanah Tech</title>



		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet"> 

		<!-- Stylesheets and Libraries -->
		<link rel="stylesheet" type="text/css" href="lib/style.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<link href="https://cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.css" type="text/css" rel="stylesheet" />
		<script src="https://cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<link href='//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
		<script>
		jQuery(document).ready(function(){
			 /*Tabs JS*/
		    /*
		    /Add ID #page-x to all tabs, like #page-1, #page-2, etc...
		    /Associate HTML elements with tabs by adding a class version to them, like: .page-1, .page-2, etc...
		    /For example: When #page-1 is clicked, all elements with .page-1 on it will show up, 
		    /and elements with any other .page-x will disappear. And so forth for #page-2 with .page-2, etc...
		    */
			var pagePrefix = "page-";
		    function getCurrentTabNum(){
		    	return $('.js-tab.active').first().attr('id').substring(5);
		    }
		    function getTabCount(){
		    	return $('.pages .js-tab').length;
		    }
		    function handleTabClick(clickedPageNum) {
		    	if(clickedPageNum != parseInt(getCurrentTabNum())){
			    	var tabsAmt = getTabCount();
			    	var clickedPageId = pagePrefix + clickedPageNum;
			    	var currentPageId = pagePrefix + getCurrentTabNum();
			    	//Make all pages inactive
			        $('.js-tab').each(function(){$(this).removeClass('active');});
			        //Make the clicked page active
			        $('#' + clickedPageId).addClass('active');

			        //Hide all page content
			        for (j = 1; j <= tabsAmt; j++) {
			            $('.' + pagePrefix + j).addClass('disp-none');
			        }

			        //Show the selected page
			        $('.' + clickedPageId).removeClass('disp-none');
			        $('.' + clickedPageId).addClass('disp-block');
		    	}
		    }

		    var tabsAmt = getTabCount();
		    //Hide all tabs
		    for (i = 1; i <= tabsAmt; i++) {
			    $('.' + pagePrefix + i).addClass('disp-none');
			}

			//Always display the first tab on load
			if(tabsAmt>0){
			    $('.' + pagePrefix + '1').addClass('disp-block');
			    $('.' + pagePrefix + '1').removeClass('disp-none');
			    $('#' + pagePrefix + '1').addClass('active');
			}
			//Handle click events for all tabs
			$('.js-tab').click(function(){
		    	var clickedPage = this.id.substring(5);
		    	var clickedPageNum = parseInt(clickedPage);
		    	handleTabClick(clickedPageNum);
			});

			//Form validation
		    $("#regPasswordCnf").on('input',function(){
		        if ($("#regPasswordCnf").val() != $("#regPassword").val()) {
		            $(this)[0].setCustomValidity('Passwords must match.');
		        } else {
		            // input is valid -- reset the error message
		            $(this)[0].setCustomValidity('');
		        }
		    });

		    $(".login-button").click(function(){
		    	var email;
		    	var password;
		    	var passwordCnf;
		    	var method;
		    	var formId;
		    	var firstName = '';
		    	var lastName = '';
		    	var company = '';
		    	var city = '';
		    	var address = '';
		    	var state = '';
		    	var country = '';
		    	var zip = '';
		    	var phone = '';

                console.log($("#regFirst").val());
	            //Set the data based on the form being submitted
		    	if($(this).attr("id")=="login-button"){
		    		email = $("#email").val();
		    		password = $("#password").val();
		    		passwordCnf = $("#password").val();
		    		method="login";
		    		formId = "#loginForm";

		    	} else if($(this).attr("id")=="register-button"){
		    		email = $("#regEmail").val();
		    		password = $("#regPassword").val();
                    passwordCnf = $("#regPasswordCnf").val();
                    firstName = $("#regFirst").val();
                    lastName = $("#regLast").val();
                    company = $("#regCompany").val();
                    city = $("#regCity").val();
                    address = $("#regAddress").val();
                    state = $("#regState").val();
                    country = $("#regCountry").val();
                    zip = $("#regZip").val();
                    phone = $("#regPhone").val();

		    		method="register";
		    		formId = "#regForm";
		    	} 
		    	if (!$(formId)[0].checkValidity || $(formId)[0].checkValidity()) {
		            $(".spinme").html("<i class='fa fa-spinner fa-spin'></i>");
				    $.ajax({
		                url : 'login.php',
		                type : 'POST',
		                data : {
		                	email: email,
		                	password: password,
		                	passwordCnf: passwordCnf,
                            firstName: firstName,
                            lastName: lastName,
                            company: company,
                            city: city,
                            address: address,
                            state: state,
                            country: country,
                            zip: zip,
                            phone: phone,
		                	method: method,
		                	forder: "<?= $this->forder ?>",
		                },
		                dataType:'json',
		                cache:false,
		                success : function(data) {
		            		$(".spinme").html("");
		                	$("#invalidInputErr").addClass("disp-none");
		                	$("#takenEmailError,#regOtherError").addClass("disp-none");
		                	$("#authError").addClass("disp-none");

		                	if(data.error=="none"){
		                		window.location.replace("checkout.php?forder=<?= $this->forder ?>");
		                	} else if(data.error=="validation") {
		                		$("#regValidError").removeClass("disp-none");
		                	} else if(data.error=="taken"){
		                		$("#regTakenError").removeClass("disp-none");
		                	} else if(data.error=="auth"){
		                		$("#loginAuthError").removeClass("disp-none");
		                	} else if(data.error=="multi"){
		                		$("#multiAcctError").removeClass("disp-none");
		                	} else {
								$("#regOtherError").removeClass("disp-none");
								$("#regOtherError").html(data.error)
							}
		                },
		                error : function(request,error)
		                {
		                    alert("Request: "+JSON.stringify(request));
		                }
		            });
					return false;
				} else {
					return true;
				}
		    });
		    $('.send-forgot-button').click(function(){
		        $(".forgot-spinme").html("<i class='fa fa-spinner fa-spin'></i>");
        		$(".send-forgot-button").css("display","none");
		        $(".forgot-spinme").html("<i class='fa fa-spinner fa-spin'></i>");
		        var nonEmptyEmail = "";
		        $( "input[name='forgot-email']" ).each(function(){
		            if($(this).val()!=""){
		                nonEmptyEmail=$(this).val();
		            }
		        });
			    $.ajax({
		            url : 'forgotPass.php',
		            type : 'POST',
		            data : {
		            	email: nonEmptyEmail,
		            },
		            dataType:'json',
		            cache:false,
		            success : function(data) {
		        		$(".forgot-spinme").html("");
		        		$(".send-forgot-success").css("display","block");
		        		$(".forgot-spinme").html("");
		        		$(".send-forgot-cancel").html("Close");
		            },
		            error : function(request,error)
		            {
		                alert("Request: "+JSON.stringify(request));
		            }
		        });
		    });

		    var urlParams = new URLSearchParams(window.location.search);
		    if(urlParams.has('reg')){
		    	handleTabClick(2);
		    }

		    $('#forgot-id').featherlight({
		    	targetAttr:'href',
		    	persist : true
		    });
		});
		</script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<link href='//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css' rel='stylesheet' type='text/css'>


		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet"> 
	</head>

	<body>
		<header>
			<img src="img/single-logo.png" />
		</header>

		<div class="maincontent">

			<div class="login-register-form">
				<div class="pages">
                    <?php if(!isset($_REQUEST['reg']))
                        echo '
					<a href="javascript:void(0)" class="js-tab" id="page-1"></span> LOGIN</a>';
                     if(isset($_REQUEST['reg']) && $_REQUEST['reg'] == 1)
                         echo '
					<a href="javascript:void(0)" class="js-tab" id="page-2"></span> SIGN UP</a>';
                     ?>
				</div>
				<div class="forms-container">
					<?php if(!isset($_REQUEST['reg']))
					    echo '
						<div class="login-form page-1">
							<form id="loginForm">
								<label>Email Address</label> 
								<input type="email" name="email" id="email" placeholder="Your email address" required /> 

								<label>Password</label> 
								<input type="password" name="password" id="password" placeholder="" pattern=".{6,}" required title="6 characters minimum" /> 

								<button class="login-button" id="login-button">Login</button>

								<button class="forgot-password-button" id="forgot-id" type="button" href="#mylightbox">Forgot Password?</button>

								<span id="loginAuthError" class="login-error disp-none">Your email and password was not found.</span>

								<span id="multiAcctError" class="login-error disp-none">Multiple accounts found, please contact support.</span>

								<p class="spinme"></p>
							</form>

							<div class="lightbox disp-none" id="mylightbox">
								<div class="lightbox-title">
									<h2>Reset Password</h2>
								</div>
								<div class="lightbox-body save-send-forgot">
									<form class="send-forgot-form"> 
										<span class="save-email">
											<label><strong>Email</strong></label> 
											<input type="email" name="forgot-email" placeholder="Email Address" value="" required /> 
										</span>
									</form>
									<div class="sign-check send-forgot-success send-forgot-result" style="display:none; margin-top: 10px;">
										Instructions to reset your password have been send to the requested email if it exists in our system.
									</div>
								</div>
								<div class="lightbox-lower">
									<button class="cancel send-forgot-cancel featherlight-close">Cancel</button>
									<button class="save send-forgot-button">Send</button>
									<span class="forgot-spinme"></span>
								</div>
							</div>
						</div>';

                    if(isset($_REQUEST['reg']) && $_REQUEST['reg'] == 1)
                        echo '
						<div class="register-form page-2">
						<form id="regForm">
                            <label>First Name</label>
                            <input type="text" name="regFirst" id="regFirst" placeholder="Your first name" required />

                            <label>Last Name</label>
                            <input type="text" name="regLast" id="regLast" placeholder="Your last name" required />

                            <label>Company</label>
                            <input type="text" name="regCompany" id="regCompany" placeholder="Your company name" />

                            <label>City</label>
                            <input type="text" name="regCity" id="regCity" placeholder="Your city" />

                            <label>Address</label>
                            <input type="text" name="regAddress" id="regAddress" placeholder="Street address" />

                            <label>Zip</label>
                            <input type="text" name="regZip" id="regZip" placeholder="Zip" />

                            <label>State/Province</label>
                            <select name="regState" id="regState" class="styledDropdown">
                                <option value="">Select a State/Provice</option>
                                <option style="font-weight:bold;" value="" disabled>---------- Canada ----------</option>
                                <option value="AB">Alberta</option>
                                <option value="BC">British Columbia</option>
                                <option value="MB">Manitoba</option>
                                <option value="NB">New Brunswick</option>
                                <option value="NF">Newfoundland</option>
                                <option value="NT">Northwest Territories</option>
                                <option value="NS">Nova Scotia</option>
                                <option value="NU">Nunavut</option>
                                <option value="ON">Ontario</option>
                                <option value="PE">Prince Edward Island</option>
                                <option value="QC">Quebec</option>
                                <option value="SK">Saskatchewan</option>
                                <option value="YT">Yukon Territory</option>
                                <option style="font-weight:bold;" value="" disabled>---------- United States ----------</option>
                                <option value="AK">Alaska</option>
                                <option value="AL">Alabama</option>
                                <option value="AR">Arkansas</option>
                                <option value="AZ"Arizona</option>
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

        					<label>Country*</label>
									<select class="country-select tax-form-data"  name="regCountry" id="regCountry" required oninvalid="this.setCustomValidity(\'Please select a country\')">
										<option value="" disabled="" selected="selected">Select a Country</option>
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


                            <label>Phone</label>
                            <input type="text" name="regPhone" id="regPhone" placeholder="Phone Number" />

                            <label>Email Address</label>
							<input type="email" name="regEmail" id="regEmail" placeholder="Your email address" required /> 

							<label>Password</label> 
							<input type="password" name="regPassword" id="regPassword" placeholder="" pattern=".{6,}" required title="6 characters minimum" /> 

							<label>Confirm Password</label> 
							<input type="password" name="regPasswordCnf" id="regPasswordCnf" placeholder="" pattern=".{6,}" required title="6 characters minimum" />

							<button class="login-button" id="register-button">Sign Up</button> 

							<span id="regTakenError" class="reg-taken-error disp-none">This email has already been registered in our system.</span>
							<span id="regValidError" class="reg-valid-error disp-none">Please enter a valid email and a password at least 6 characters long.</span>
                                                        <span id="regOtherError" class="reg-valid-error-custom disp-none"></span>

							<p class="spinme"></p>

							<span class="agree">By signing up, you agree to our <a href="#">Terms of Service</a></span>
						</form>
						</div>';
                    ?>
				</div>
			</div>
		</div>

	</body>
</html>