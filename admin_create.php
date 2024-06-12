<?php
session_start();

if(!isset($_SESSION['admin_id'])){
    header('location:login.php');
 }

$errors = [];

if ($_POST) {
    $author = $_POST['author'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    $fileImage = $_FILES['fileImage'];

    if (empty($fileImage['name'])) {
        $errors['fileImage'] = 'Image is required!';
    }

    // if no errors
    if (empty($errors)) {
        // move uploaded file from /tmp to /uploads 
        $image = 'uploads/'.$fileImage['name'];
        move_uploaded_file($fileImage['tmp_name'], $image);

        // connect db
        include('db/connect-db.php');

        // insert into db
        $sql = "INSERT INTO `books` (`id`, `author`, `name`, `price`, `image`) 
                VALUES (NULL, '$author', '$name', '$price', '$image');";

        $result = @mysqli_query($conn, $sql);
        // expected always successful
        
        // close connection
        @mysqli_close($conn);

        // redirect to view all books
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
                            <li class="breadcrumb-item active">Add Book</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>

        <!-- code CRUD book -->
    <div class = "container">
    <h1>Add new Book</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="form-label" for="author">Author</label>
            <input class="form-control" type="text" name="author" id="author">
        </div>
        <div class="form-group">
            <label class="form-label" for="name">Name</label>
            <input class="form-control" type="text" name="name" id="name">
        </div>
        <div class="form-group">
            <label class="form-label" for="price">Price</label>
            <input class="form-control" type="text" name="price" id="price">
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
            </br>
    <?php include('footer.php'); ?>
    <!-- Use Minified Plugins Version For Fast Page Load -->
    <script src="js/plugins.js"></script>
    <script src="js/ajax-mail.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>