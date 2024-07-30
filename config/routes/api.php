<?php

use App\Api\UserController;

$router->get('/api/users', [UserController::class, 'getAllUsers']);
