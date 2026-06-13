<section
    id="hero"
    class="hero"
    style="
        background:
            linear-gradient(
                120deg,
                rgba(0,0,0,0.9),
                rgba(0,0,0,0.3)
            ),
            url('<?= htmlspecialchars(getSetting($pdo, 'hero_background_image')) ?>')
            no-repeat center/cover;
    "
>
    <div class="hero-content">

        <h1>
            <?= htmlspecialchars(getSetting($pdo, 'hero_title')) ?>
        </h1>

        <p>
            <?= htmlspecialchars(getSetting($pdo, 'hero_subtitle')) ?>
        </p>

        <a
            href="<?= htmlspecialchars(getSetting($pdo, 'hero_button_link')) ?>"
            class="btn"
        >
            <?= htmlspecialchars(getSetting($pdo, 'hero_button_text')) ?>
        </a>

    </div>
</section>