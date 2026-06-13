<?php

session_start();
// turn auto complete off
// header("Cache-Control: no-store, no-cache, must-revalidate");
// header("Pragma: no-cache");
// header("Expires: 0");

$pdo = require __DIR__ . '/../includes/db.php';
$config = require __DIR__ . '/../includes/config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare(
        "SELECT id, username, password_hash, role
         FROM users
         WHERE username = ?"
    );

    $stmt->execute([$username]);

    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {

        $_SESSION['user'] = [
            'id'       => $user['id'],
            'username' => $user['username'],
            'role'     => $user['role']
        ];

        header('Location: ' . $config['base_url'] . 'admin/dashboard.php');
        exit;
    }

    $message = 'Invalid username or password.';
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login | KILO FLIGHT</title>

    <link rel="stylesheet" href="<?= $config['base_url'] ?>assets/css/style.css">
</head>
<body>

<section class="section">

    <h2>Admin Login</h2>

    
    <?php
      if ($message) {
          echo '<p style="color:#e10600;">';
          echo htmlspecialchars($message);
          echo '</p>';
      }
    ?>

    <form method="post" autocomplete="off" style="max-width:360px; margin-top:24px;">

        <label for="username">Username</label>

        <input
            id="username"
            name="username"
            type="text"
            
            required
            oninvalid="this.setCustomValidity('Please enter your username.')"
            oninput="this.setCustomValidity('')"
            style="width:100%;margin:8px 0 16px;padding:12px;border-radius:8px;border:1px solid #333;background:#111;color:#fff;"
        >

        <label for="password">Password</label>

        <input
            id="password"
            name="password"
            type="password"
            
            required
            oninvalid="this.setCustomValidity('Please enter your password.')"
            oninput="this.setCustomValidity('')"
            style="width:100%;margin:8px 0 16px;padding:12px;border-radius:8px;border:1px solid #333;background:#111;color:#fff;"
        >

        <button type="submit" class="btn">
            Sign In
        </button>

    </form>

</section>

</body>
</html>