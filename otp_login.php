<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>otp</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<form action="database_login_otp.php" method="post" onsubmit="return validateForm()">
  <div class="container">
    <h1>Login Form</h1>
    <p>Please fill in this detail to login.</p>
    <hr>
    <label for="Email"><b>Username</b></label>
    <input type="text" placeholder="Enter Email" name="Email" id="Email" >
    <button type="submit" class="registerbtn">Register</button>
</div>
<div class="container signin">
    <p>Sign up with username <a href="login.php">Sign in</a>.</p>
  </div>
</body>
</html>