<?php
// Coff Framework
// Created by Ubden Community
// GitHub: https://github.com/ubden/coff-framework
// Contributors: https://github.com/ck-cankurt
// License: GNU GENERAL PUBLIC LICENSE
// Framerwork Website: https://coff.dev
// Sponsored Website: https://ubden.com
// Version: ubden/coff-framework/version.txt
// Release Date: 2024
?>

<?php

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
        'base_url' => 'http://coff.dev',
        'environment' => 'development', // or 'production'
        'debug' => true,
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
