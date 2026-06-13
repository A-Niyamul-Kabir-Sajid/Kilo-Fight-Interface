<?php
$pageTitle = $pageTitle ?? 'KILO FLIGHT | KUET';
?><!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="/assets/css/style.css" />
  </head>
  <body>
    <header>
      <div class="logo">KILO FLIGHT</div>
      <nav>
        <ul>
          <li><a href="/index.php">Home</a></li>
          <li><a href="/about.php">About</a></li>
          <li><a href="/team.php">Team</a></li>
          <li><a href="/projects.php">Projects</a></li>
          <li><a href="/sponsors.php">Sponsors</a></li>
          <li><a href="/contact.php" class="contact-btn">Contact</a></li>
        </ul>
      </nav>
    </header>
    <main>
