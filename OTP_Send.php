<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["Username"];
    $email = $_POST["Email"];
    $contact = $_POST["Contact-information"];
    $password = $_POST["password"];
    
    // Generate OTP
    $otp = rand(100000, 999999); // Generate a random 6-digit OTP
    
    // Send OTP via email
   
    
    require 'vendor/autoload.php';
    
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->SMTPDebug = 2;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'jay.solanki0906@gmail.com';            // SMTP username
        $mail->Password   = 'vvjsuibvvqbaclmc';                    // SMTP password, use App Password if 2FA is enabled
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to
    
        // Recipients
        $mail->setFrom('jay.solanki0906@gmail.com', 'Mailer');
        $mail->addAddress($email, 'Recipient');  // Add a recipient
    
        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = 'Your OTP for registration';
        $mail->Body    = 'Your OTP is: ' . $otp;
    
        // Send email
        $mail->send();
    
        // Redirect to OTP page with data
        header("Location: otp_page.php?username=$username&email=$email&contact=$contact&password=$password&otp=$otp");
        exit;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
