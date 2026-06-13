<?php

require __DIR__ . '/../includes/auth.php';
requireLogin();

$config = require __DIR__ . '/../includes/config.php';
$pdo = require __DIR__ . '/../includes/db.php';

$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    header(
        'Location: ' .
        $config['base_url'] .
        'admin/members.php'
    );
    exit;
}

/*
|--------------------------------------------------------------------------
| Find Member
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare(
    "SELECT *
     FROM team_members
     WHERE id = ?"
);

$stmt->execute([$id]);

$member = $stmt->fetch();

if (!$member) {
    header(
        'Location: ' .
        $config['base_url'] .
        'admin/members.php'
    );
    exit;
}

/*
|--------------------------------------------------------------------------
| Delete Photo (optional)
|--------------------------------------------------------------------------
*/

// if (!empty($member['photo'])) {

//     $photoPath = __DIR__ . '/../' .
//         str_replace(
//             $config['base_url'],
//             '',
//             $member['photo']
//         );

//     if (file_exists($photoPath)) {
//         unlink($photoPath);
//     }
// }

/*
|--------------------------------------------------------------------------
| Delete Database Record
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare(
    "DELETE FROM team_members
     WHERE id = ?"
);

$stmt->execute([$id]);

header(
    'Location: ' .
    $config['base_url'] .
    'admin/members.php'
);

exit;