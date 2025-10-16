<?php
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Dummy hardcoded check (only admin/admin allowed)
    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['user_id'] = 1;
        $_SESSION['full_name'] = 'Administrator';
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid credentials! Use: admin / admin";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - MyShop Admin</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .login-container { max-width: 400px; margin: 100px auto; padding: 40px; background: #fff; border-radius: 12px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
        .login-container h2 { text-align: center; color: #2c3e50; margin-bottom: 20px; }
        .login-container input { width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #d1d5db; border-radius: 8px; box-sizing: border-box; }
        .login-container button { width: 100%; background: #4b5320; color: white; padding: 12px; border: none; border-radius: 8px; cursor: pointer; font-size: 16px; }
        .login-container button:hover { background: #6b705c; }
        .error { color: #e74c3c; text-align: center; margin-bottom: 15px; font-weight: bold; }
        .hint { text-align: center; color: #64748b; font-size: 14px; margin-top: 10px; background: #f8f9fa; padding: 8px; border-radius: 6px; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>MyShop Admin Login</h2>
        <?php if (isset($error)): echo "<p class='error'>$error</p>"; endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username (admin)" required>
            <input type="password" name="password" placeholder="Password (admin)" required>
            <button type="submit" name="login">Login</button>
        </form>
        <p class="hint">Use: Username = admin | Password = admin</p>
    </div>
</body>
</html>