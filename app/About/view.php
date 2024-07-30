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

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center">
        <h1><?php echo $head; ?></h1>
            <p class="lead">The best stable and newest PHP framework. Build your next application with ease and efficiency!</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Easy Routing</h4>
                </div>
                <div class="card-body">
                    <p><?php echo $config['app']['app_name']; ?> - Version <?php echo getVersion(); ?>offers a simple yet powerful routing system, making it easy to create friendly URLs for your application.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">MVC Architecture</h4>
                </div>
                <div class="card-body">
                    <p>Organize your code using the Model-View-Controller (MVC) pattern for clean and maintainable application structure.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Database Handling</h4>
                </div>
                <div class="card-body">
                    <p>Interact with your database effortlessly using Coff Framework's built-in database handling features.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../includes/footer.php'; ?>