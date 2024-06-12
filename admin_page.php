<?php
session_start();

$user_id = $_SESSION['admin_id'];

if(!isset($user_id)){
    header('location:login.php');
 }
// connect db
include('db/connect-db.php');

// query all books
$sql = "SELECT * FROM `books` WHERE 1";

$name = '';
$author = '';

if(isset($_GET["name"])) {
    $name = $_GET['name'];

    $sql .= " AND name LIKE '%$name%' ";
}

if(isset($_GET["author"])) {
    $author = $_GET['author'];

    $sql .= " AND author LIKE '%$author%' ";
}

$sql .= " ORDER BY id DESC ";

$result = @mysqli_query($conn, $sql);

// process results
$books = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
                            <li class="breadcrumb-item active">Index</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>

        <!-- code CRUD book -->
        <!--=================================
        Home Slider Tab
        ===================================== -->
        <section class="section-padding">
            <h2 class="sr-only">Home Tab Slider Section</h2>
            <div class="container">
                <form action ="" method = "get">
                    <div class = "row my-3">
                        <div class = "col-3">
                            <input class = "form-control" type = "text" name = "name" placeholder ="Enter book name" value ="<?php echo $name; ?>">
                        </div>
                        <div class = "col-3">
                            <input class = "form-control" type = "text" name = "author" placeholder ="Author" value ="<?php echo $author; ?>">
                        </div>
                        <div class = "col-3">
                            <button class = "btn btn-primary" type = "submit">Filter</button>
                        </div>
                    </div>
                </form>
                                        <?php if (empty($books)): ?>
											<p>No data.</p>
										<?php else: ?>
                <div class="sb-custom-tab">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane show active" id="shop" role="tabpanel" aria-labelledby="shop-tab">
                            <div class="product-slider multiple-row  slider-border-multiple-row  sb-slick-slider"
                                data-slick-setting='{
                            "autoplay": true,
                            "autoplaySpeed": 8000,
                            "slidesToShow": 5,
                            "rows":2,
                            "dots":true
                        }' data-slick-responsive='[
                            {"breakpoint":1200, "settings": {"slidesToShow": 3} },
                            {"breakpoint":768, "settings": {"slidesToShow": 2} },
                            {"breakpoint":480, "settings": {"slidesToShow": 1} },
                            {"breakpoint":320, "settings": {"slidesToShow": 1} }
                        ]'>

                        
                        <?php foreach($books as $book) : ?>
                                <div class="single-slide">
                                    <div class="product-card">
                                        <div class="product-header">
                                            <a href="#" class="author">
                                                <?php echo $book['author']; ?>
                                            </a>
                                            <h3><a href="#"><?php echo $book['name']; ?></a></h3>
                                        </div>
                                        <div class="product-card--body">
                                            <div class="card-image">
                                                <img src="<?php echo $book['image']; ?>" alt="">
                                            </div>
                                            <div class="price-block">
                                                <span class="price">Price: <?php echo $book['price']; ?>$</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php endforeach; ?>
                        
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>
    </div>
    <?php include('footer.php'); ?>
    <!-- Use Minified Plugins Version For Fast Page Load -->
    <script src="js/plugins.js"></script>
    <script src="js/ajax-mail.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>