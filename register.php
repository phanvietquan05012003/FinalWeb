<?php

	$errors = [];
	
	if($_POST) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$repeat_password = $_POST['repeat-password'];
		$user_type = $_POST['user_type'];

		if(empty($name)) {
			$errors['name'] = 'Full Name is required!';
		}
		if(empty($email)) {
			$errors['email'] = 'Email is required!';
		}
		if(empty($password)) {
			$errors['password'] = 'Password is required!';
		}
		if(empty($repeat_password)) {
			$errors['repeat-password'] = 'Repeat-password is required!';
		}
		if($password != $repeat_password) {
			$errors['repeat-password'] = 'Repeat-password not matched!'; 
		}

		if(empty($errors)) {
			include('db/connect-db.php');

			$sql = "INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) 
					VALUES (NULL, '$name', '$email', '$password', '$user_type');";

			$result = @mysqli_query($conn, $sql);

			@mysqli_close($conn);

			header('location: login.php');
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
							<li class="breadcrumb-item active">Register</li>
						</ol>
					</nav>
				</div>
			</div>
		</section>
		<!--=============================================
    =            Register page content         =
    =============================================-->
		<main class="page-section inner-page-sec-padding-bottom">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb--30 mb-lg--0 mx-auto">
						<!-- Login Form s-->
						<form action="" method ="post">
							<div class="login-form">
								<h4 class="login-title">New Customer</h4>
								<p><span class="font-weight-bold">I am a new customer</span></p>
								<div class="row">
									<div class="col-md-12 col-12 mb--15">
										<label for="name">Full Name</label>
										<input class="mb-0 form-control" type="text" id="name" name = 'name'
											placeholder="Enter your full name">
											<?php if (isset($errors['name'])): ?>
												<p class="text-danger"><?php echo $errors['name']; ?></p>
											<?php endif; ?>
									</div>
									<div class="col-12 mb--20">
										<label for="email">Email</label>
										<input class="mb-0 form-control" type="email" id="email" name = 'email' placeholder="Enter Your Email Address Here..">
											<?php if (isset($errors['email'])): ?>
												<p class="text-danger"><?php echo $errors['email']; ?></p>
											<?php endif; ?>
									</div>
									<div class="col-lg-6 mb--20">
										<label for="password">Password</label>
										<input class="mb-0 form-control" type="password" id="password" name = 'password' placeholder="Enter your password">
											<?php if (isset($errors['password'])): ?>
												<p class="text-danger"><?php echo $errors['password']; ?></p>
											<?php endif; ?>
									</div>
									<div class="col-lg-6 mb--20">
										<label for="password">Repeat Password</label>
										<input class="mb-0 form-control" type="password" id="repeat-password" name = 'repeat-password' placeholder="Repeat your password">
											<?php if (isset($errors['repeat-password'])): ?>
												<p class="text-danger"><?php echo $errors['repeat-password']; ?></p>
											<?php endif; ?>
									</div>
									<div class="col-lg-6 mb--20">
										<label for="role">Role</label>
										<select class="mb-0 form-control"  id = "user_type" name = "user_type">
											<option value="user">User</option>
										</select>
									</div>
									<div class="col-md-12">
										<button class="btn btn-outlined">Register</button>
									</div>
								</div>
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