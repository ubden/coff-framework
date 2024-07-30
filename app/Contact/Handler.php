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

class Handler
{
    public function handle()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $head = 'Welcome to Coff Framework Contact Page!';
        $smtp = require __DIR__ . '/../../config/smtp.php';

        if (!isset($smtp)) {
            $this->log("Configuration file is missing or not loaded correctly.", "error");
            die('Configuration file is missing or not loaded correctly.');
        }

        // Log Handler Invoked
        $this->log("Handler Invoked.", "info");

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            $mail = new PHPMailer(true);
            try {
                $this->configureMailer($mail, $smtp);
                $mail->setFrom($smtp['smtp']['user'], 'Coff PHP Framework');
                $mail->addAddress($email, $name);
                $mail->addReplyTo($smtp['smtp']['user'], 'Information');

                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = nl2br("Name: $name\nEmail: $email\n\n$message");

                $mail->send();
                $this->log("Email sent successfully to {$email}.", "info");
            } catch (Exception $e) {
                $this->log("Mailer Error: {$mail->ErrorInfo}", "error");
            }
        }

        require __DIR__ . '/view.php';
    }

    // Configure PHPMailer
    private function configureMailer(PHPMailer $mail, $smtp)
    {
        $mail->isSMTP();
        $mail->Host = $smtp['smtp']['host'];
        $mail->SMTPAuth = true;
        $mail->Username = $smtp['smtp']['user'];
        $mail->Password = $smtp['smtp']['pass'];
        $mail->SMTPSecure = $smtp['smtp']['encryption'];
        $mail->Port = $smtp['smtp']['port'];
    }

    private function log($message, $type = "info")
    {
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "[{$timestamp}] [{$type}] - {$message}\n";
        file_put_contents(__DIR__ . '/../../logs/debug.log', $logMessage, FILE_APPEND);
    }
}
?>