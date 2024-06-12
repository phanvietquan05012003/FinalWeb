<?php
session_start();

$user_id = $_SESSION['admin_id'];

if(!isset($user_id)){
    header('location:login.php');
 }
// connect db
include('db/connect-db.php');

// query all books
$sql = "SELECT * FROM `users`";
$result = @mysqli_query($conn, $sql);

// process results
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result IF SELECT
@mysqli_free_result($result);

// close connection
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
        <?php include('admin_header.php'); ?>
        <section class="breadcrumb-section">
            <h2 class="sr-only">Site Breadcrumb</h2>
            <div class="container">
                <div class="breadcrumb-contents">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin_books.php">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>

        <!-- code CRUD users -->
        <main class="cart-page-main-block inner-page-sec-padding-bottom">
			<div class="cart_area cart-area-padding  ">
				<div class="container">
					<div class="page-section-title">
						<h1>All Users</h1>
					</div>
					<div class="row">
						<div class="col-12">
							<form action="" method="post">
								<!-- Cart Table -->
								<div class="cart-table table-responsive mb--40">
									<table class="table">
										<!-- Head Row -->
										<thead>
											<tr>
												<th class="pro-thumbnail">Name</th>
												<th class="pro-title">Email</th>
												<th class="pro-price">Password</th>
												<th class="pro-quantity">User Type</th>
                                                <th class="pro-remove">action</th>
											</tr>
										</thead>

										<tbody>
                                            <?php foreach($users as $user) : ?>
											<tr>
                                                <td><?php echo $user['name']; ?></td>
                                                <td><?php echo $user['email']; ?></td>
                                                <td><?php echo $user['password']; ?></td>
                                                <td><?php echo $user['user_type']; ?></td>
                                                <td>
                                                    <form class="d-inline" action="admin_users_delete.php?id=<?php echo $user['id']; ?>" method="post">
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure?');"
                                                        >Delete User</button>
                                                    </form>
                                                </td>
											</tr>
                                            <?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</form>
						</div>
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