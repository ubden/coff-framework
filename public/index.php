<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Coff PHP Framework
// Created by Ubden Community
// GitHub: https://github.com/ubden/coff-framework
// Contributors: https://github.com/ck-cankurt
// License: GNU GENERAL PUBLIC LICENSE
// Framework Website: https://coff.dev
// Sponsored Website: https://ubden.com
// Version: ubden/coff-framework/version.txt
// Release Date: 2024

// Loglama işlemleri için gerekli dosyaları yükler
require_once __DIR__ . '/../config/logger.php'; // Logger.php'yi yükler

// Composer autoload dosyasını yükler
require_once __DIR__ . '/../vendor/autoload.php';

log_message("Index.php accessed");

// Geçici çözüm: $_POST değişkenini tanımlama
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST)) {
    $_POST = [];
}

// Bramus Router'ı yükle ve API rotalarını dahil et
require_once __DIR__ . '/../config/routes/api.php';

// $_POST ve $_GET değişkenlerinin varlığını kontrol edin
$post_path = isset($_POST['path']) ? ucfirst($_POST['path']) : null;
$get_path = isset($_GET['path']) ? ucfirst($_GET['path']) : null;
$path = $post_path ?: ($get_path ?: 'Home');

log_message("Resolved path: " . $path);

$handlerClass = 'App\\' . $path . '\\Handler';
log_message("Handler class: " . $handlerClass);

if (class_exists($handlerClass)) {
    log_message("Handler class exists.");
    $handler = new $handlerClass();
    $handler->handle();
} else {
    if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
        log_message("API request detected.");
        require_once __DIR__ . '/../config/routes/api.php';
    } else {
        log_message("404 Not Found: " . $handlerClass);
        echo '404 Not Found';
    }
}
?>
