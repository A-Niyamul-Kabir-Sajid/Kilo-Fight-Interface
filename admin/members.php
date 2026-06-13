<?php
// C:\Users\varia\AppData\Local\Temp
// C:\xampp\tmp
// echo sys_get_temp_dir();
// echo "<br>";
// echo ini_get('upload_tmp_dir');
// echo "<br>";
require __DIR__ . '/../includes/auth.php';
requireLogin();

$config = require __DIR__ . '/../includes/config.php';
$pdo = require __DIR__ . '/../includes/db.php';

$stmt = $pdo->query(
    "SELECT *
     FROM team_members
     ORDER BY display_order ASC, id ASC"
);

$members = $stmt->fetchAll();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Members | KILO FLIGHT</title>

    <link rel="stylesheet" href="<?= $config['base_url'] ?>assets/css/style.css">
</head>
<body>

<header class="admin-header">
    <div>
        <h1>Team Members</h1>
        <p>Manage club members.</p>
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

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
        <h2>Members List</h2>

        <a
            class="btn"
            href="<?= $config['base_url'] ?>admin/add-member.php"
            style="background:#4da6ff; color:white; padding:8px 16px; text-decoration:none;"
        >
            + Add Member
        </a>
    </div>

    <?php if (empty($members)): ?>

        <p>No team members found.</p>

    <?php else: ?>

        <table style="width:100%;border-collapse:collapse;">

            <thead>
                <tr>
                    <th style="text-align:left;padding:12px;border-bottom:1px solid #333;">ID</th>
                    <th style="text-align:left;padding:12px;border-bottom:1px solid #333;">Photo</th>
                    <th style="text-align:left;padding:12px;border-bottom:1px solid #333;">Name</th>
                    <th style="text-align:left;padding:12px;border-bottom:1px solid #333;">Position</th>
                    <th style="text-align:left;padding:12px;border-bottom:1px solid #333;">Order</th>
                    <th class="actions-column">Actions</th>
                </tr>
            </thead>

            <tbody>

            <?php foreach ($members as $member): ?>

                <tr>

                    <td style="padding:12px;border-bottom:1px solid #222;">
                        <?= $member['id'] ?>
                    </td>

                    <td style="padding:12px;border-bottom:1px solid #222;">

                        <?php if (!empty($member['photo'])): ?>

                            <img
                                src="<?= htmlspecialchars($member['photo']) ?>"
                                alt="<?= htmlspecialchars($member['name']) ?>"
                                style="width:60px;height:60px;object-fit:cover;border-radius:8px;"
                            >

                        <?php else: ?>

                            No Photo

                        <?php endif; ?>

                    </td>

                    <td style="padding:12px;border-bottom:1px solid #222;">
                        <?= htmlspecialchars($member['name']) ?>
                    </td>

                    <td style="padding:12px;border-bottom:1px solid #222;">
                        <?= htmlspecialchars($member['position']) ?>
                    </td>

                    <td style="padding:12px;border-bottom:1px solid #222;">
                        <?= $member['display_order'] ?>
                    </td>

                    <td class="actions-column">

                        <div class="action-buttons">

                            <a
                                class="btn btn-edit"
                                href="<?= $config['base_url'] ?>admin/edit-member.php?id=<?= $member['id'] ?>"
                            >
                                Edit
                            </a>

                            <a
                                class="btn btn-delete"
                                href="<?= $config['base_url'] ?>admin/delete-member.php?id=<?= $member['id'] ?>"
                                onclick="return confirm('Delete this member?')"
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