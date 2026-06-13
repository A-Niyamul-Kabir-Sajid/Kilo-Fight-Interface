<?php

$pdo = require __DIR__ . '/../includes/db.php';

$stmt = $pdo->query(
    "SELECT *
     FROM sponsors
     ORDER BY display_order ASC, id ASC"
);

$sponsors = $stmt->fetchAll();

?>

<section id="sponsors" class="section">

    <h2>Sponsors</h2>

    <?php if (!empty($sponsors)): ?>

        <div class="team-slider sponsor-grid">

            <?php foreach ($sponsors as $sponsor): ?>

                <a
                    href="<?= !empty($sponsor['website'])
                        ? htmlspecialchars($sponsor['website'])
                        : '#'
                    ?>"
                    class="photo-card"
                    <?= !empty($sponsor['website'])
                        ? 'target="_blank"'
                        : ''
                    ?>
                >

                    <div class="photo-card-image">

                        <?php if (!empty($sponsor['logo'])): ?>

                            <img
                                src="<?= htmlspecialchars($sponsor['logo']) ?>"
                                alt="<?= htmlspecialchars($sponsor['name']) ?>"
                            >

                        <?php else: ?>

                            <div class="photo-card-placeholder">
                                NO LOGO
                            </div>

                        <?php endif; ?>

                    </div>

                    <div class="photo-card-name">
                        <?= htmlspecialchars($sponsor['name']) ?>
                    </div>

                </a>

            <?php endforeach; ?>

        </div>

    <?php else: ?>

        <p>No sponsors available.</p>

    <?php endif; ?>

</section>