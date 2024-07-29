
<?php

namespace App\Contact;

class Handler
{
    public function handle()
    {
        $message = 'Welcome to Coff Framework Contact Page!';
        require __DIR__ . '/view.php';
    }
}
