<?php 
	include('db/connect-db.php');

	session_start();

	$user_id = $_SESSION['user_id'];

	if(!isset($user_id)){
	header('location:login.php');
	}
	
	$sql = "SELECT * FROM `cart` WHERE user_id = $user_id ";

	$sql .= " ORDER BY id DESC ";


	$result = @mysqli_query($conn, $sql);
	
	$cart = mysqli_fetch_all($result, MYSQLI_ASSOC);

	@mysqli_free_result($result);
	
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
							<li class="breadcrumb-item active">Cart</li>
						</ol>
					</nav>
				</div>
			</div>
		</section>
		<!-- Cart Page Start -->
		<main class="cart-page-main-block inner-page-sec-padding-bottom">
			<div class="cart_area cart-area-padding  ">
				<div class="container">
					<div class="page-section-title">
						<h1>Shopping Cart</h1>
					</div>
					<div class="row">
						<div class="col-12">
								<!-- Cart Table -->
								<div class="cart-table table-responsive mb--40">
									<table class="table">
										<!-- Head Row -->
										<?php if (empty($cart)): ?>
											<p>No data.</p>
										<?php else: ?>
										<thead>
											<tr>
												<th class="pro-remove">Action</th>
												<th class="pro-subtotal">UserID</th>
												<th class="pro-thumbnail">Image</th>
												<th class="pro-title">Name</th>
												<th class="pro-price">Price</th>
												<th class="pro-quantity">Quantity</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($cart as $item) : ?>
											<tr>
												<td class="pro-remove">
													<form class="d-inline" action="cart_delete.php?id=<?php echo $item['id']; ?>" method="POST">
													<button class="far fa-trash-alt" onclick="return confirm('Are you sure?');"></button>
													</form>
												</td>
												<td class="pro-id"><span><?php echo $item['user_id']; ?></span></td>
												<td class="pro-thumbnail"><img
															src="<?php echo $item['image']; ?>"></td>
												<td class="pro-title"><?php echo $item['name']; ?></td>
												<td class="pro-price"><span><?php echo $item['price']; ?>$</span></td>
												<td class="pro-quantity">
													<div class="pro-qty">
														<div class="count-input-block">
															<input type="number" class="form-control text-center"
																value="<?php echo $item['quantity']; ?>">
														</div>
													</div>
												</td>
												<form>

												</form>
											</tr>
											<?php endforeach; ?>
										</tbody>
										<?php endif; ?>
									</table>
								</div>
						</div>
					</div>
					<div class="row">
						<!-- Cart Summary -->
						<div class="col-lg-6 col-12 d-flex mx-auto">
							<div class="cart-summary">
								<div class="cart-summary-button">
									<a href="checkout.php" class="checkout-btn c-btn btn--primary">Checkout</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<!-- Cart Page End -->
	</div>
	<?php include('footer.php'); ?>
	<!-- Use Minified Plugins Version For Fast Page Load -->
	<script src="js/plugins.js"></script>
	<script src="js/ajax-mail.js"></script>
	<script src="js/custom.js"></script>
</body>

</html>