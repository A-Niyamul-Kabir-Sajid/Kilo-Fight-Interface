<?php

require __DIR__ . '/../includes/auth.php';
requireLogin();

$config = require __DIR__ . '/../includes/config.php';
$pdo = require __DIR__ . '/../includes/db.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare(
    "SELECT logo
     FROM sponsors
     WHERE id = ?"
);

$stmt->execute([$id]);

$sponsor = $stmt->fetch();

if ($sponsor) {

    $stmt = $pdo->prepare(
        "DELETE FROM sponsors
         WHERE id = ?"
    );

    $stmt->execute([$id]);
}

header(
    'Location: ' .
    $config['base_url'] .
    'admin/sponsors.php'
);

exit;