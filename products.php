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
<title>Products</title>
<link rel="stylesheet" href="styles.css">
<style>
.bestseller-tag {
    color: gold;
    font-weight: bold;
}
</style>
</head>
<body>
<div class="parent">
  <?php include('sidebar.php'); ?>
  <?php include('header.php'); ?>

    <div class="main-content">
        <div class="form-section">
            <form method="post" action="insert_db.php">
                <input type="text" name="prod_title" placeholder="Title" required>
                <input type="text" name="prod_category" placeholder="Category" required>
                <input type="number" name="prod_price" placeholder="Price" required>
                <input type="number" name="prod_stock" placeholder="Stock" required>
                <textarea name="prod_desc" placeholder="Description"></textarea>
                <button type="submit" name="add_product">Add Product</button>
            </form>
        </div>

<div class="table-section">
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
        <?php
        $q = mysqli_query($conn, "
            SELECT p.prod_id, p.prod_title, p.prod_category, p.prod_price, p.prod_stock,
            (SELECT COUNT(*) FROM best_sellers b WHERE b.prod_id = p.prod_id) AS is_bestseller
            FROM product_list p
        ");

        if ($q) {
            while ($r = mysqli_fetch_row($q)) {
                $isBestseller = ($r[5] > 0);
                $bestsellerTag = $isBestseller ? "<span class='bestseller-tag'>⭐ Bestseller</span>" : "";

                echo "<tr>
                        <td>$r[0]</td>
                        <td>$r[1] $bestsellerTag</td>
                        <td>$r[2]</td>
                        <td>₱$r[3]</td>
                        <td>$r[4]</td>
                        <td>
                            <form method='post' action='insert_db.php' style='display:inline;'>
                                <input type='hidden' name='prod_id' value='$r[0]'>
                                <button name='delete_product'>🗑 Delete</button>
                            </form>";

                if ($isBestseller) {
                    echo "<form method='post' action='insert_db.php' style='display:inline; margin-left:5px;'>
                            <input type='hidden' name='prod_id' value='$r[0]'>
                            <button name='remove_bestseller' style='background:#ff5c5c; color:white;'>❌ Remove Bestseller</button>
                          </form>";
                } else {
                    echo "<form method='post' action='insert_db.php' style='display:inline; margin-left:5px;'>
                            <input type='hidden' name='prod_id' value='$r[0]'>
                            <button name='mark_bestseller' style='background:#ffcc00;'>⭐ Mark as Bestseller</button>
                          </form>";
                }

                echo "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='6'>⚠️ Query failed: " . mysqli_error($conn) . "</td></tr>";
        }
        ?>
    </table>
</div>


    <div class="footer">
        <p>© 2025 MyShop Dashboard</p>
    </div>
</div>
</body>
</html>
