<section id="about" class="section">

    <?php
    $aboutImage = getSetting($pdo, 'about_image');
    ?>

    <?php if (!empty($aboutImage)): ?>

        <img
            src="<?= htmlspecialchars($aboutImage) ?>"
            alt="About KILO FLIGHT"
           
        >

    <?php endif; ?>

    <h2>
        <?= htmlspecialchars(
            getSetting($pdo, 'about_title')
        ) ?>
    </h2>

    <p>
        <?= nl2br(
            htmlspecialchars(
                getSetting($pdo, 'about_content')
            )
        ) ?>
    </p>

</section>