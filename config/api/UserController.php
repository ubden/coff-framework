<?php

namespace App\Api;

use PDO;
use Exception;

class UserController {
    private $db;

    public function __construct() {
        $config = require __DIR__ . '/../config.php';
        $dbConfig = $config['db'];

        $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']}";
        $this->db = new PDO($dsn, $dbConfig['username'], $dbConfig['password'], $dbConfig['options']);
    }

    public function getAllUsers() {
        try {
            $stmt = $this->db->prepare("SELECT id, name FROM users");
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            header('Content-Type: application/json');
            echo json_encode($users);
        } catch (Exception $e) {
            log_message("Database error: " . $e->getMessage(), "error");
            http_response_code(500);
            echo '500, internal server error!';
        }
    }
}
