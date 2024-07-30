<?php
// Loglama işlemleri için gerekli dosyaları yükler
require_once __DIR__ . '/../config/logger.php'; // Logger.php'yi yükler

<?php

use Bramus\Router\Router;
use App\Api\UserController;

// Bramus Router'ı başlat
$router = new Router();

$router->mount('/api', function() use ($router) {
    $router->get('/users', [UserController::class, 'getAllUsers']);
});

// Hata yakalama ve loglama
$router->set404(function() {
    http_response_code(404);
    echo '404, route not found!';
    log_message("404, route not found!", "error");
});

$router->before('GET|POST|PUT|DELETE', '/.*', function() {
    // Log request details
    log_message("API request: " . $_SERVER['REQUEST_METHOD'] . " " . $_SERVER['REQUEST_URI'], "info");
});

try {
    $router->run();
} catch (Exception $e) {
    log_message("API error: " . $e->getMessage(), "error");
    http_response_code(500);
    echo '500, internal server error!';
}
