<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if the required parameters are present
if (!isset($_GET['otp']) || !isset($_GET['email'])) {
    die('Invalid access. OTP and Email are required.');
}

$otp = htmlspecialchars($_GET['otp']);
$email = htmlspecialchars($_GET['email']);

// Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = 0; // Disable verbose debug output for production
    $mail->isSMTP(); // Send using SMTP
    $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'jay.solanki0906@gmail.com'; // SMTP username
    $mail->Password = 'vvjsuibvvqbaclmc'; // SMTP password, use App Password if 2FA is enabled
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
    $mail->Port = 587; // TCP port to connect to

    $mail->setFrom('jay.solanki0906@gmail.com', 'Mailer');
    $mail->addAddress($email, 'Recipient'); // Add a recipient

    $verificationLink = "http://localhost/project_dummy/otp_page.php";

    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'Your OTP for registration';
    $mail->Body = "Your OTP is: <strong>$otp</strong><br><br>Click the link below to verify your OTP:<br><a href='$verificationLink'>Verify OTP</a>";

    $mail->send();
    echo 'OTP has been sent to your email.';
    exit;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
