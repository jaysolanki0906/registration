<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<form action="verify_otp_process.php" method="post">
  <div class="container">
    <h1>Verify OTP</h1>
    <p>Please enter the OTP sent to your email.</p>
    <hr>
    <input type="hidden" name="Email" value="<?php echo htmlspecialchars($_GET['email']); ?>">
    <label for="OTP"><b>OTP</b></label>
    <input type="text" placeholder="Enter OTP" name="OTP" id="OTP" required>
    <button type="submit" class="registerbtn">Verify OTP</button>
  </div>
</form>
</body>
</html>
