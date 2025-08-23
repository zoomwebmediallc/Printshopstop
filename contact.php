<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../smtp/PHPMailer.php';
require '../smtp/Exception.php';
require '../smtp/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
    $mail->isSMTP();
    $mail->Host       = 'business129.web-hosting.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'test@wishgeekstechserve.com';
    $mail->Password   = 'X(?l4%^MHg!v';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
    $mail->Port       = 587;

    // Set the From address to your domain email
    $mail->setFrom('test@wishgeekstechserve.com', 'Printer Shop Stop');
    // Set Reply-To to the user's email
    $mail->addReplyTo($email, $name);
    $mail->addAddress('test@wishgeekstechserve.com', 'Printer Shop Stop');

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "
            <h3>New Contact Form Message</h3>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Message:</strong><br>{$message}</p>
        ";

        $mail->send();
        echo 'OK'; // BootstrapMade template expects 'OK' on success
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid Request";
}

