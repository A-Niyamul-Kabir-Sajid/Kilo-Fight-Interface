<?php

require __DIR__ . '/../includes/auth.php';
requireLogin();

$config = require __DIR__ . '/../includes/config.php';
$pdo = require __DIR__ . '/../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name'] ?? '');
    $website = trim($_POST['website'] ?? '');
    $displayOrder = (int)($_POST['display_order'] ?? 0);

    $logo = '';

    if (
        isset($_FILES['logo']) &&
        $_FILES['logo']['error'] === UPLOAD_ERR_OK
    ) {

        $uploadDir = __DIR__ . '/../uploads/sponsors/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $extension = pathinfo(
            $_FILES['logo']['name'],
            PATHINFO_EXTENSION
        );

        $filename =
            uniqid('sponsor_', true) . '.' . $extension;

        move_uploaded_file(
            $_FILES['logo']['tmp_name'],
            $uploadDir . $filename
        );

        $logo =
            $config['base_url'] .
            'uploads/sponsors/' .
            $filename;
    }

    $stmt = $pdo->prepare(
        "INSERT INTO sponsors
        (
            name,
            logo,
            website,
            display_order
        )
        VALUES (?, ?, ?, ?)"
    );

    $stmt->execute([
        $name,
        $logo,
        $website,
        $displayOrder
    ]);

    header(
        'Location: ' .
        $config['base_url'] .
        'admin/sponsors.php'
    );
    exit;
}
?>