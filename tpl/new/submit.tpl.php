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

			<div class="login-register-form order-summary-box">
				Your order has been submitted. We will contact you shortly with details. <br />
				<strong>Order ID: <?= $this->orderID; ?></strong> <br />
				<strong>Email: <?= $this->email; ?></strong> <br />
				Total Billed: <?php echo "$" . $this->total ?> <br />
				<?php if($this->paypal===true): ?> <br />
					<?php echo  $this->button ?>
				<?php endif; ?>
                <a href="https://www.amanah.com/" class="next-btn tab-btn" >Back</a>
			</div>

		</div>

	</body>
</html>