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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['Email'];
    $entered_otp = $_POST['OTP'];

    // Prepare and bind to fetch the stored OTP
    $stmt = $conn->prepare("SELECT OTP FROM register WHERE Email = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }
    $stmt->bind_result($stored_otp);
    $stmt->fetch();
    $stmt->close();

    if ($entered_otp == $stored_otp) {
        $current_time = date('Y-m-d H:i:s'); 
        $stmt = $conn->prepare("UPDATE register SET varify = 'yes', Last_login = ? WHERE Email = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ss", $current_time, $email);
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }
        $stmt->close();

        echo "OTP verified successfully";
        header("Location: another_page.php");
        exit();
    } else {
        echo "<script>alert('Incorrect OTP. Please try again.'); window.location.href='verify_otp.php?email=$email';</script>";
    }
}

$conn->close();
?>
