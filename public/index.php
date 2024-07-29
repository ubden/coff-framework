<?php

require_once '../vendor/autoload.php';

$path = !empty($_GET['path']) ? ucfirst($_GET['path']) : 'Home';
$handlerClass = 'App\\' . $path . '\\Handler';
$handler = new $handlerClass();
$handler->handle();
