<?php

require __DIR__ . '/../includes/auth.php';
requireLogin();

$config = require __DIR__ . '/../includes/config.php';
$pdo = require __DIR__ . '/../includes/db.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare(
    "SELECT image
     FROM projects
     WHERE id = ?"
);

$stmt->execute([$id]);

$project = $stmt->fetch();

if ($project) {

    if (!empty($project['image'])) {

        $imagePath = str_replace(
            $config['base_url'],
            __DIR__ . '/../',
            $project['image']
        );

        if (file_exists($imagePath)) {
            @unlink($imagePath);
        }
    }

    $stmt = $pdo->prepare(
        "DELETE FROM projects
         WHERE id = ?"
    );

    $stmt->execute([$id]);
}

header(
    'Location: ' .
    $config['base_url'] .
    'admin/projects.php'
);

exit;