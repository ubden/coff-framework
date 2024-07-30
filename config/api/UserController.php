<?php

namespace App\Api;

use PDO;

class UserController {
    private $db;

    public function __construct() {
        $config = require __DIR__ . '/../config.php';
        $dbConfig = $config['db'];

        $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']}";
        $this->db = new PDO($dsn, $dbConfig['username'], $dbConfig['password'], $dbConfig['options']);
    }

    public function getAllUsers() {
        $stmt = $this->db->prepare("SELECT id, name FROM users");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($users);
    }
}
