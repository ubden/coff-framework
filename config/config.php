<?php

return [
    // Veritabanı Ayarları
    'db' => [
        'host' => 'localhost',
        'name' => 'coff',
        'user' => 'root',
        'pass' => '',
        'charset' => 'utf8mb4',
    ],

    // SMTP Ayarları
    'smtp' => [
        'host' => 'smtp.example.com',
        'user' => 'user@example.com',
        'pass' => 'password',
        'port' => 587,
        'encryption' => 'tls',
    ],

    // Uygulama Ayarları
    'app' => [
        'base_url' => 'http://coff.dev',
        'environment' => 'development', // or 'production'
        'debug' => true,
    ],

    // Diğer Ayarlar
    'session' => [
        'session_name' => 'coff_session',
        'session_lifetime' => 3600,
    ],

    'security' => [
        'hash_algorithm' => 'sha256',
        'secret_key' => 'your-secret-key',
    ],
];
