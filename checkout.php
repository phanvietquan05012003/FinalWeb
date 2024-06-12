<?php

include ('db/connect-db.php');

session_start();

$user_id = $_SESSION['user_id'];

$errors = [];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $address = $_POST['address'];

   if(empty($name)) {
	$errors['name'] = 'Name is required!';
	}
	if(empty($email)) {
		$errors['email'] = 'Email is required!';
	}
	if(empty($number)) {
		$errors['number'] = 'Number is required!';
	}
	if(empty($address)) {
		$errors['address'] = 'Address is required!';
	}
	
	if(empty($errors)) {
	$sql= "INSERT INTO `orders`(user_id, name, number, email, method, address) 
		   VALUES('$user_id', '$name', '$number', '$email', '$method', '$address')";
	$result = @mysqli_query($conn, $sql);

	header('location:my-account.php?message=Order successfully!');
	}
}

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Pustok - Book Store HTML Template</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Use Minified Plugins Version For Fast Page Load -->
	<link rel="stylesheet" type="text/css" media="screen" href="css/plugins.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
	<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico">
</head>

<body>
	<div class="site-wrapper" id="top">
	<?php include('users_header.php'); ?>
		<section class="breadcrumb-section">
			<h2 class="sr-only">Site Breadcrumb</h2>
			<div class="container">
				<div class="breadcrumb-contents">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Home</a></li>
							<li class="breadcrumb-item active">Checkout</li>
						</ol>
					</nav>
				</div>
			</div>
		</section>
		<main id="content" class="page-section inner-page-sec-padding-bottom space-db--20">
			<div class="container">
			<?php if (isset($_GET['message'])): ?>
            <p class="text-center">
            <?php echo $_GET['message']; ?>
            </p>
            <?php endif; ?>
				<div class="row">
					<div class="col-12">
						<!-- Checkout Form s-->
						<form action ="" method = "post">
						<div class="checkout-form">
							<div class="row row-40">
								<div class="col-lg-7 mb--20 mx-auto">
									<!-- Billing Address -->
									<div id="billing-form" class="mb-40">
										<h4 class="checkout-title">Billing Address</h4>
										<div class="row">
											<div class="col-md-6 col-12 mb--20">
												<label>Name*</label>
												<input type="text" placeholder="Enter your name" name = 'name'>
												<?php if (isset($errors['name'])): ?>
												<p class="text-danger"><?php echo $errors['name']; ?></p>
												<?php endif; ?>
											</div>
											<div class="col-md-6 col-12 mb--20">
												<label>Number*</label>
												<input type="number" placeholder="Enter your number" name = 'number'>
												<?php if (isset($errors['number'])): ?>
												<p class="text-danger"><?php echo $errors['number']; ?></p>
												<?php endif; ?>
											</div>
											<div class="col-md-6 col-12 mb--20">
												<label>Email*</label>
												<input type="email" placeholder="Enter your email" name = 'email'>
												<?php if (isset($errors['email'])): ?>
												<p class="text-danger"><?php echo $errors['email']; ?></p>
												<?php endif; ?>
											</div>
											<div class="col-12 mb--20">
												<label>Address</label>
												<input type="text" placeholder="Address" name = 'address'>
												<?php if (isset($errors['address'])): ?>
												<p class="text-danger"><?php echo $errors['address']; ?></p>
												<?php endif; ?>
											</div>
											<div class="col-12 col-12 mb--20">
												<label>Payment Method*</label>
												<select class="nice-select" name = 'method'>
													<option value="cash on delivery">Cash on delivery</option>
													<option value="credit card">Credit Card</option>
													<option value="paypal">Paypal</option>
													<option value="paytm">Paytm</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-7 mb--20 mx-auto">
						<input type="submit" value="order now" class="btn btn-outlined" name="order_btn">
						</div>
						</form>
					</div>
				</div>
			</div>
		</main>
	</div>
	<?php include('footer.php'); ?>
	<!-- Use Minified Plugins Version For Fast Page Load -->
	<script src="js/plugins.js"></script>
	<script src="js/ajax-mail.js"></script>
	<script src="js/custom.js"></script>
</body>

</html>