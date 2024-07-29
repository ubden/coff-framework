<?php
// Coff PHP Framework
// Created by Ubden Community
// GitHub: https://github.com/ubden/coff-framework
// Contributors: https://github.com/ck-cankurt
// License: GNU GENERAL PUBLIC LICENSE
// Framework Website: https://coff.dev
// Sponsored Website: https://ubden.com
// Version: ubden/coff-framework/version.txt
// Release Date: 2024

function log_message($message) {
    file_put_contents(__DIR__.'/../logs/debug.log', $message . PHP_EOL, FILE_APPEND);
}

require_once __DIR__ . '/../vendor/autoload.php';

log_message("Index.php accessed");

$path = !empty($_POST['path']) ? ucfirst($_POST['path']) : 
        (!empty($_GET['path']) ? ucfirst($_GET['path']) : 'Home');
log_message("Resolved path: " . $path);

$handlerClass = 'App\\' . $path . '\\Handler';
log_message("Handler class: " . $handlerClass);

if (class_exists($handlerClass)) {
    log_message("Handler class exists.");
    $handler = new $handlerClass();
    $handler->handle();
} else {
    log_message("404 Not Found: " . $handlerClass);
    echo '404 Not Found';
}
?>