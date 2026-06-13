<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$config = require __DIR__ . '/config.php';

function isLoggedIn(): bool
{
    return isset($_SESSION['user']['id']);
}

function requireLogin(): void
{
    global $config;

    if (!isLoggedIn()) {
        header('Location: ' . $config['base_url'] . 'admin/login.php');
        exit;
    }
}

function logout(): void
{
    $_SESSION = [];//does the job of session unset

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();

        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }

    session_destroy();
}