<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use SendGrid\Mail\Mail;
use SendGrid\{SendGrid, Response};

// Load Composer's autoloader
require "/connect2local/vendor/autoload.php";

// Create an instance; passing `true` enables exceptions
function send_mail($name, $email, $subject, $template) {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'connect2local247@gmail.com';
    $mail->Password   = 'cqax xkfr hntk jomg';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Recipients
    $mail->setFrom('connect2local247@gmail.com', 'Connect2Local');
    $mail->addAddress($email);

    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $template;

    // Send the email
    $mail->send();
}
function send_contact_mail($name, $email, $subject, $description) {
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'your_email@gmail.com'; // Your Gmail email address
        $mail->Password   = 'your_password';        // Your Gmail password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption
        $mail->Port       = 587;    // TCP port to connect to

        // Sender and recipient
        $mail->setFrom($email, $name);
        $mail->addAddress('connect2local247@gmail.com'); // Your email address

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $description;

        // Send the email
        $mail->send();

        // Return true if email sent successfully
        return true;
    } catch (Exception $e) {
        // Log error and return false
        error_log('Error sending email: ' . $e->getMessage());
        return false;
    }
}



?>