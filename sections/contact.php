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
    <?php if (isset($_GET['inquiry'])): ?>

    <?php if (isset($_GET['inquiry']) && $_GET['inquiry'] === 'success'): ?>

        <div class="contact-success">
            Inquiry sent successfully.
        </div>

    <?php elseif (isset($_GET['inquiry']) && $_GET['inquiry'] === 'error'): ?>

        <div class="contact-error">
            Please fill in all fields.
        </div>

    <?php endif; ?>

<?php endif; ?>
    <div class="contact-layout">

    <div class="contact-info">

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

    </div>

    <div class="contact-form-card">

        <h3>Send Inquiry</h3>

        <form
            action="<?= $config['base_url'] ?>controllers/submit-inquiry.php"
            method="post"
        >

            <input
                type="text"
                name="contact_info"
                placeholder="Email or Phone Number"
                required
            >

            <textarea
                name="question"
                rows="6"
                placeholder="Write your question..."
                required
            ></textarea>

            <button
                type="submit"
                class="btn"
            >
                Send Inquiry
            </button>

        </form>

    </div>

</div>



</section>