<?php

$pdo = require __DIR__ . '/../includes/db.php';

$stmt = $pdo->query(
    "SELECT *
     FROM team_members
     ORDER BY display_order ASC, id ASC"
);

$members = $stmt->fetchAll();

?>

<<section id="team" class="section dark">

    <h2>Our Team</h2>

    <div class="team-slider">

        <?php foreach ($members as $member): ?>

            <?php

            $name = $member['name'];
            $image = $member['photo'];
            $link = '#';

            include __DIR__ . '/../includes/photo-card.php';

            ?>

        <?php endforeach; ?>

    </div>

</section>
<script src="assets/js/team-slider.js"></script>