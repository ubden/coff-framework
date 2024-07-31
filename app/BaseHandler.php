<?php

namespace App;

abstract class BaseHandler
{
    public function __construct()
    {
        session_start();
        $this->checkAuthentication();
    }

    private function checkAuthentication()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /../../public/login.php');
            exit;
        }
    }

    abstract public function handle();
}
?>
