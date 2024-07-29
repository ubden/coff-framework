<?php
// Coff Framework
// Created by Ubden Community
// GitHub: https://github.com/ubden/coff-framework
// Contributors: https://github.com/ck-cankurt
// License: GNU GENERAL PUBLIC LICENSE
// Framework Website: https://coff.dev
// Sponsored Website: https://ubden.com
// Version: ubden/coff-framework/version.txt
// Release Date: 2024
// Framework Version
$version = trim(file_get_contents(__DIR__ . '/../../version.txt'));
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Coff Framework v<?php echo $version; ?></title>
    <link rel="stylesheet" href="/assest/css/app.css">
    <script src="/assest/js/app.js" defer></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="./index.php">Coff Framework</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/Home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/About">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Contact">Contact</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    <a href="https://github.com/ubden/coff-framework" target="_blank">ubden/coff-framework</a>
                </span>
            </div>
        </nav>
    </header>
    <main class="container mt-4">