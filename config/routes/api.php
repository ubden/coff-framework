<?php

use Bramus\Router\Router;
use App\Api\UserController;

require_once __DIR__ . '/../logger.php';

$router = new Router();

$router->mount('/api', function() use ($router) {
    $router->get('/users', function() {
        log_message("UserController getAllUsers called", "info");
        $controller = new UserController();
        $controller->getAllUsers();
    });
});

// Hata yakalama ve loglama
$router->set404(function() {
    http_response_code(404);
    echo '404, route not found!';
    log_message("404, route not found!", "error");
});

$router->before('GET|POST|PUT|DELETE', '/.*', function() {
    log_message("API request: " . $_SERVER['REQUEST_METHOD'] . " " . $_SERVER['REQUEST_URI'], "info");
});

try {
    log_message("API request successful.", "info");
} catch (Exception $e) {
    log_message("API error: " . $e->getMessage(), "error");
    log_message("Stack trace: " . $e->getTraceAsString(), "error");
    http_response_code(500);
    echo '500, internal server error!';
}
?>
