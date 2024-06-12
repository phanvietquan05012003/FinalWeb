<?php
session_start();

$user_id = $_SESSION['admin_id'];

if(!isset($user_id)){
    header('location:login.php');
 }

$errors = [];
// -- get car id
$id = $_GET['id'];

// connect db
include('db/connect-db.php');

// query car by id
$sql = "SELECT * FROM orders WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

// process results
$order = mysqli_fetch_assoc($result);
// print_r($car);

// free result IF SELECT
mysqli_free_result($result);
// close connection
mysqli_close($conn);

// -- handle submit
if ($_POST) {
    // -- get user data
    $payment_status = $_POST['payment_status'];

    if(empty($errors)) {
    include('db/connect-db.php');

    // update into db
    $sql = "UPDATE `orders` 
            SET  `payment_status` = '$payment_status' 
            WHERE `orders`.`id` = $id;";

    $result = @mysqli_query($conn, $sql);
    // expected always successful

    // close connection
    @mysqli_close($conn);

    // redirect to view all cars
    header('location: admin_orders.php');
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
        <?php include('admin_header.php'); ?>
        <section class="breadcrumb-section">
            <h2 class="sr-only">Site Breadcrumb</h2>
            <div class="container">
                <div class="breadcrumb-contents">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin_books.php">Home</a></li>
                            <li class="breadcrumb-item active">Edit Books</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>

        <!-- code CRUD book -->
    <div class = "container">
    <h1>Update Order</h1>

    <form action="" method="post">
        <div class="form-group">
            <label class="form-label" for="payment_status">Payment Status</label>
            <select class="mb-0 form-control"  id = "payment_status" name = "payment_status">
				<option value="pending">pending</option>
                <option value="completed">completed</option>
			</select>
        </div>
        <button class="btn btn-outlined">Save</button>
    </form>
    </div>
    </div>
    </br>
    <?php include('footer.php'); ?>
    <!-- Use Minified Plugins Version For Fast Page Load -->
    <script src="js/plugins.js"></script>
    <script src="js/ajax-mail.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>