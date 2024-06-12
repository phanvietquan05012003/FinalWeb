<?php
// connect db
include('db/connect-db.php');
session_start();

$user_id = $_SESSION['admin_id'];

if(!isset($user_id)){
    header('location:login.php');
 }

// query all books
$sql = "SELECT * FROM `orders`";
$result = @mysqli_query($conn, $sql);

// process results
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
                            <li class="breadcrumb-item active">Orders</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>

        <!-- code orders orders -->
        <main class="cart-page-main-block inner-page-sec-padding-bottom">
			<div class="cart_area cart-area-padding  ">
				<div class="container">
					<div class="page-section-title">
						<h1>All Orders</h1>
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
												<th class="pro-thumbnail">User ID</th>
												<th class="pro-title">Name</th>
												<th class="pro-price">Number</th>
												<th class="pro-quantity">Email</th>
												<th class="pro-subtotal">Address</th>
                                                <th class="pro-subtotal">payment method</th>
                                                <th class="pro-subtotal">payment status</th>
                                                <th class="pro-remove">action</th>
											</tr>
										</thead>

										<tbody>
                                            <?php foreach($orders as $order) : ?>
											<tr>
												<td><?php echo $order['user_id']; ?></td>
                                                <td><?php echo $order['name']; ?></td>
                                                <td><?php echo $order['number']; ?></td>
                                                <td><?php echo $order['email']; ?></td>
                                                <td><?php echo $order['address']; ?></td>
                                                <td><?php echo $order['method']; ?></td>
                                                <td><select class="mb-0 form-control" >
                                                        <option><?php echo $order['payment_status']; ?></option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <a class="btn btn-warning" href="admin_orders_edit.php?id=<?php echo $order['id']; ?>">update</a> | 
                                                    <form class="d-inline" action="admin_orders_delete.php?id=<?php echo $order['id']; ?>" method="POST">
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure?');"
                                                        >Delete</button>
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