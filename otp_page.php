<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dummy_project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $enteredOTP = $_POST["otp"];

    // Prepare statement to select OTP
    $stmt = $conn->prepare("SELECT OTP FROM register WHERE OTP = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("s", $enteredOTP);
    $stmt->execute();
    $stmt->bind_result($storedOTP);
    $stmt->fetch();
    $stmt->close();

    // Verify OTP
    if ($enteredOTP == $storedOTP) {
        $stmt = $conn->prepare("UPDATE register SET varify = 'yes' WHERE OTP = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $enteredOTP);
        if ($stmt->execute()) {
            header("Location: another_page.php");
            exit;
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "<script>alert('Incorrect OTP. Please try again.');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <div class="container">
    <h1>OTP Verification</h1>
    <p>Please enter the OTP sent to your email.</p>
    <hr>
    <label for="otp"><b>OTP</b></label>
    <input type="text" placeholder="Enter OTP" name="otp" id="otp" required>
    <button type="submit" name="submit" class="registerbtn">Submit</button>
  </div>
</form>
</body>
</html>
