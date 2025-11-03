<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/Router.php';
require_once __DIR__ . '/../src/Controllers/UserController.php';

use Src\Router;
use Src\Controllers\UserController;

$router = new Router();
$database = Database::connection();
$userController = new UserController($database);

// ================= ROUTES ===================
$router->add('GET', '/', function() {
    echo json_encode([
        "success" => true,
        "message" => "Welcome to API PHP Native",
        "endpoints" => [
            "GET /api/v1/users" => "List all users",
            "GET /api/v1/users/{id}" => "Get user by ID",
            "POST /api/v1/users" => "Create user",
            "PUT /api/v1/users/{id}" => "Update user",
            "DELETE /api/v1/users/{id}" => "Delete user"
        ]
    ]);
});

$router->add('GET', '/api/v1/users', [$userController, 'index']);
$router->add('GET', '/api/v1/users/{id}', [$userController, 'show']);
$router->add('POST', '/api/v1/users', [$userController, 'create']);
$router->add('PUT', '/api/v1/users/{id}', [$userController, 'update']);
$router->add('DELETE', '/api/v1/users/{id}', [$userController, 'delete']);

// ================= RUN ROUTER ===================
$router->run();
