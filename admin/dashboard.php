<?php

require __DIR__ . '/../includes/auth.php';
requireLogin();

$config = require __DIR__ . '/../includes/config.php';
$pdo = require __DIR__ . '/../includes/db.php';

$user = $_SESSION['user'];

$memberCount = $pdo->query(
    "SELECT COUNT(*) FROM team_members"
)->fetchColumn();

$projectCount = $pdo->query(
    "SELECT COUNT(*) FROM projects"
)->fetchColumn();

$sponsorCount = $pdo->query(
    "SELECT COUNT(*) FROM sponsors"
)->fetchColumn();

$galleryCount = $pdo->query(
    "SELECT COUNT(*) FROM gallery_items"
)->fetchColumn();
$settingsCount = $pdo->query(
    "SELECT COUNT(*) FROM site_settings"
)->fetchColumn();
// $inquiryCount = $pdo->query(
//     "SELECT COUNT(*) FROM inquiries"
// )->fetchColumn();
$newInquiryCount = $pdo->query(
    "SELECT COUNT(*)
     FROM inquiries
     WHERE status = 'new'"
)->fetchColumn();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | KILO FLIGHT</title>

    <link rel="stylesheet" href="<?= $config['base_url'] ?>assets/css/style.css">
</head>
<body>

<header class="admin-header">
    <div>
        <h1>KILO FLIGHT Admin</h1>
        <p>
            Welcome,
            <strong><?= htmlspecialchars($user['username']) ?></strong>
            (<?= htmlspecialchars($user['role']) ?>)
        </p>
    </div>

    <div style="margin-left:auto; display:flex; align-items:center;">
        <a
            class="btn"
            href="<?= $config['base_url'] ?>admin/inquiries.php"
            style="background:#4da6ff; color:white; padding:8px 16px; margin-right:10px; text-decoration:none;"
        >
            Inbox (<?= $newInquiryCount ?>)
        </a>

        <a
            class="btn logout-btn"
            href="<?= $config['base_url'] ?>admin/logout.php"
            style="background:#e10600; color:white; padding:8px 16px; text-decoration:none;"
        >
            Logout
        </a>
    </div>
</header>


<main class="admin-dashboard">

    <a
        class="admin-card"
        href="<?= $config['base_url'] ?>admin/members.php"
    >
        <h3>Team Members</h3>

        <div class="admin-count">
            <?= $memberCount ?>
        </div>

        <p>Manage club members.</p>
    </a>

    <a
        class="admin-card"
        href="<?= $config['base_url'] ?>admin/projects.php"
    >
        <h3>Projects</h3>

        <div class="admin-count">
            <?= $projectCount ?>
        </div>

        <p>Manage club projects.</p>
    </a>

    <a
        class="admin-card"
        href="<?= $config['base_url'] ?>admin/sponsors.php"
    >
        <h3>Sponsors</h3>

        <div class="admin-count">
            <?= $sponsorCount ?>
        </div>

        <p>Manage sponsor information.</p>
    </a>

    <a
        class="admin-card"
        href="<?= $config['base_url'] ?>admin/gallery.php"
    >
        <h3>Gallery</h3>

        <div class="admin-count">
            <?= $galleryCount ?>
        </div>

        <p>Manage photos and media.</p>
    </a>

    <a
        class="admin-card"
        href="<?= $config['base_url'] ?>admin/site-settings.php"
    >
        <h3>Site Settings</h3>

        <div class="admin-count">
            <?= $settingsCount ?>
        </div>

        <p>
            Manage Hero, About, Contact and website content.
        </p>
    </a>


</main>

</body>
</html>