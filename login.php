<?php  
	session_start();

	$errors = [];
	if(!empty($_POST)) {
		$email = $_POST['email'];
		$password = $_POST['password'];

		include('db/connect-db.php');

		$sql = "SELECT * FROM users 
				WHERE email = '$email'";

		$result = mysqli_query($conn, $sql);
		$user = mysqli_fetch_assoc($result);

		mysqli_close($conn);

		if (!$user) {
			$errors['email'] = 'Invalid email!';
		} else {
			if ($user['password'] != $password) {
				$errors['password'] = 'Invalid password!';
			} elseif($user['user_type'] == 'admin') {
				$_SESSION['admin_name'] = $user['name'];
				$_SESSION['admin_email'] = $user['email'];
				$_SESSION['admin_id'] = $user['id'];
				header('location:admin_page.php');
			} elseif($user['user_type'] == 'user') {
				$_SESSION['user_name'] = $user['name'];
				$_SESSION['user_email'] = $user['email'];
				$_SESSION['user_id'] = $user['id'];
				header('location:index.php');
	
			}
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
							<li class="breadcrumb-item active">Login</li>
						</ol>
					</nav>
				</div>
			</div>
		</section>
		<!--=============================================
    =            Login page content         =
    =============================================-->
		<main class="page-section inner-page-sec-padding-bottom">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-6 col-xs-12 mx-auto">
						<form action="" method = "POST">
							<div class="login-form">
								<h4 class="login-title">Returning Customer</h4>
								<p><span class="font-weight-bold">I am a returning customer</span></p>
								<div class="row">
									<div class="col-md-12 col-12 mb--15">
										<label for="email">Enter your email address here...</label>
										<input class="mb-0 form-control" type="email" id="email" name = "email"
											placeholder="Enter you email address here...">

										<?php if (isset($errors['email'])): ?>
											<p class="text-danger"><?php echo $errors['email']; ?></p>
										<?php endif; ?>
									</div>
									<div class="col-12 mb--20">
										<label for="password">Password</label>
										<input class="mb-0 form-control" type="password" id="password" name="password" placeholder="Enter your password">

										<?php if (isset($errors['password'])): ?>
											<p class="text-danger"><?php echo $errors['password']; ?></p>
										<?php endif; ?>
									</div>
									<div class="col-md-12">
										<button class="btn btn-outlined" type="submit">Login</button>
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