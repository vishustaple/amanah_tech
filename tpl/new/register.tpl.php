<html>
	<head>
		<!-- Declerations -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Amanah Tech</title>

		<!-- Stylesheets and Libraries -->
		<link rel="stylesheet" type="text/css" href="lib/style.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="lib/script.js"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<link href='http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css' rel='stylesheet' type='text/css'>


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
					<a href="javascript:void(0)" class="js-tab" id="page-1"></span> LOGIN</a>
					<a href="javascript:void(0)" class="js-tab" id="page-2"></span> SIGN UP</a>
				</div>

				<div class="forms-container">
					<div class="login-form page-1">
						<form>
							<label>Email Address</label> 
							<input type="text" placeholder="Your email address"> 

							<label>Password</label> 
							<input type="password" placeholder=""> 

							<label>OTP Key Pin</label> 
							<input type="text" placeholder="(if required)"> 

							<button class="login-button" disabled="disabled">Login</button> 

							<button class="forgot-password-button">Forgot Password?</button>
						</form>
					</div>


					<div class="register-form page-2">
						<form>
							<label>Email Address</label> 
							<input type="text" placeholder="Your email address"> 

							<label>Password</label> 
							<input type="password" placeholder=""> 

							<label>Confirm Password</label> 
							<input type="password" placeholder=""> 

							<button class="login-button">Sign Up</button> 

							<span class="agree">By signing up, you agree to our <a href="#">Terms of Service</a></span>
						</form>
					</div>
				</div>
			</div>


		</div>

	</body>
</html>