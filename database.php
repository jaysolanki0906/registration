<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dummy_project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$username = sanitize_input($_POST['Username']);
$email = sanitize_input($_POST['Email']);
$contact_information = sanitize_input($_POST['Contact-information']);
$password = sanitize_input($_POST['password']);
$repeat_password = sanitize_input($_POST['psw-repeat']);

$current_date = date('Y-m-d'); // Changed to ISO format for MySQL compatibility
$current_time = date('H:i:s');

if (empty($username) || empty($email) || empty($contact_information) || empty($password) || empty($repeat_password)) {
    die('All fields are mandatory.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Invalid email format.');
}

if (!preg_match('/^\d{10}$/', $contact_information)) {
    die('Invalid contact information. It should be a 10-digit number.');
}

if ($password !== $repeat_password) {
    die('Passwords do not match.');
}

$otp = rand(100000, 999999);
$hashed_password = password_hash($password, PASSWORD_DEFAULT); // Secure password hashing
$varify='No';
// Prepare and bind
$stmt = $conn->prepare("INSERT INTO register (Username, Email, Contact_information, pass, Account_creation_date, Last_login, OTP,varify) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $username, $email, $contact_information, $hashed_password, $current_date, $current_time, $otp,$varify);

if ($stmt->execute()) {
    header("Location: OTP_Send.php?otp=$otp&email=$email"); // Correct usage of header()
    exit(); // Ensure no further code is executed
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
