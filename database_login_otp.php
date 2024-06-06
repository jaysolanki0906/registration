<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dummy_project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['Email'];

    // Sanitize and validate email
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Invalid email format.');
    }

    // Check if email exists in the database
    $stmt = $conn->prepare("SELECT Email FROM register WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Generate OTP
        $otp = rand(100000, 999999);

        // Update OTP in the database
        $stmt = $conn->prepare("UPDATE register SET OTP = ? WHERE Email = ?");
        $stmt->bind_param("ss", $otp, $email);
        if ($stmt->execute()) {
            // Send OTP via email
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'jay.solanki0906@gmail.com';
                $mail->Password = 'vvjsuibvvqbaclmc';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('jay.solanki0906@gmail.com', 'mailer');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Your OTP for login';
                $mail->Body = 'Your OTP is: ' . $otp;

                $mail->send();
                echo 'OTP has been sent to your email.';
                header("Location: verify_otp.php?email=$email");
                exit();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Error updating OTP: " . $stmt->error;
        }
    } else {
        echo 'Email not found in the database.';
    }

    $stmt->close();
}

$conn->close();
?>
