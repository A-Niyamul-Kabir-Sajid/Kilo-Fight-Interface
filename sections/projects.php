<?php

$pdo = require __DIR__ . '/../includes/db.php';

$stmt = $pdo->query(
    "SELECT *
     FROM projects
     ORDER BY display_order ASC, id ASC"
);

$projects = $stmt->fetchAll();

?>

<section id="projects" class="section dark">

    <h2>Projects</h2>

    <?php if (!empty($projects)): ?>

        <div class="team-slider project-grid">

            <?php foreach ($projects as $project): ?>

                <a
                    href="<?= !empty($project['link'])
                        ? htmlspecialchars($project['link'])
                        : '#'
                    ?>"
                    class="photo-card"
                    <?= !empty($project['link'])
                        ? 'target="_blank"'
                        : ''
                    ?>
                >

                    <div class="photo-card-image">

                        <?php if (!empty($project['image'])): ?>

                            <img
                                src="<?= htmlspecialchars($project['image']) ?>"
                                alt="<?= htmlspecialchars($project['title']) ?>"
                            >

                        <?php else: ?>

                            <div class="photo-card-placeholder">
                                NO IMAGE
                            </div>

                        <?php endif; ?>

                    </div>

                    <div class="photo-card-name">
                        <?= htmlspecialchars($project['title']) ?>
                    </div>

                </a>

            <?php endforeach; ?>

        </div>

    <?php else: ?>

        <p>No projects available.</p>

    <?php endif; ?>

</section>