<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Eğer oturum başlatılmadıysa başlat
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Coff PHP Framework
// Created by Ubden Community
// GitHub: https://github.com/ubden/coff-framework
// Contributors: https://github.com/ck-cankurt
// License: GNU GENERAL PUBLIC LICENSE
// Framework Website: https://coff.dev
// Sponsored Website: https://ubden.com
// Version: ubden/coff-framework/version.txt
// Release Date: 2024

require_once __DIR__ . '/../config/logger.php'; // Logger.php'yi yükler
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/container/Container.php';

// Container sınıfını yükle
use App\Container\Container;
use App\ExampleController;
// Middleware sınıflarını yükleyin
use App\Middleware\Authentication;
use App\Middleware\Logging;
use App\Middleware\Cors;
// Özel istisna sınıfını yükle
use App\Exceptions\CustomException;

// Container'ı oluştur ve bağımlılıkları kaydet
$container = new Container();

$container->bind('AuthMiddleware', function() {
    return new Authentication();
});

$container->bind('LoggingMiddleware', function() {
    return new Logging();
});

$container->bind('CorsMiddleware', function() {
    return new Cors();
});

$container->bind('ExampleController', function($container) {
    return new ExampleController($container->resolve('App\ExampleService'));
});

// Middleware işlemleri
$cors = new Cors();
$cors->handle();

$logging = new Logging();
$logging->handle();

$auth = new Authentication();
$auth->handle();

log_message("Index.php accessed");

$router = new \Bramus\Router\Router();

require_once __DIR__ . '/../config/routes/api.php';

// 404 ve 500 hata sayfaları için özel yönlendirme
$router->set404(function() {
    http_response_code(404);
    require __DIR__ . '/../app/includes/errors/404.php';
    exit;
});

set_exception_handler(function($e) {
    log_message("Exception: " . $e->getMessage(), "error");
    http_response_code(500);
    require __DIR__ . '/../app/includes/errors/500.php';
    exit;
});

// Yönlendiriciyi çalıştır
try {
    $router->run();
    log_message("API request successful.", "info");
} catch (CustomException $e) {
    log_message("CustomException: " . $e->getMessage(), "error");
    http_response_code(500);
    require __DIR__ . '/../app/includes/errors/500.php';
    exit;
} catch (Exception $e) {
    log_message("API error: " . $e->getMessage(), "error");
    log_message("Stack trace: " . $e->getTraceAsString(), "error");
    http_response_code(500);
    require __DIR__ . '/../app/includes/errors/500.php';
    exit;
}

$post_path = isset($_POST['path']) ? ucfirst($_POST['path']) : null;
$get_path = isset($_GET['path']) ? ucfirst($_GET['path']) : null;
$path = $post_path ?: ($get_path ?: 'Home');

log_message("Resolved path: " . $path);

$handlerClass = 'App\\' . $path . '\\Handler';
log_message("Handler class: " . $handlerClass);

if (class_exists($handlerClass)) {
    log_message("Handler class exists.");
    $handler = new $handlerClass();
    if (!isset($_SESSION['user']) && $path !== 'Login') {
        header('Location: /login.php');
        exit;
    }
    $handler->handle();
} else {
    if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
        log_message("API request detected.");
        try {
            $router->run();
            log_message("API request successful.", "info");
        } catch (Exception $e) {
            log_message("API error: " . $e->getMessage(), "error");
            log_message("Stack trace: " . $e->getTraceAsString(), "error");
            http_response_code(500);
            require __DIR__ . '/../app/includes/errors/500.php';
            exit;
        }
    } else {
        log_message("404 Not Found: " . $handlerClass);
        http_response_code(404);
        require __DIR__ . '/../app/includes/errors/404.php';
        exit;
    }
}
?>
