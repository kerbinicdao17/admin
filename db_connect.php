<?php
$conn = mysqli_connect("localhost", "root", "", "myshop_db");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
