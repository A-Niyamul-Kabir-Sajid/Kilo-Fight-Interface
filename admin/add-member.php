<?php

require __DIR__ . '/../includes/auth.php';
requireLogin();

$config = require __DIR__ . '/../includes/config.php';
$pdo = require __DIR__ . '/../includes/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name'] ?? '');
    $position = trim($_POST['position'] ?? '');
    $bio = trim($_POST['bio'] ?? '');
    $displayOrder = (int)($_POST['display_order'] ?? 0);

    $photo = '';

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
        "INSERT INTO team_members
        (
            name,
            position,
            photo,
            bio,
            display_order
        )
        VALUES (?, ?, ?, ?, ?)"
    );

    $stmt->execute([
        $name,
        $position,
        $photo,
        $bio,
        $displayOrder
    ]);

    $message = 'Member added successfully.';
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Member | KILO FLIGHT</title>

    <link rel="stylesheet"
          href="<?= $config['base_url'] ?>assets/css/style.css">
</head>
<body>

<header class="admin-header">
    <div>
        <h1>Add Team Member</h1>
    </div>

    <a class="btn"
       href="<?= $config['base_url'] ?>admin/members.php">
        Back
    </a>
</header>

<main class="section" style="padding-top:120px;">

    <?php if ($message): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

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
            
        >

        <label>Position</label>
        <input
            type="text"
            name="position"
            
        >

        <label>Photo</label>
        <input
            type="file"
            name="photo"
            accept="image/*"
           
        >

        <label>Bio</label>
        <textarea
            name="bio"
            rows="5"
            
        ></textarea>

        <label>Display Order</label>
        <input
            type="number"
            name="display_order"
            value="0"
            
        >

        <button
            type="submit"
            class="btn"
        >
            Add Member
        </button>

    </form>

</main>

</body>
</html>