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
        $config = require __DIR__ . '/../../config/config.php';
        $message = 'Welcome to Coff Framework Contact Page!';

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
                $mail->Host = $config['smtp']['host'];
                $mail->SMTPAuth = true;
                $mail->Username = $config['smtp']['user'];
                $mail->Password = $config['smtp']['pass'];
                $mail->SMTPSecure = $config['smtp']['encryption'];
                $mail->Port = $config['smtp']['port'];

                // E-posta ayarları
                $mail->setFrom($config['smtp']['user'], 'Coff PHP Framework');
                $mail->addAddress($email, $name); // Gönderilecek kişi
                $mail->addReplyTo($config['smtp']['user'], 'Information');

                // İçerik
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = nl2br("Name: $name\nEmail: $email\n\n$message");
                $mail->AltBody = "Name: $name\nEmail: $email\n\n$message";

                $mail->send();
                $message = 'Message has been sent successfully';
            } catch (Exception $e) {
                $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

        require __DIR__ . '/view.php';
    }
}
?>
