<?php
// Coff Framework
// Created by Ubden Community
// GitHub: https://github.com/ubden/coff-framework
// Contributors: https://github.com/ck-cankurt
// License: GNU GENERAL PUBLIC LICENSE
// Framework Website: https://coff.dev
// Sponsored Website: https://ubden.com
// Version: ubden/coff-framework/version.txt
// Release Date: 2024
?>

<?php

// Function to read version from version.txt
function getVersion() {
    $versionFile = __DIR__ . '/../version.txt';
    if (file_exists($versionFile)) {
        return trim(file_get_contents($versionFile));
    }
    return 'unknown';
}

return [
    // Database Settings
    'db' => [
        'host' => 'localhost',
        'name' => 'coff',
        'user' => 'root',
        'pass' => '',
        'charset' => 'utf8mb4',
    ],

    // SMTP Settings
    'smtp' => [
        'host' => 'smtp.example.com',
        'user' => 'user@example.com',
        'pass' => 'password',
        'port' => 587,
        'encryption' => 'tls',
    ],

    // App Settings
    'app' => [
        'app_name'=> 'Coff PHP Framework',
        'base_url' => 'http://coff.dev',
        'environment' => 'development', // or 'production'
        'debug' => true,
        'timezone' => 'Europe/Istanbul',
        'locale' => 'tr_TR',
        'version' => getVersion(),
    ],

    // Session Settings
    'session' => [
        'session_name' => 'coff_session',
        'session_lifetime' => 3600,
    ],

    'security' => [
        'hash_algorithm' => 'sha256',
        'secret_key' => 'your-secret-key',
    ],
];
