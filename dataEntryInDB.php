<?php

$pdo = require __DIR__ . '/includes/db.php';

$pdo->exec("
CREATE TABLE IF NOT EXISTS site_settings (

    id INT AUTO_INCREMENT PRIMARY KEY,

    setting_key VARCHAR(100) NOT NULL UNIQUE,

    setting_value TEXT,

    setting_type ENUM(
        'text',
        'textarea',
        'url',
        'image'
    ) DEFAULT 'text'
)
");

$settings = [
    ['contact_title', 'Contact Us', 'text'],

    ['contact_intro',
    'Interested in sponsorship, collaboration, recruitment, or learning more about KILO FLIGHT? We would love to hear from you.',
    'textarea'],

    // Hero
    // ['hero_title', 'Engineering Speed. Driving Innovation.', 'text'],
    // ['hero_subtitle', "KUET's official Formula Student team representing Bangladesh.", 'textarea'],
    // ['hero_button_text', 'Explore More', 'text'],
    // ['hero_button_link', '#about', 'text'],
    // ['hero_background_image', 'assets/images/audi-f1-concept-2022-front-quarter.webp', 'image'],

    // // About
    // ['about_title', 'About Us', 'text'],
    // ['about_content',
    //     'KILO FLIGHT is the Formula Student team of KUET. We design, build, and compete with high-performance race cars while advancing electric and autonomous vehicle technology.',
    //     'textarea'
    // ],
    // ['about_image', 'assets/images/About US .jpg', 'image'],

    // // Contact
    // ['contact_email', 'info@kiloflight.com', 'text'],
    // ['contact_facebook', 'https://www.facebook.com/teamkiloflightkuet', 'url'],
    // ['contact_linkedin', 'https://www.linkedin.com/company/kiloflight/posts/?feedView=all', 'url'],
    // ['contact_location',
    //     'Khulna University of Engineering & Technology (KUET), Khulna, Bangladesh',
    //     'textarea'
    // ]
];

$stmt = $pdo->prepare(
    "INSERT IGNORE INTO site_settings
    (
        setting_key,
        setting_value,
        setting_type
    )
    VALUES (?, ?, ?)"
);

foreach ($settings as $setting) {
    $stmt->execute($setting);
}

echo "Site settings table created and default data inserted successfully.";