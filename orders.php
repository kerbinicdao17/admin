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
  <title>Orders</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="parent">
  <?php include('sidebar.php'); ?>
  <?php include('header.php'); ?>

  <div class="main-content">
    <h2>Orders</h2>
    <div class="grid-boxes">
      <?php
      $q = mysqli_query($conn, "SELECT * FROM orders");
      while ($r = mysqli_fetch_row($q)) {
        echo "
        <div class='card'>
          <img src='img/orderbox.png' alt='Order'>
          <h3>Order #$r[0]</h3>
          <p>Customer: $r[1]</p>
          <p>Total: ₱$r[2]</p>
          <p>Status: $r[3]</p>
        </div>";
      }
      ?>
    </div>
  </div>

  <div class="footer">© 2025 MyShop Dashboard</div>
</div>
</body>
</html>
