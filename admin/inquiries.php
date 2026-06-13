<?php

require __DIR__ . '/../includes/auth.php';
requireLogin();

$config = require __DIR__ . '/../includes/config.php';
$pdo = require __DIR__ . '/../includes/db.php';

$stmt = $pdo->query(
    "SELECT *
     FROM inquiries
     ORDER BY created_at DESC"
);

$inquiries = $stmt->fetchAll();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Inbox | KILO FLIGHT</title>

    <link
        rel="stylesheet"
        href="<?= $config['base_url'] ?>assets/css/style.css"
    >
</head>
<body>

<header class="admin-header">

    <div>
        <h1>Inquiry Inbox</h1>

        <p>
            Messages submitted from the website.
        </p>
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

<?php if (empty($inquiries)): ?>

    <p>No inquiries found.</p>

<?php else: ?>

    <table
        style="
            width:100%;
            border-collapse:collapse;
        "
    >

        <thead>

            <tr>

                <th
                    style="
                        text-align:left;
                        padding:12px;
                        border-bottom:1px solid #333;
                    "
                >
                    ID
                </th>

                <th
                    style="
                        text-align:left;
                        padding:12px;
                        border-bottom:1px solid #333;
                    "
                >
                    Contact
                </th>

                <th
                    style="
                        text-align:left;
                        padding:12px;
                        border-bottom:1px solid #333;
                    "
                >
                    Question
                </th>

                <th
                    style="
                        text-align:left;
                        padding:12px;
                        border-bottom:1px solid #333;
                    "
                >
                    Status
                </th>

                <th
                    style="
                        text-align:left;
                        padding:12px;
                        border-bottom:1px solid #333;
                    "
                >
                    Date
                </th>

                <th
                    class="actions-column"
                >
                    Actions
                </th>

            </tr>

        </thead>

        <tbody>

        <?php foreach ($inquiries as $inquiry): ?>

            <tr>

                <td
                    style="
                        padding:12px;
                        border-bottom:1px solid #222;
                    "
                >
                    <?= $inquiry['id'] ?>
                </td>

                <td
                    style="
                        padding:12px;
                        border-bottom:1px solid #222;
                    "
                >
                    <?= htmlspecialchars(
                        $inquiry['contact_info']
                    ) ?>
                </td>

                <td
                    style="
                        padding:12px;
                        border-bottom:1px solid #222;
                        max-width:500px;
                    "
                >
                    <?= nl2br(
                        htmlspecialchars(
                            $inquiry['question']
                        )
                    ) ?>
                </td>

                <td
    style="
        padding:12px;
        border-bottom:1px solid #222;
    "
>

    <form
        action="<?= $config['base_url'] ?>admin/update-inquiry-status.php"
        method="post"
    >

        <input
            type="hidden"
            name="id"
            value="<?= $inquiry['id'] ?>"
        >

        <select
            name="status"
            onchange="this.form.submit()"
        >
            <option
                value="new"
                <?= $inquiry['status'] === 'new' ? 'selected' : '' ?>
            >
                New
            </option>

            <option
                value="read"
                <?= $inquiry['status'] === 'read' ? 'selected' : '' ?>
            >
                Read
            </option>

            <option
                value="replied"
                <?= $inquiry['status'] === 'replied' ? 'selected' : '' ?>
            >
                Replied
            </option>

        </select>

    </form>

</td>

                <td
                    style="
                        padding:12px;
                        border-bottom:1px solid #222;
                    "
                >
                    <?= $inquiry['created_at'] ?>
                </td>

                <td
                    class="actions-column"
                >

                    <a
                        class="btn btn-delete"
                        href="<?= $config['base_url'] ?>admin/delete-inquiry.php?id=<?= $inquiry['id'] ?>"
                        onclick="return confirm('Delete this inquiry?')"
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