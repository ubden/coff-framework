
<?php

namespace App\About;

class Handler
{
    public function handle()
    {
        $message = 'Welcome to Coff Framework About Page!';
        require __DIR__ . '/view.php';
    }
}
