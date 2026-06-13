<?php
session_start();

function isLoggedIn(): bool
{
    return !empty($_SESSION['user']);
}

function requireLogin(): void
{
    if (!isLoggedIn()) {
        header('Location: /admin/login.php');
        exit;
    }
}
