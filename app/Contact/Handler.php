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
    private $message; // Mesaj metni ve tipini saklamak için
    private $messageType; // 'success', 'error', veya 'warning'

    public function __construct()
    {
        $this->loadConfig();
        $this->message = '';
        $this->messageType = '';
    }

    private function loadConfig()
    {
        $configPath = __DIR__ . '/../../config/smtp.php';
        if (file_exists($configPath)) {
            $this->config = require $configPath;
        } else {
            $this->message = "Configuration file is missing or not loaded correctly.";
            $this->messageType = 'danger';
            file_put_contents(__DIR__.'/../../logs/debug.log', "Failed to load config file at: {$configPath}" . PHP_EOL, FILE_APPEND);
            die($this->message);
        }
    }

    public function handle()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->processFormSubmission();
        }

        require __DIR__ . '/view.php';
    }

    private function processFormSubmission()
    {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $subject = $_POST['subject'] ?? '';
        $message = $_POST['message'] ?? '';

        $mail = new PHPMailer(true);
        try {
            $this->configureMailer($mail);
            $mail->setFrom($this->config['smtp']['user'], 'Coff PHP Framework');
            $mail->addAddress($email, $name);
            $mail->addReplyTo($this->config['smtp']['user'], 'Information');

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = nl2br("Name: $name\nEmail: $email\n\n$message");

            $mail->send();
            $this->message = 'Message has been sent successfully';
            $this->messageType = 'success';
            file_put_contents(__DIR__.'/../../logs/debug.log', "Email sent successfully." . PHP_EOL, FILE_APPEND);
        } catch (Exception $e) {
            $this->message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $this->messageType = 'danger';
            file_put_contents(__DIR__.'/../../logs/debug.log', "Mailer Error: {$mail->ErrorInfo}." . PHP_EOL, FILE_APPEND);
        }
    }

    // Smtp ayarlarını yapılandıran metod

    private function configureMailer(PHPMailer $mail)
    {
        $mail->isSMTP();
        $mail->Host = $this->config['smtp']['host'];
        $mail->SMTPAuth = true;
        $mail->Username = $this->config['smtp']['user'];
        $mail->Password = $this->config['smtp']['pass'];
        $mail->SMTPSecure = $this->config['smtp']['encryption'];
        $mail->Port = $this->config['smtp']['port'];
    }

    // Mesajları ve mesaj türünü döndüren getter metodları
    
    public function getMessage()
    {
        return $this->message;
    }

    public function getMessageType()
    {
        return $this->messageType;
    }
}
?>
