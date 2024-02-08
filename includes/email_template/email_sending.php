<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
?>