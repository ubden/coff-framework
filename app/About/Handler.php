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

namespace App\About;

use App\Includes\FileCache;
use App\BaseHandler;

class Handler extends BaseHandler
{
    public function handle()
    {
        $head = 'Welcome to Coff Framework About Page!';
        require __DIR__ . '/view.php';
    }
}
?>