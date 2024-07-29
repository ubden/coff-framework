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

// Include the header file
require __DIR__ . '/../includes/header.php'; 
?>



<h1 class="my-4">Welcome to <?php echo $config['app']['app_name']; ?> - Version <?php echo getVersion(); ?></h1>
<div class="card">
    <div class="card-header">
        Dashboard
    </div>
    <div class="card-body">
        <h5 class="card-title">Framework Features</h5>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Simple and understandable structure</li>
            <li class="list-group-item">Modular and scalable design</li>
            <li class="list-group-item">Built-in support for popular libraries</li>
            <li class="list-group-item">Easy configuration management</li>
            <li class="list-group-item">Version control with automatic updates</li>
        </ul>
    </div>
</div>
<?php require __DIR__ . '/../includes/footer.php'; ?>
