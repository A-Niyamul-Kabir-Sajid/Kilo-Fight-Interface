<?php

require __DIR__ . '/../includes/auth.php';
requireLogin();

$config = require __DIR__ . '/../includes/config.php';
$pdo = require __DIR__ . '/../includes/db.php';

$stmt = $pdo->query(
    "SELECT *
     FROM sponsors
     ORDER BY display_order ASC, id ASC"
);

$sponsors = $stmt->fetchAll();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Sponsors | KILO FLIGHT</title>

    <link rel="stylesheet"
          href="<?= $config['base_url'] ?>assets/css/style.css">
</head>
<body>

<header class="admin-header">

    <div>
        <h1>Sponsors</h1>
        <p>Manage sponsor information.</p>
    </div>

    <a class="btn"
       href="<?= $config['base_url'] ?>admin/dashboard.php"
       style="background:#555555; color:white; text-decoration:none;"
    >
        Dashboard
    </a>

</header>

<main class="section" style="padding-top:120px;">

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">

        <h2>Sponsors List</h2>

        <a class="btn"
           href="<?= $config['base_url'] ?>admin/add-sponsor.php"
           style="background:#4da6ff; color:white; padding:8px 16px; text-decoration:none;"
        >
            + Add Sponsor
        </a>

    </div>

    <?php if (empty($sponsors)): ?>

        <p>No sponsors found.</p>

    <?php else: ?>

        <table style="width:100%;border-collapse:collapse;">

            <thead>
            <tr>
                <th style="text-align:left;padding:12px;border-bottom:1px solid #333;">ID</th>
                <th style="text-align:left;padding:12px;border-bottom:1px solid #333;">Logo</th>
                <th style="text-align:left;padding:12px;border-bottom:1px solid #333;">Name</th>
                <th style="text-align:left;padding:12px;border-bottom:1px solid #333;">Website</th>
                <th style="text-align:left;padding:12px;border-bottom:1px solid #333;">Order</th>
                <th class="actions-column">Actions</th>
            </tr>
            </thead>

            <tbody>

            <?php foreach ($sponsors as $sponsor): ?>

                <tr>

                    <td style="padding:12px;border-bottom:1px solid #222;">
                        <?= $sponsor['id'] ?>
                    </td>

                    <td style="padding:12px;border-bottom:1px solid #222;">

                        <?php if (!empty($sponsor['logo'])): ?>

                            <img
                                src="<?= htmlspecialchars($sponsor['logo']) ?>"
                                alt="<?= htmlspecialchars($sponsor['name']) ?>"
                                style="width:60px;height:60px;object-fit:contain;background:#fff;border-radius:8px;"
                            >

                        <?php else: ?>

                            No Logo

                        <?php endif; ?>

                    </td>

                    <td style="padding:12px;border-bottom:1px solid #222;">
                        <?= htmlspecialchars($sponsor['name']) ?>
                    </td>

                    <td style="padding:12px;border-bottom:1px solid #222;">

                        <?php if (!empty($sponsor['website'])): ?>

                            <a
                                href="<?= htmlspecialchars($sponsor['website']) ?>"
                                target="_blank"
                            >
                                Visit
                            </a>

                        <?php else: ?>

                            -

                        <?php endif; ?>

                    </td>

                    <td style="padding:12px;border-bottom:1px solid #222;">
                        <?= $sponsor['display_order'] ?>
                    </td>

                    <td class="actions-column">

                        <a
                            class="btn"
                            href="<?= $config['base_url'] ?>admin/edit-sponsor.php?id=<?= $sponsor['id'] ?>"
                        >
                            Edit
                        </a>

                        <a
                            class="btn"
                            href="<?= $config['base_url'] ?>admin/delete-sponsor.php?id=<?= $sponsor['id'] ?>"
                            onclick="return confirm('Delete this sponsor?')"
                        >
                            Delete
                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</main>

</body>
</html>