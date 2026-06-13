<?php

function getSettings(PDO $pdo): array
{
    static $cache = null;

    if ($cache !== null) {
        return $cache;
    }

    $stmt = $pdo->query(
        "SELECT setting_key, setting_value
         FROM site_settings"
    );

    $cache = [];

    foreach ($stmt as $row) {
        $cache[$row['setting_key']] = $row['setting_value'];
    }

    return $cache;
}

function getSetting(PDO $pdo, string $key): string
{
    $settings = getSettings($pdo);
    return $settings[$key] ?? '';
}