<?php

require_once '../vendor/autoload.php';

$path = !empty($_GET['path']) ? ucfirst($_GET['path']) : 'Home';
$handlerClass = 'App\\' . $path . '\\Handler';

if (class_exists($handlerClass)) {
    $handler = new $handlerClass();
    $handler->handle();
} else {
    echo '404 Not Found';
}
