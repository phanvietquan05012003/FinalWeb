<?php 

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}
	include('db/connect-db.php');
	
	$sql = "SELECT * FROM `orders` WHERE user_id = $user_id";
	$result = @mysqli_query($conn, $sql);
	
	$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

	@mysqli_free_result($result);

	@mysqli_close($conn);
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
							<li class="breadcrumb-item active">Orders</li>
						</ol>
					</nav>
				</div>
			</div>
		</section>



		<!-- Code View All Order ở đây  -->
	<div class="page-section inner-page-sec-padding">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="row">
							<!-- My Account Tab Menu Start -->
							<div class="col-lg-3 col-12">
								<div class="myaccount-tab-menu nav" role="tablist">
									<a href="#orders" data-bs-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Orders</a>
								</div>
							</div>
							<!-- My Account Tab Menu End -->
							<!-- My Account Tab Content Start -->
							<div class="col-lg-9 col-12 mt--30 mt-lg--0">
								<div class="tab-content" id="myaccountContent">
									<!-- Single Tab Content Start -->
									<div class="tab-pane fade show active" id="dashboad" role="tabpanel">
										<div class="myaccount-content">
											<h3>Dashboard</h3>
											<div class="welcome mb-20">
												<p>Hello, <strong><?php echo $_SESSION['user_name']; ?></strong></p>
											</div>
											<p class="mb-0">From your account dashboard. you can easily check &amp; view
												your
												recent orders, manage your shipping and billing addresses and edit your
												password and account details.</p>
										</div>
									</div>
									<!-- Single Tab Content End -->
									<!-- Single Tab Content Start -->
									<div class="tab-pane fade" id="orders" role="tabpanel">
										<div class="myaccount-content">
											<h3>Orders</h3>
											<div class="myaccount-table table-responsive text-center">
												<table class="table table-bordered">
													<thead class="thead-light">
														<tr>
															<th>UserID</th>
															<th>Name</th>
															<th >Number</th>
															<th >Email</th>
															<th >Method</th>
															<th >Address</th>
															<th>Status</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach($orders as $order) : ?>
														<tr>
															<td><?php echo $order['user_id']; ?></td>
															<td><?php echo $order['name']; ?></td>
															<td ><?php echo $order['number']; ?></td>
															<td ><?php echo $order['email']; ?></td>
															<td ><?php echo $order['method']; ?></td>
															<td ><?php echo $order['address']; ?></td>
															<td><?php echo $order['payment_status']; ?></td>
														</tr>
														<?php endforeach; ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		
	</div>
	<?php include('footer.php'); ?>
	<!-- Use Minified Plugins Version For Fast Page Load -->
	<script src="js/plugins.js"></script>
	<script src="js/ajax-mail.js"></script>
	<script src="js/custom.js"></script>
</body>

</html>