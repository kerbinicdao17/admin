<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<?php include("db_connect.php");?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="parent">
  <?php include('sidebar.php'); ?>
  <?php include('header.php'); ?>

  <div class="main-content">
    <h2>Welcome, Admin</h2>

    <div class="grid-boxes">
      <div class="card">
        <img src="img/products.png" alt="Products">
        <h3>Products</h3>
        <?php
        $products = mysqli_query($conn, "SELECT * FROM product_list");
        if ($products) {
          $count = mysqli_num_rows($products);
          echo "<p>$count Items</p>";
        } else {
          echo "<p>0 Items</p>";
        }
        ?>
      </div>

      <div class="card">
        <img src="img/customers.png" alt="Customers">
        <h3>Customers</h3>
        <?php
        $customers = mysqli_query($conn, "SELECT * FROM customers");
        if ($customers) {
          $count = mysqli_num_rows($customers);
          echo "<p>$count Registered</p>";
        } else {
          echo "<p>0 Registered</p>";
        }
        ?>
      </div>

      <div class="card">
        <img src="img/orders.png" alt="Orders">
        <h3>Orders</h3>
        <?php
        $orders = mysqli_query($conn, "SELECT * FROM orders");
        if ($orders) {
          $count = mysqli_num_rows($orders);
          echo "<p>$count Total Orders</p>";
        } else {
          echo "<p>0 Total Orders</p>";
        }
        ?>
      </div>

      <div class="card">
        <img src="img/reports.png" alt="Reports">
        <h3>Revenue</h3>
        <?php
        $revQ = mysqli_query($conn, "SELECT SUM(total_amount) AS total FROM orders");
        if ($revQ) {
          $row = mysqli_fetch_row($revQ);
          echo "<p>₱" . number_format($row[0] ?? 0, 2) . "</p>";
        } else {
          echo "<p>₱0.00</p>";
        }
        ?>
      </div>
    </div>

    <div class="box-section">
      <h2>⭐ Best Sellers</h2>
      <div class="best-sellers-grid">
        <?php
        $query = mysqli_query($conn, "
          SELECT p.prod_title, p.prod_category, p.prod_price, p.prod_stock
          FROM product_list p
          INNER JOIN best_sellers b ON p.prod_id = b.prod_id
        ");

        if ($query && mysqli_num_rows($query) > 0) {
          while ($r = mysqli_fetch_row($query)) {
            echo "
              <div class='best-box'>
                <h3>$r[0]</h3>
                <p><strong>Category:</strong> $r[1]</p>
                <p><strong>Price:</strong> ₱$r[2]</p>
                <p><strong>Stock:</strong> $r[3]</p>
              </div>
            ";
          }
        } else {
          echo "<p>No best sellers yet.</p>";
        }
        ?>
      </div>
    </div>

  </div>
</div>
</body>
</html>
