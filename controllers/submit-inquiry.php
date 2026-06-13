<?php

$pdo = require __DIR__ . '/../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: ../index.php#contact');
    exit;
}

$contactInfo = trim(
    $_POST['contact_info'] ?? ''
);

$question = trim(
    $_POST['question'] ?? ''
);

if (
    $contactInfo === '' ||
    $question === ''
) {

    header(
        'Location: ../index.php?inquiry=error#contact'
    );
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO inquiries
    (
        contact_info,
        question
    )
    VALUES
    (
        ?,
        ?
    )"
);

$stmt->execute([
    $contactInfo,
    $question
]);

header(
    'Location: ../index.php?inquiry=success#contact'
);
exit;