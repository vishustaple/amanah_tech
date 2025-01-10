<?php
// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // If using Composer, include the Composer autoload file
// Or manually include the PHPMailer files:
function sendEmailTesting($attachments, $emails) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'sandbox.smtp.mailtrap.io';              // Specify main and backup SMTP servers (e.g., Gmail)
        $mail->SMTPAuth = true;                                // Enable SMTP authentication
        $mail->Username = '061819b064e1ec';                    // SMTP username
        $mail->Password = 'e78994cd227227';                    // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;    // Enable TLS encryption
        $mail->Port = 2525;                                    // TCP port to connect to (587 for TLS)
        // From email
        $mail->setFrom('test@example.com', 'Mailer');
        // Add multiple recipients
        foreach ($emails as $email) {
            $mail->addAddress($email); // Add each recipient from the array
        }
        // Add multiple attachments
        foreach ($attachments as $attachment) {
            if (file_exists($attachment)) {
               $mail->AddAttachment($attachment); 
            } 
        }
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'term-and policy Aamanah Orders';
        $mail->Body    = 'This is the <b>HTML</b> Term sheets <b> for some product !</b>';
        $mail->AltBody = 'This is the plain text version of the email content';

        // Send the email
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


?>
