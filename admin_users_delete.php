<?php
$id = $_GET['id'];

include('db/connect-db.php');

// delete
$sql = "DELETE FROM users WHERE `users`.`id` = $id";
$result = @mysqli_query($conn, $sql);

// close connection
@mysqli_close($conn);

// -- redirect
header('location: admin_users.php');