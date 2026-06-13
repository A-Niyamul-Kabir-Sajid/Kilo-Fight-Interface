<?php
$name = $name ?? "Unknown";
$image = $image ?? "";
$link = $link ?? "#";
?>

<a href="<?= htmlspecialchars($link) ?>" class="photo-card">

    <div class="photo-card-image">

        <!-- <?php //if (!empty($image) && file_exists($image)): ?> -->
        <?php if (!empty($image)): ?>
            <img
                src="<?= htmlspecialchars($image) ?>"
                alt="<?= htmlspecialchars($name) ?>"
            >

        <?php else: ?>

            <div class="photo-card-placeholder">
                <?= htmlspecialchars($name) ?>
            </div>

        <?php endif; ?>

    </div>

    <div class="photo-card-name">
        <?= htmlspecialchars($name) ?>
    </div>

</a>