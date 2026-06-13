<?php

require __DIR__ . '/../includes/auth.php';

logout();

$config = require __DIR__ . '/../includes/config.php';

header('Location: ' . $config['base_url'] . 'admin/login.php');
exit;