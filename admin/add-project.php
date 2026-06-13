<?php

require __DIR__ . '/../includes/auth.php';
requireLogin();

$config = require __DIR__ . '/../includes/config.php';
$pdo = require __DIR__ . '/../includes/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $link = trim($_POST['link'] ?? '');
    $status = trim($_POST['status'] ?? 'Ongoing');
    $displayOrder = (int)($_POST['display_order'] ?? 0);

    $image = '';

    if (
        isset($_FILES['image']) &&
        $_FILES['image']['error'] === UPLOAD_ERR_OK
    ) {

        $uploadDir = __DIR__ . '/../uploads/projects/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $extension = pathinfo(
            $_FILES['image']['name'],
            PATHINFO_EXTENSION
        );

        $filename =
            uniqid('project_', true) . '.' . $extension;

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            $uploadDir . $filename
        );

        $image =
            $config['base_url'] .
            'uploads/projects/' .
            $filename;
    }

    $stmt = $pdo->prepare(
        "INSERT INTO projects
        (
            title,
            description,
            image,
            link,
            status,
            display_order
        )
        VALUES (?, ?, ?, ?, ?, ?)"
    );

    $stmt->execute([
        $title,
        $description,
        $image,
        $link,
        $status,
        $displayOrder
    ]);

    header(
        'Location: ' .
        $config['base_url'] .
        'admin/projects.php'
    );
    exit;
}

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Project</title>

    <link rel="stylesheet"
          href="<?= $config['base_url'] ?>assets/css/style.css">
</head>
<body>

<header class="admin-header">

    <h1>Add Project</h1>

    <a class="btn"
       href="<?= $config['base_url'] ?>admin/projects.php">
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

    <label>Title</label>
    <input type="text" name="title" required>

    <label>Description</label>
    <textarea name="description"></textarea>

    <label>Image</label>
    <input type="file" name="image" accept="image/*">

    <label>Project Link</label>
    <input type="text" name="link">

    <label>Status</label>
    <input
        type="text"
        name="status"
        value="Ongoing"
    >

    <label>Display Order</label>
    <input
        type="number"
        name="display_order"
        value="0"
    >

    <button class="btn" type="submit">
        Add Project
    </button>

</form>

</main>

</body>
</html>