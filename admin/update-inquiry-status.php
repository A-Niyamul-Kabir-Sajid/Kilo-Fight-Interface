<?php

require __DIR__ . '/../includes/auth.php';
requireLogin();

$pdo = require __DIR__ . '/../includes/db.php';
$config = require __DIR__ . '/../includes/config.php';

$id = (int)($_POST['id'] ?? 0);

$status = $_POST['status'] ?? '';

$allowedStatuses = [
    'new',
    'read',
    'replied'
];

if (
    $id <= 0 ||
    !in_array(
        $status,
        $allowedStatuses,
        true
    )
) {

    header(
        'Location: ' .
        $config['base_url'] .
        'admin/inquiries.php'
    );

    exit;
}

$stmt = $pdo->prepare(
    "UPDATE inquiries
     SET status = ?
     WHERE id = ?"
);

$stmt->execute([
    $status,
    $id
]);

header(
    'Location: ' .
    $config['base_url'] .
    'admin/inquiries.php'
);

exit;