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
$sql = "SELECT * FROM books WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

// process results
$book = mysqli_fetch_assoc($result);
// print_r($car);

// free result IF SELECT
mysqli_free_result($result);
// close connection
mysqli_close($conn);

// -- handle submit
if ($_POST) {
    // -- get user data
    $author = $_POST['author'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $fileImage = $_FILES['fileImage'];
    // print_r($fileImage);

    if(empty($errors)) {
        $image = 'uploads/'.$fileImage['name'];
        move_uploaded_file($fileImage['tmp_name'], $image);
    // -- update data
    // connect db
    include('db/connect-db.php');

    // update into db
    $sql = "UPDATE `books` 
            SET `author` = '$author', `name` = '$name', `price` = '$price', `image` = '$image' 
            WHERE `books`.`id` = $id;";

    $result = @mysqli_query($conn, $sql);
    // expected always successful

    // close connection
    @mysqli_close($conn);

    // redirect to view all cars
    header('location: admin_books.php');
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
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>

        <!-- code CRUD book -->
    <div class = "container">
    <h1>Edit Book</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="form-label" for="author">Author</label>
            <input class="form-control" type="text" name="author" id="author" value ="<?php echo $book['author']; ?>">
        </div>
        <div class="form-group">
            <label class="form-label" for="name">Name</label>
            <input class="form-control" type="text" name="name" id="name" value ="<?php echo $book['name']; ?>">
        </div>
        <div class="form-group">
            <label class="form-label" for="price">Price</label>
            <input class="form-control" type="text" name="price" id="price"value ="<?php echo $book['price']; ?>">
        </div>
        <div class="form-group">
            <label class="form-label" for="fileImage">File Image</label>
            <input class="form-control" type="file" name="fileImage" id="fileImage">
            
            <?php if (isset($errors['fileImage'])): ?>
                <p class="text-danger"><?php echo $errors['fileImage']; ?></p>
            <?php endif; ?>

        </div>

        <button class="btn btn-outlined">Save</button>
    </form>
    </div>
    </div>
    <br/>
    <?php include('footer.php'); ?>
    <!-- Use Minified Plugins Version For Fast Page Load -->
    <script src="js/plugins.js"></script>
    <script src="js/ajax-mail.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>