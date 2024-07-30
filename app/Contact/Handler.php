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
    $mailconfig = require __DIR__ . '/../../config/config.php';
    public function handle()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $message = 'Welcome to Coff Framework Contact Page!';
        file_put_contents(__DIR__.'/../../logs/debug.log', "Handler Invoked." . PHP_EOL, FILE_APPEND);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            // PHPMailer kullanarak e-posta gönderme
            $mail = new PHPMailer(true);
            try {
                // SMTP ayarları
                $mail->isSMTP();
                $mail->Host = $mailconfig['smtp']['host'];
                $mail->SMTPAuth = true;
                $mail->Username = $mailconfig['smtp']['user'];
                $mail->Password = $mailconfig['smtp']['pass'];
                $mail->SMTPSecure = $mailconfig['smtp']['encryption'];
                $mail->Port = $mailconfig['smtp']['port'];

                // E-posta ayarları
                $mail->setFrom($mailconfig['smtp']['user'], 'Coff PHP Framework');
                $mail->addAddress($email, $name); // Gönderilecek kişi
                $mail->addReplyTo($mailconfig['smtp']['user'], 'Information');

                // İçerik
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = nl2br("Name: $name\nEmail: $email\n\n$message");
                $mail->AltBody = "Name: $name\nEmail: $email\n\n$message";

                $mail->send();
                $message = 'Message has been sent successfully';
                file_put_contents(__DIR__.'/../../logs/debug.log', "Email sent successfully." . PHP_EOL, FILE_APPEND);
            } catch (Exception $e) {
                $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                file_put_contents(__DIR__.'/../../logs/debug.log', "Mailer Error: {$mail->ErrorInfo}." . PHP_EOL, FILE_APPEND);
            }
        }

        require __DIR__ . '/view.php';
    }
}
?>