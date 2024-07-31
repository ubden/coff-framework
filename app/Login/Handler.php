<?php
// Coff PHP Framework
// Created by Ubden Community
// GitHub: https://github.com/ubden/coff-framework
// Contributors: https://github.com/ck-cankurt
// License: GNU GENERAL PUBLIC LICENSE
// Framework Website: https://coff.dev
// Sponsored Website: https://ubden.com
// Version: ubden/coff-framework/version.txt
// Release Date: 2024

namespace App\Login;

use App\BaseHandler;

class Handler extends BaseHandler
{
    public function handle()
    {
        // Eğer oturum başlatılmadıysa başlat
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Kullanıcı zaten giriş yapmışsa index.php'ye yönlendir
        if (isset($_SESSION['user'])) {
            header('Location: /index.php');
            exit;
        }

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Örnek kullanıcı doğrulaması (gerçek bir uygulamada veritabanı kontrolü yapın)
            if ($username === 'admin' && $password === 'password') {
                $_SESSION['user'] = [
                    'username' => $username,
                    'role' => 'admin'
                ];
                header('Location: /?path=Home');
                exit;
            } else {
                $error = 'Geçersiz kullanıcı adı veya şifre';
            }
        }

        $head = 'Giriş Yap';
        require __DIR__ . '/view.php';
    }
}
?>
