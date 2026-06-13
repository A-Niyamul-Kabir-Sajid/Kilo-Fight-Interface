<section id="contact" class="section contact-section">

    <div class="contact-header">

        <h2>
            <?= htmlspecialchars(
                getSetting($pdo, 'contact_title')
            ) ?>
        </h2>

        <p>
            <?= nl2br(
                htmlspecialchars(
                    getSetting($pdo, 'contact_intro')
                )
            ) ?>
        </p>

    </div>

    <div class="contact-grid">

        <div class="contact-card">

            <h3>Email</h3>

            <a href="mailto:<?= htmlspecialchars(getSetting($pdo, 'contact_email')) ?>">
                <?= htmlspecialchars(getSetting($pdo, 'contact_email')) ?>
            </a>

        </div>

        <div class="contact-card">

            <h3>Facebook</h3>

            <a
                href="<?= htmlspecialchars(getSetting($pdo, 'contact_facebook')) ?>"
                target="_blank"
                rel="noopener noreferrer"
            >
                Team Kilo Flight
            </a>

        </div>

        <div class="contact-card">

            <h3>LinkedIn</h3>

            <a
                href="<?= htmlspecialchars(getSetting($pdo, 'contact_linkedin')) ?>"
                target="_blank"
                rel="noopener noreferrer"
            >
                KILO FLIGHT
            </a>

        </div>

        <div class="contact-card">

            <h3>Location</h3>

            <p>
                <?= nl2br(
                    htmlspecialchars(
                        getSetting($pdo, 'contact_location')
                    )
                ) ?>
            </p>

        </div>

    </div>

</section>