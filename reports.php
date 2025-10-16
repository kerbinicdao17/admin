<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<?php include("db_connect.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reports</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="parent">

  <!-- Sidebar -->
  <?php include('sidebar.php'); ?>
  <?php include('header.php'); ?>

  <!-- Main Content -->
  <div class="main-content">
    <div class="grid-boxes">
      <div class="card">
        <img src="icons/products.png" alt="Products">
        <h3>Total Products</h3>
        <p>
          <?php
            $total_products = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product_list"));
            echo $total_products;
          ?>
        </p>
      </div>

      <div class="card">
        <img src="icons/orders.png" alt="Orders">
        <h3>Total Orders</h3>
        <p>
          <?php
            $total_orders = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM orders"));
            echo $total_orders;
          ?>
        </p>
      </div>

      <div class="card">
        <img src="icons/customers.png" alt="Customers">
        <h3>Total Customers</h3>
        <p>
          <?php
            $total_customers = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM customers"));
            echo $total_customers;
          ?>
        </p>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div class="footer">
    © 2025 MyShop Dashboard
  </div>

</div>
</body>
</html>
