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

$page = 1;
if(isset($_GET['page'])){
	$page = $_GET['page'];
}
				
$limit = 6;
$offset = ($page -1)*$limit;

$sqlCount =  "SELECT COUNT(*) AS noResults FROM ($sql) AS filteredResults";
$result = mysqli_query($conn, $sqlCount);
$noResults = mysqli_fetch_assoc($result)['noResults'];
$noPages = ceil($noResults / $limit); 

$sql .= " LIMIT  $limit OFFSET $offset ";

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
                            <li class="breadcrumb-item active">Books</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>

        <!-- code CRUD book -->
        <main class="inner-page-sec-padding-bottom">
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

				<div class="shop-product-wrap grid with-pagination row space-db--30 shop-border">

				<?php foreach($books as $book) : ?>
					<div class="col-lg-4 col-sm-6">
						<div class="product-card">
							<div class="product-grid-content">
								<div class="product-header">
									<a href="#" class="author">
										<?php echo $book['author']; ?>
									</a>
									<h3><a href="#"><?php echo $book['name']; ?></a></h3>
								</div>
								<div class="product-card--body">
									<div class="card-image">
										<img src="<?php echo $book['image']; ?>">
									</div>
									<div class="price-block">
										<span class="price">Price: <?php echo $book['price']; ?>$</span>
									</div>
									<div class="product-footer">
									<a class="btn btn-primary" href="admin_edit.php?id=<?php echo $book['id']; ?>">Edit</a> | 
                        
									<form class="d-inline" action="admin_delete.php?id=<?php echo $book['id']; ?>" method="POST">
										<button class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
									</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>

				</div>

				<!-- Pagination Block -->
				<div class="row pt--30">
					<div class="col-md-12">
						<div class="pagination-block">
							<ul class="pagination-btns flex-center">
								<?php if($page > 1) : ?>
								<li><a href="?page=<?php echo $page-1; ?>&name=<?php echo $name; ?>&author=<?php echo $author; ?>" class="single-btn prev-btn "><i class="zmdi zmdi-chevron-left"></i> </a>
								</li>
								<?php endif; ?>
								<?php for($i = 1; $i <= $noPages; $i++): ?>
								<li class="page-link <?php echo $page == $i ? 'active' : ''?>"><a href="?page=<?php echo $i; ?>&name=<?php echo $name; ?>&author=<?php echo $author; ?>" class="single-btn"><?php echo $i ?></a></li>
								<?php endfor; ?>
								<?php if($page < $noPages): ?>
								<li><a href="?page=<?php echo $page+1; ?>&name=<?php echo $name; ?>&author=<?php echo $author; ?>" class="single-btn next-btn"><i class="zmdi zmdi-chevron-right"></i></a>
								</li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>

				<!-- Modal -->
				<div class="modal fade modal-quick-view" id="quickModal" tabindex="-1" role="dialog"
				aria-labelledby="quickModal" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						<div class="product-details-modal">
							<div class="row">
								<div class="col-lg-5">
									<!-- Product Details Slider Big Image-->
									<div class="product-details-slider sb-slick-slider arrow-type-two" data-slick-setting='{
										"slidesToShow": 1,
										"arrows": false,
										"fade": true,
										"draggable": false,
										"swipe": false,
										"asNavFor": ".product-slider-nav"
										}'>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
			<?php endif; ?>
		</main>
    </div>
    <?php include('footer.php'); ?>
    <!-- Use Minified Plugins Version For Fast Page Load -->
    <script src="js/plugins.js"></script>
    <script src="js/ajax-mail.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>