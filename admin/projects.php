<?php

require __DIR__ . '/../includes/auth.php';
requireLogin();

$config = require __DIR__ . '/../includes/config.php';
$pdo = require __DIR__ . '/../includes/db.php';

$stmt = $pdo->query(
    "SELECT *
     FROM projects
     ORDER BY display_order ASC, id ASC"
);

$projects = $stmt->fetchAll();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Manage Projects | KILO FLIGHT</title>

    <link rel="stylesheet"
          href="<?= $config['base_url'] ?>assets/css/style.css">
</head>
<body>

<header class="admin-header">

    <div>
        <h1>Projects</h1>
        <p>Manage team projects.</p>
    </div>

    <a
        class="btn"
        href="<?= $config['base_url'] ?>admin/dashboard.php"
        style="background:#555555; color:white; text-decoration:none;"
    >
        Dashboard
    </a>

</header>

<main class="section" style="padding-top:120px;">

    <div
        style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:24px;
        "
    >

        <h2>Projects List</h2>

        <a
            class="btn"
            href="<?= $config['base_url'] ?>admin/add-project.php"
            style="background:#4da6ff; color:white; padding:8px 16px; text-decoration:none;"
        >
            + Add Project
        </a>

    </div>

    <?php if (empty($projects)): ?>

        <p>No projects found.</p>

    <?php else: ?>

        <table style="width:100%;border-collapse:collapse;">

            <thead>

                <tr>

                    <th style="text-align:left;padding:12px;border-bottom:1px solid #333;">
                        ID
                    </th>

                    <th style="text-align:left;padding:12px;border-bottom:1px solid #333;">
                        Image
                    </th>

                    <th style="text-align:left;padding:12px;border-bottom:1px solid #333;">
                        Title
                    </th>

                    <th style="text-align:left;padding:12px;border-bottom:1px solid #333;">
                        Status
                    </th>

                    <th style="text-align:left;padding:12px;border-bottom:1px solid #333;">
                        Link
                    </th>

                    <th style="text-align:left;padding:12px;border-bottom:1px solid #333;">
                        Order
                    </th>

                    <th class="actions-column">
                        Actions
                    </th>

                </tr>

            </thead>

            <tbody>

            <?php foreach ($projects as $project): ?>

                <tr>

                    <td style="padding:12px;border-bottom:1px solid #222;">
                        <?= $project['id'] ?>
                    </td>

                    <td style="padding:12px;border-bottom:1px solid #222;">

                        <?php if (!empty($project['image'])): ?>

                            <img
                                src="<?= htmlspecialchars($project['image']) ?>"
                                alt="<?= htmlspecialchars($project['title']) ?>"
                                style="
                                    width:60px;
                                    height:60px;
                                    object-fit:cover;
                                    border-radius:8px;
                                "
                            >

                        <?php else: ?>

                            No Image

                        <?php endif; ?>

                    </td>

                    <td style="padding:12px;border-bottom:1px solid #222;">
                        <?= htmlspecialchars($project['title']) ?>
                    </td>

                    <td style="padding:12px;border-bottom:1px solid #222;">
                        <?= htmlspecialchars($project['status']) ?>
                    </td>

                    <td style="padding:12px;border-bottom:1px solid #222;">

                        <?php if (!empty($project['link'])): ?>

                            <a
                                href="<?= htmlspecialchars($project['link']) ?>"
                                target="_blank"
                                style="color:#e10600;"
                            >
                                Visit
                            </a>

                        <?php else: ?>

                            -

                        <?php endif; ?>

                    </td>

                    <td style="padding:12px;border-bottom:1px solid #222;">
                        <?= $project['display_order'] ?>
                    </td>

                    <td class="actions-column">

                        <div class="action-buttons">

                            <a
                                class="btn btn-edit"
                                href="<?= $config['base_url'] ?>admin/edit-project.php?id=<?= $project['id'] ?>"
                            >
                                Edit
                            </a>

                            <a
                                class="btn btn-delete"
                                href="<?= $config['base_url'] ?>admin/delete-project.php?id=<?= $project['id'] ?>"
                                onclick="return confirm('Delete this project?')"
                            >
                                Delete
                            </a>

                        </div>

                    </td>

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</main>

</body>
</html>