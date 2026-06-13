<?php

require __DIR__ . '/../includes/auth.php';
requireLogin();

$config = require __DIR__ . '/../includes/config.php';
$pdo = require __DIR__ . '/../includes/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $pdo->prepare(
        "UPDATE site_settings
         SET setting_value = ?
         WHERE id = ?"
    );

    foreach ($_POST['settings'] ?? [] as $id => $value) {

        $stmt->execute([
            trim($value),
            (int)$id
        ]);
    }

    $message = 'Settings updated successfully.';
}

$stmt = $pdo->query(
    "SELECT *
     FROM site_settings
     ORDER BY id ASC"
);

$settings = $stmt->fetchAll();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Site Settings | KILO FLIGHT</title>

    <link
        rel="stylesheet"
        href="<?= $config['base_url'] ?>assets/css/style.css"
    >
</head>
<body>

<header class="admin-header">

    <div>
        <h1>Site Settings</h1>
        <p>Manage Hero, About and Contact sections.</p>
    </div>

    <a
        class="btn"
        href="<?= $config['base_url'] ?>admin/dashboard.php"
    >
        Dashboard
    </a>

</header>

<main
    class="section"
    style="padding-top:120px;"
>

    <?php if ($message): ?>

        <p
            style="
                color:#4CAF50;
                margin-bottom:20px;
            "
        >
            <?= htmlspecialchars($message) ?>
        </p>

    <?php endif; ?>

    <form
        method="post"
        class="admin-form"
        style="max-width:1000px;"
    >
        <div
            style="
                display:flex;
                justify-content:space-between;
                align-items:center;
                margin-bottom:24px;
            "
        >

            <h2>Settings</h2>

            <a
                class="btn"
                href="<?= $config['base_url'] ?>admin/add-site-setting.php"
            >
                + Add Setting
            </a>

        </div>
        <?php foreach ($settings as $setting): ?>

            <div
                style="
                    margin-bottom:30px;
                    padding:20px;
                    border:1px solid #222;
                    border-radius:12px;
                    background:#111;
                "
            >

                <label
                    style="
                        display:block;
                        margin-bottom:10px;
                        font-weight:bold;
                        color:#e10600;
                    "
                >
                    <?= htmlspecialchars($setting['setting_key']) ?>
                </label>

                <?php if (
                    $setting['setting_type'] === 'textarea'
                ): ?>

                    <textarea
                        name="settings[<?= $setting['id'] ?>]"
                        rows="5"
                    ><?= htmlspecialchars($setting['setting_value']) ?></textarea>

                <?php else: ?>

                    <input
                        type="text"
                        name="settings[<?= $setting['id'] ?>]"
                        value="<?= htmlspecialchars($setting['setting_value']) ?>"
                    >

                <?php endif; ?>

            </div>

        <?php endforeach; ?>

        <button
            type="submit"
            class="btn"
        >
            Save All Changes
        </button>

    </form>

</main>

</body>
</html>