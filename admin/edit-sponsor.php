<?php

require __DIR__ . '/../includes/auth.php';
requireLogin();

$config = require __DIR__ . '/../includes/config.php';
$pdo = require __DIR__ . '/../includes/db.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare(
    "SELECT *
     FROM sponsors
     WHERE id = ?"
);

$stmt->execute([$id]);

$sponsor = $stmt->fetch();

if (!$sponsor) {
    exit('Sponsor not found.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name'] ?? '');
    $website = trim($_POST['website'] ?? '');
    $displayOrder = (int)($_POST['display_order'] ?? 0);

    $logo = $sponsor['logo'];

    if (
        isset($_FILES['logo']) &&
        $_FILES['logo']['error'] === UPLOAD_ERR_OK
    ) {

        $uploadDir = __DIR__ . '/../uploads/sponsors/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Delete old logo file
        if (!empty($sponsor['logo'])) {

            $oldLogoPath = str_replace(
                $config['base_url'],
                __DIR__ . '/../',
                $sponsor['logo']
            );

            if (file_exists($oldLogoPath)) {
                @unlink($oldLogoPath);
            }
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
        "UPDATE sponsors
         SET
            name = ?,
            logo = ?,
            website = ?,
            display_order = ?
         WHERE id = ?"
    );

    $stmt->execute([
        $name,
        $logo,
        $website,
        $displayOrder,
        $id
    ]);

    header(
        'Location: ' .
        $config['base_url'] .
        'admin/sponsors.php'
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

    <title>Edit Sponsor | KILO FLIGHT</title>

    <link
        rel="stylesheet"
        href="<?= $config['base_url'] ?>assets/css/style.css"
    >
</head>
<body>

<header class="admin-header">

    <div>
        <h1>Edit Sponsor</h1>
    </div>

    <a
        class="btn"
        href="<?= $config['base_url'] ?>admin/sponsors.php"
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

    <label>Sponsor Name</label>

    <input
        type="text"
        name="name"
        required
        value="<?= htmlspecialchars($sponsor['name']) ?>"
    >

    <label>Current Logo</label>

    <div style="margin-bottom:16px;">

        <?php if (!empty($sponsor['logo'])): ?>

            <img
                src="<?= htmlspecialchars($sponsor['logo']) ?>"
                alt="<?= htmlspecialchars($sponsor['name']) ?>"
                style="
                    width:180px;
                    height:120px;
                    object-fit:contain;
                    background:#fff;
                    border-radius:12px;
                    padding:10px;
                "
            >

        <?php else: ?>

            <p>No logo uploaded.</p>

        <?php endif; ?>

    </div>

    <label>Replace Logo</label>

    <input
        type="file"
        name="logo"
        accept="image/*"
    >

    <label>Website</label>

    <input
        type="text"
        name="website"
        value="<?= htmlspecialchars($sponsor['website']) ?>"
    >

    <label>Display Order</label>

    <input
        type="number"
        name="display_order"
        value="<?= $sponsor['display_order'] ?>"
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