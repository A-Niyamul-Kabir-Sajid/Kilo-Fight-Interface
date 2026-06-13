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
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sponsor | KILO FLIGHT</title>

    <link rel="stylesheet"
          href="<?= $config['base_url'] ?>assets/css/style.css">
</head>
<body>

<header class="admin-header">

    <div>
        <h1>Add Sponsor</h1>
    </div>

    <a
        class="btn"
        href="<?= $config['base_url'] ?>admin/sponsors.php"
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

        <label>Sponsor Name</label>

        <input
            type="text"
            name="name"
            required
        >

        <label>Website</label>

        <input
            type="text"
            name="website"
        >

        <label>Logo</label>

        <input
            type="file"
            name="logo"
            accept="image/*"
        >

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
            Add Sponsor
        </button>

    </form>

</main>

</body>
</html>