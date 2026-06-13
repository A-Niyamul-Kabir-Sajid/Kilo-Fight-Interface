<?php

require __DIR__ . '/../includes/auth.php';
requireLogin();

$config = require __DIR__ . '/../includes/config.php';
$pdo = require __DIR__ . '/../includes/db.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare(
    "SELECT *
     FROM team_members
     WHERE id = ?"
);

$stmt->execute([$id]);

$member = $stmt->fetch();

if (!$member) {
    exit('Member not found.');
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name'] ?? '');
    $position = trim($_POST['position'] ?? '');
    $bio = trim($_POST['bio'] ?? '');
    $displayOrder = (int)($_POST['display_order'] ?? 0);

    $photo = $member['photo'];

    if (
        isset($_FILES['photo']) &&
        $_FILES['photo']['error'] === UPLOAD_ERR_OK
    ) {

        $uploadDir = __DIR__ . '/../uploads/team/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $extension = pathinfo(
            $_FILES['photo']['name'],
            PATHINFO_EXTENSION
        );

        $filename =
            uniqid('member_', true) . '.' . $extension;

        move_uploaded_file(
            $_FILES['photo']['tmp_name'],
            $uploadDir . $filename
        );

        $photo =
            $config['base_url'] .
            'uploads/team/' .
            $filename;
    }

    $stmt = $pdo->prepare(
        "UPDATE team_members
         SET
            name = ?,
            position = ?,
            photo = ?,
            bio = ?,
            display_order = ?
         WHERE id = ?"
    );

    $stmt->execute([
        $name,
        $position,
        $photo,
        $bio,
        $displayOrder,
        $id
    ]);

    header(
        'Location: ' .
        $config['base_url'] .
        'admin/members.php'
    );
    exit;
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Member | KILO FLIGHT</title>

    <link rel="stylesheet"
          href="<?= $config['base_url'] ?>assets/css/style.css">
</head>
<body>

<header class="admin-header">

    <div>
        <h1>Edit Team Member</h1>
    </div>

    <a
        class="btn"
        href="<?= $config['base_url'] ?>admin/members.php"
    >
        Back
    </a>

</header>

<main class="section" style="padding-top:120px;">

    <form
        method="post"
        enctype="multipart/form-data"
        class="admin-form"
        style="max-width:700px;"
    >

        <label>Name</label>

        <input
            type="text"
            name="name"
            required
            value="<?= htmlspecialchars($member['name']) ?>"
            
        >

        <label>Position</label>

        <input
            type="text"
            name="position"
            value="<?= htmlspecialchars($member['position']) ?>"
            
        >

        <label>Current Photo</label>

        <div style="margin-bottom:16px;">

            <?php if (!empty($member['photo'])): ?>

                <img
                    src="<?= htmlspecialchars($member['photo']) ?>"
                    alt="<?= htmlspecialchars($member['name']) ?>"
                    style="
                        width:120px;
                        height:120px;
                        object-fit:cover;
                        border-radius:12px;
                    "
                >

            <?php else: ?>

                <p>No photo uploaded.</p>

            <?php endif; ?>

        </div>

        <label>Replace Photo</label>

        <input
            type="file"
            name="photo"
            accept="image/*"
            
        >

        <label>Bio</label>

        <textarea
            name="bio"
            rows="5"
            
        ><?= htmlspecialchars($member['bio']) ?></textarea>

        <label>Display Order</label>

        <input
            type="number"
            name="display_order"
            value="<?= $member['display_order'] ?>"
            
        >

        <button
            type="submit"
            class="btn"
        >
            Save Changes
        </button>

    </form>

</main>

</body>
</html>