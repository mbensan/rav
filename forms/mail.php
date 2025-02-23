<?php
require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// php -S localhost:8000
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

if (!$name || !$email || !$subject || !$message) {
  die('Invalid form');
}

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // Replace with your SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'sitiowebravbilbao@gmail.com'; // Your email
    $mail->Password   = 'boeovrenauinctln';      // Your email password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Or PHPMailer::ENCRYPTION_SMTPS for SSL
    $mail->Port       = 587; // Use 465 for SSL, 587 for TLS

    // Recipients
    $mail->setFrom('sitiowebravbilbao@gmail.com', 'Mensaje desde Sitio Web');
    $mail->addAddress('contacto@ravuchile.cl'); // Add a recipient
    $mail->addCC('mbensan.test@gmail.com'); // Add a recipient

    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $body = '<h2>Tiene un mensaje desde el sitio ravbilbao.uchile.cl</h2>';
    $body .= "<p>De: $name. Email: $email</p>";
    $body .= "<h3>Asunto:</h3><p>$subject</p>";
    $body .= "<h3>Mensaje:</h3><p>$message</p>";
    $mail->Body    = $body;

    $mail->AltBody = 'Texto plano de prueba';

    $mail->send();
    
    http_response_code(200);
    echo "OK";
  } catch (Exception $e) {
    http_response_code(400);
    echo "Error en el envío. Por favor contáctenos por otro medio";
}
?>