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
$version = trim(file_get_contents(__DIR__ . '/../../version.txt'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coff PHP Framework</title>
    <meta name="description" content="The best of stable and faster PHP Framework">
    <meta name="author" content="Ubden Community">
    <link rel="stylesheet" href="./assets/css/app.css">
    <script src="./assets/js/app.js" defer></script>
</head>
<body>
    <header class="bg-dark">
        <nav class="navbar navbar-expand-lg navbar-dark container">
            <a class="navbar-brand" href="#">Coff Framework</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="/Home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/About">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Contact">Contact</a></li>
                </ul>
                <span class="navbar-text">
                    <a href="https://github.com/ubden/coff-framework" target="_blank" class="text-white">
                        ubden/coff-framework: The best stable and newest PHP framework - github.com
                    </a>
                </span>
            </div>
        </nav>
    </header>
    <main class="container mt-4">