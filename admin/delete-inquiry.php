<?php

require __DIR__ . '/../includes/auth.php';
requireLogin();

$config = require __DIR__ . '/../includes/config.php';
$pdo = require __DIR__ . '/../includes/db.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare(
    "SELECT id
     FROM inquiries
     WHERE id = ?"
);

$stmt->execute([$id]);

if ($stmt->fetch()) {

    $deleteStmt = $pdo->prepare(
        "DELETE FROM inquiries
         WHERE id = ?"
    );

    $deleteStmt->execute([$id]);
}

header(
    'Location: ' .
    $config['base_url'] .
    'admin/inquiries.php'
);

exit;