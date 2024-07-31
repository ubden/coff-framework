<?php

namespace App\Middleware;

class Authentication {
    public function handle() {
        // Örnek doğrulama kontrolü
        if (!isset($_SESSION['user'])) {
            http_response_code(401);
            echo '401 Unauthorized';
            exit;
        }
    }
}
?>
