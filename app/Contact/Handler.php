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

namespace App\Contact;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Error reporting for debugging (remove or modify in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Handler
{
    private $config;

    public function __construct()
    {
        $this->loadConfig();
    }

    private function loadConfig()
    {
        $configPath = __DIR__ . '/../../config/config.php';
        if (file_exists($configPath)) {
            $this->config = require $configPath;
        } else {
            file_put_contents(__DIR__.'/../../logs/debug.log', "Failed to load config file at: {$configPath}" . PHP_EOL, FILE_APPEND);
            die('Configuration file is missing or not loaded correctly.');
        }
    }

    public function handle()
    {
        $message = 'Welcome to Coff Framework Contact Page!';
        file_put_contents(__DIR__.'/../../logs/debug.log', "Handler Invoked." . PHP_EOL, FILE_APPEND);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->processFormSubmission();
        }

        require __DIR__ . '/view.php';
    }

    private function processFormSubmission()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        // PHPMailer kullanarak e-posta gönderme
        $mail = new PHPMailer(true);
        try {
            $this->configureMailer($mail);
            $mail->setFrom($this->config['smtp']['user'], 'Coff PHP Framework');
            $mail->addAddress($email, $name); // Gönderilecek kişi
            $mail->addReplyTo($this->config['smtp']['user'], 'Information');

            // İçerik
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = nl2br("Name: $name\nEmail: $email\n\n$message");
            $mail->AltBody = "Name: $name\nEmail: $email\n\n$message";

            $mail->send();
            $message = 'Message has been sent successfully';
            file_put_contents(__DIR__.'/../../logs/debug.log', "Email sent successfully." . PHP_EOL, FILE_APPEND);
        } catch (Exception $e) {
            $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            file_put_contents(__DIR__.'/../../logs/debug.log', "Mailer Error: {$mail->ErrorInfo}." . PHP_EOL, FILE_APPEND);
        }
    }

    private function configureMailer(PHPMailer $mail)
    {
        // SMTP ayarları
        $mail->isSMTP();
        $mail->Host = $this->config['smtp']['host'];
        $mail->SMTPAuth = true;
        $mail->Username = $this->config['smtp']['user'];
        $mail->Password = $this->config['smtp']['pass'];
        $mail->SMTPSecure = $this->config['smtp']['encryption'];
        $mail->Port = $this->config['smtp']['port'];
    }
}
?>
