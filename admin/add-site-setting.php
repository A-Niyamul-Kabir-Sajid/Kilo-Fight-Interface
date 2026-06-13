<?php

require __DIR__ . '/../includes/auth.php';
requireLogin();

$config = require __DIR__ . '/../includes/config.php';
$pdo = require __DIR__ . '/../includes/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $settingKey = trim($_POST['setting_key'] ?? '');
    $settingValue = trim($_POST['setting_value'] ?? '');
    $settingType = trim($_POST['setting_type'] ?? 'text');

    $stmt = $pdo->prepare(
        "INSERT INTO site_settings
        (
            setting_key,
            setting_value,
            setting_type
        )
        VALUES (?, ?, ?)"
    );

    $stmt->execute([
        $settingKey,
        $settingValue,
        $settingType
    ]);

    header(
        'Location: ' .
        $config['base_url'] .
        'admin/site-settings.php'
    );

    exit;
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Add Site Setting</title>

    <link
        rel="stylesheet"
        href="<?= $config['base_url'] ?>assets/css/style.css"
    >
</head>
<body>

<header class="admin-header">

    <div>
        <h1>Add Site Setting</h1>
    </div>

    <a
        class="btn"
        href="<?= $config['base_url'] ?>admin/site-settings.php"
    >
        Back
    </a>

</header>

<main class="section" style="padding-top:120px;">

<form
    method="post"
    class="admin-form"
    style="max-width:700px;"
>

    <label>Setting Key</label>

    <input
        type="text"
        name="setting_key"
        required
        placeholder="hero_title"
    >

    <label>Setting Value</label>

    <textarea
        name="setting_value"
        rows="5"
    ></textarea>

    <label>Setting Type</label>

    <select
        name="setting_type"
        style="
            width:100%;
            padding:16px;
            margin-bottom:20px;
            background:#111;
            color:#fff;
            border:1px solid #333;
            border-radius:8px;
        "
    >
        <option value="text">Text</option>
        <option value="textarea">Textarea</option>
        <option value="url">URL</option>
        <option value="image">Image</option>
    </select>

    <button
        type="submit"
        class="btn"
    >
        Add Setting
    </button>

</form>

</main>

</body>
</html>