<?php
include("db_connect.php");

// Add Product
if (isset($_POST['add_product'])) {
    $title = $_POST['prod_title'];
    $cat = $_POST['prod_category'];
    $price = $_POST['prod_price'];
    $stock = $_POST['prod_stock'];
    $desc = $_POST['prod_desc'];
    mysqli_query($conn, "INSERT INTO product_list (prod_title, prod_category, prod_price, prod_stock, prod_desc) VALUES ('$title','$cat','$price','$stock','$desc')");
    header("Location: products.php");
    exit;
}

// Delete Product
if (isset($_POST['delete_product'])) {
    $id = $_POST['prod_id'];
    mysqli_query($conn, "DELETE FROM product_list WHERE id='$id'");
    header("Location: products.php");
    exit;
}

// Add Order
if (isset($_POST['add_order'])) {
    $name = $_POST['customer_name'];
    $amount = $_POST['total_amount'];
    $status = $_POST['status'];
    mysqli_query($conn, "INSERT INTO orders (customer_name,total_amount,status) VALUES ('$name','$amount','$status')");
    header("Location: orders.php");
    exit;
}

// Delete Order
if (isset($_POST['delete_order'])) {
    $id = $_POST['order_id'];
    mysqli_query($conn, "DELETE FROM orders WHERE id='$id'");
    header("Location: orders.php");
    exit;
}

// Add Customer
if (isset($_POST['add_customer'])) {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    mysqli_query($conn, "INSERT INTO customers (first_name,last_name,email,phone) VALUES ('$fname','$lname','$email','$phone')");
    header("Location: customers.php");
    exit;
}

// Delete Customer
if (isset($_POST['delete_customer'])) {
    $id = $_POST['customer_id'];
    mysqli_query($conn, "DELETE FROM customers WHERE id='$id'");
    header("Location: customers.php");
    exit;
}

if (isset($_POST['mark_bestseller'])) {
    $id = $_POST['prod_id'];
    // Avoid duplicates
    $check = mysqli_query($conn, "SELECT * FROM best_sellers WHERE prod_id = '$id'");
    if (mysqli_num_rows($check) == 0) {
        mysqli_query($conn, "INSERT INTO best_sellers (prod_id) VALUES ('$id')");
    }
    header("Location: products.php");
    exit();
}

// REMOVE BESTSELLER
if (isset($_POST['remove_bestseller'])) {
    $id = $_POST['prod_id'];
    mysqli_query($conn, "DELETE FROM best_sellers WHERE prod_id = '$id'");
    header("Location: products.php");
    exit();
}

?>
