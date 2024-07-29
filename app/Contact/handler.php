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
?>
<?php

namespace App\Contact;

class Handler
{
    public function handle()
    {
        // Get the form data
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Here, you can add code to handle the form submission, such as sending an email or saving the data to a database

// For now, we'll just display the submitted data
echo "<h2>Thank you for contacting us, $name.</h2>";
echo "<p>We have received your message and will get back to you shortly.</p>";
echo "<p><strong>Name:</strong> $name</p>";
echo "<p><strong>Email:</strong> $email</p>";
echo "<p><strong>Subject:</strong> $subject</p>";
echo "<p><strong>Message:</strong> $message</p>";


        require __DIR__ . '/view.php';
    }
}

