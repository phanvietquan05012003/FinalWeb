<?php
$id = $_GET['id'];

$user_id = $_GET['user_id'];

include('db/connect-db.php');

// delete
$sql = "DELETE FROM `cart` WHERE `cart`. `id` = $id";
$result = @mysqli_query($conn, $sql);

// close connection
@mysqli_close($conn);

// -- redirect
header('location: cart.php');