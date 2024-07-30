<?php

use Bramus\Router\Router;
use App\Api\UserController;

$router = new Router();

$router->mount('/api', function() use ($router) {
    $router->get('/users', [UserController::class, 'getAllUsers']);
});

