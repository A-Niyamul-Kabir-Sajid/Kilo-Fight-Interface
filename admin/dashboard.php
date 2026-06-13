<?php
require __DIR__ . '/../includes/auth.php';
requireLogin();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard | KILO FLIGHT</title>
    <link rel="stylesheet" href="/assets/css/style.css" />
  </head>
  <body>
    <header>
      <div class="logo">Admin Panel</div>
    </header>
    <main class="section">
      <h2>Dashboard</h2>
      <p>Welcome to the KILO FLIGHT administration dashboard.</p>
      <ul>
        <li><a href="/admin/members.php">Members</a></li>
        <li><a href="/admin/projects.php">Projects</a></li>
        <li><a href="/admin/sponsors.php">Sponsors</a></li>
        <li><a href="/admin/gallery.php">Gallery</a></li>
      </ul>
    </main>
  </body>
</html>
