<?php

require __DIR__ . '/../includes/auth.php';
requireLogin();

$config = require __DIR__ . '/../includes/config.php';
$pdo = require __DIR__ . '/../includes/db.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare(
    "SELECT *
     FROM projects
     WHERE id = ?"
);

$stmt->execute([$id]);

$project = $stmt->fetch();

if (!$project) {
    exit('Project not found.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $link = trim($_POST['link'] ?? '');
    $status = trim($_POST['status'] ?? 'Ongoing');
    $displayOrder = (int)($_POST['display_order'] ?? 0);

    $image = $project['image'];

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
        "UPDATE projects
         SET
            title = ?,
            description = ?,
            image = ?,
            link = ?,
            status = ?,
            display_order = ?
         WHERE id = ?"
    );

    $stmt->execute([
        $title,
        $description,
        $image,
        $link,
        $status,
        $displayOrder,
        $id
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
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit Project | KILO FLIGHT</title>

    <link
        rel="stylesheet"
        href="<?= $config['base_url'] ?>assets/css/style.css"
    >
</head>
<body>

<header class="admin-header">

    <div>
        <h1>Edit Project</h1>
    </div>

    <a
        class="btn"
        href="<?= $config['base_url'] ?>admin/projects.php"
    >
        Back
    </a>

</header>

<main
    class="section"
    style="padding-top:120px;"
>

<form
    method="post"
    enctype="multipart/form-data"
    class="admin-form"
    style="max-width:700px;"
>

    <label>Project Title</label>

    <input
        type="text"
        name="title"
        required
        value="<?= htmlspecialchars($project['title']) ?>"
    >

    <label>Description</label>

    <textarea
        name="description"
        rows="6"
    ><?= htmlspecialchars($project['description']) ?></textarea>

    <label>Current Image</label>

    <div style="margin-bottom:16px;">

        <?php if (!empty($project['image'])): ?>

            <img
                src="<?= htmlspecialchars($project['image']) ?>"
                alt="<?= htmlspecialchars($project['title']) ?>"
                style="
                    width:180px;
                    height:120px;
                    object-fit:cover;
                    border-radius:12px;
                "
            >

        <?php else: ?>

            <p>No image uploaded.</p>

        <?php endif; ?>

    </div>

    <label>Replace Image</label>

    <input
        type="file"
        name="image"
        accept="image/*"
    >

    <label>Project Link</label>

    <input
        type="text"
        name="link"
        value="<?= htmlspecialchars($project['link']) ?>"
    >

    <label>Status</label>

    <input
        type="text"
        name="status"
        value="<?= htmlspecialchars($project['status']) ?>"
    >

    <label>Display Order</label>

    <input
        type="number"
        name="display_order"
        value="<?= $project['display_order'] ?>"
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