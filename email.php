<?php
// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // If using Composer, include the Composer autoload file
// Or manually include the PHPMailer files:
function sendEmailTesting($attachments, $emails,$userName) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = '976503e174c4bb';
        $mail->Password = '5a66c0b8720c05';                     // SMTP password
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
        $mail->Subject = 'Order Term & Condition Information from Amanah';
        $mail->Body = '<strong>Dear ' . htmlspecialchars($userName) . ',</strong><br/><br/>Thank you for your order!
        <p>Please find the signed copy of the Service Level Agreement attached.</p> <br/><p>If you have any questions, 
        feel free to contact us at billing@amanah.com.</p><br />
        <p>Best regards,</p><br/><p>Team Amanah</p>';
        // Send the email
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


?>
