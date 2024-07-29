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

require_once __DIR__ . '/../vendor/autoload.php';

$path = !empty($_GET['path']) ? ucfirst($_GET['path']) : 'Home';
$handlerClass = 'App\\' . $path . '\\handler';

if (class_exists($handlerClass)) {
    $handler = new $handlerClass();
    $handler->handle();
} else {
    echo '404 Not Found';
}
?>
