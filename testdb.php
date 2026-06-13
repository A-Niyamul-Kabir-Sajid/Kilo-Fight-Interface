<?php

$pdo = require __DIR__ . '/includes/db.php';

$username = 'test_admin';
$password = password_hash('admin123', PASSWORD_DEFAULT);
$role = 'admin';

$stmt = $pdo->prepare(
    "INSERT INTO users (username, password_hash, role)
     VALUES (?, ?, ?)"
);

$stmt->execute([
    $username,
    $password,
    $role
]);

echo "<h2>User inserted successfully.</h2>";

$stmt = $pdo->query(
    "SELECT id, username, role, created_at
     FROM users"
);

$users = $stmt->fetchAll();

echo "<pre>";
print_r($users);
echo "</pre>";