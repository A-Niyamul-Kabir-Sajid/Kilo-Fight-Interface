<?php
session_start();
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['username'] === 'admin' && $_POST['password'] === 'password') {
        $_SESSION['user'] = 'admin';
        header('Location: /admin/dashboard.php');
        exit;
    }
    $message = 'Invalid credentials.';
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login | KILO FLIGHT</title>
    <link rel="stylesheet" href="/assets/css/style.css" />
  </head>
  <body>
    <section class="section">
      <h2>Admin Login</h2>
      <?php if ($message): ?>
      <p style="color:#e10600;"><?= htmlspecialchars($message) ?></p>
      <?php endif; ?>
      <form method="post" style="max-width:360px; margin-top:24px;">
        <label for="username">Username</label>
        <input id="username" name="username" type="text" required style="width:100%;margin:8px 0 16px;padding:12px;border-radius:8px;border:1px solid #333;background:#111;color:#fff;" />
        <label for="password">Password</label>
        <input id="password" name="password" type="password" required style="width:100%;margin:8px 0 16px;padding:12px;border-radius:8px;border:1px solid #333;background:#111;color:#fff;" />
        <button type="submit" class="btn">Sign In</button>
      </form>
    </section>
  </body>
</html>
