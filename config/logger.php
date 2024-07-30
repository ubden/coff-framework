<?php

function log_message($logMessage, $logType = "info") {
    $timestamp = date('Y-m-d H:i:s'); // Mevcut tarih ve saat
    $logFilePath = __DIR__ . '/../logs/debug.log'; // Log dosyasının yolu
    $formattedMessage = "[{$timestamp}] [{$logType}] - {$logMessage}\n"; // Log mesajını formatlama
    file_put_contents($logFilePath, $formattedMessage . PHP_EOL, FILE_APPEND);
}
