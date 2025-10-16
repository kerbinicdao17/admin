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
  <title>Customers</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="parent">
  <?php include('sidebar.php'); ?>
  <?php include('header.php'); ?>

  <div class="main-content">
    <h2>Customers</h2>
    <div class="grid-boxes">
      <?php
      $q = mysqli_query($conn, "SELECT * FROM customers");
      while ($r = mysqli_fetch_row($q)) {
        echo "
        <div class='card'>
          <img src='img/user.png' alt='Customer'>
          <h3>$r[1]</h3>
          <p>Email: $r[2]</p>
          <p>Joined: $r[3]</p>
        </div>";
      }
      ?>
    </div>
  </div>

  <div class="footer">© 2025 MyShop Dashboard</div>
</div>
</body>
</html>
