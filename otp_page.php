<?php
// Initialize variables
$username = $email = $contact = $password = $generatedOTP = '';

// Check if all the data is passed through URL parameters
if(isset($_GET["username"]) && isset($_GET["email"]) && isset($_GET["contact"]) && isset($_GET["password"]) && isset($_GET["otp"])) {
    $username = $_GET["username"];
    $email = $_GET["email"];
    $contact = $_GET["contact"];
    $password = $_GET["password"];
    $generatedOTP = $_GET["otp"];
} else {
    // If any of the values are missing, redirect to the form page
    header("Location: form_page.php");
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $enteredOTP = $_POST["otp"];

    // Verify OTP
    if ($enteredOTP == $generatedOTP) {
        header("Location: another_page.php");
        exit;
    } else {
        echo "<script>alert('Incorrect OTP. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>otp_page</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <div class="container">
    <h1>O.T.P.</h1>
    <p>Please fill O.T.P. for further process</p>
    <hr>
    <label for="O.T.P."><b>O.T.P.</b></label>
    <input type="text" placeholder="Enter O.T.P." name="otp" id="otp" >
    <input type="hidden" name="username" value="<?php echo $username; ?>">
    <input type="hidden" name="email" value="<?php echo $email; ?>">
    <input type="hidden" name="contact" value="<?php echo $contact; ?>">
    <input type="hidden" name="password" value="<?php echo $password; ?>">
    <button type="submit" name="submit" class="registerbtn">Submit</button>
</div>
</form>
</body>
</html>
