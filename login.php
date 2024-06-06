<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<form action="database_login.php" method="post" onsubmit="return validateForm()">
  <div class="container">
    <h1>Login Form</h1>
    <p>Please fill in this detail to login.</p>
    <hr>
<label for="Username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="Username" id="Username" >
    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Password" name="password" id="password" >
    <button type="submit" class="registerbtn">Register</button>
</div>
<div class="container signin">
    <p>Sign up with otp <a href="otp_login.php">Sign in</a>.</p>
  </div>
</body>
</html>