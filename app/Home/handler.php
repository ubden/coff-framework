<?php
// Coff Framework
// Created by Ubden Community
// GitHub: https://github.com/ubden/coff-framework
// Contributors: https://github.com/ck-cankurt
// License: GNU GENERAL PUBLIC LICENSE
// Framerwork Website: https://coff.dev
// Sponsored Website: https://ubden.com
// Version: ubden/coff-framework/version.txt
// Release Date: 2024
?>

<?php

namespace App\Home;

class Handler
{
    public function handle()
    {
        $message = 'Welcome to Coff Framework Home!';
        require 'view.php';
    }
}
