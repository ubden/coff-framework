
<?php

namespace App\Home;

class Handler
{
    public function handle()
    {
        $message = 'Welcome to Coff Framework Home!';
        require __DIR__ . '/view.php';
    }
}
