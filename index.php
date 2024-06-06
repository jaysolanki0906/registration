<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>main</title>
    <link rel="stylesheet" href="css/main.css">
    <script>
        function validateForm() {
            var username = document.getElementById('Username').value;
            var email = document.getElementById('Email').value;
            var contactInformation = document.getElementById('Contact-information').value;
            var password = document.getElementById('password').value;
            var repeatPassword = document.getElementById('psw-repeat').value;

           
            if (username === '' || email === '' || contactInformation === '' || password === '' || repeatPassword === '') {
                alert('All fields are mandatory');
                return false;
            }

            
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert('Please enter a valid email address');
                return false;
            }

            
            if (isNaN(contactInformation) || contactInformation.length !== 10) {
                alert('Please enter a valid 10-digit phone number');
                return false;
            }

            if (password !== repeatPassword) {
                alert('Passwords do not match');
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
<form action="database.php" method="post" onsubmit="return validateForm()">
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="Username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="Username" id="Username" >

    <label for="Email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="Email" id="Email" >

    <label for="Contact-information"><b>Contact information</b></label>
    <input type="text" placeholder="Contact information" name="Contact-information" id="Contact-information" >

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Password" name="password" id="password" >

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" >
    <hr>

    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
    <button type="submit" class="registerbtn">Register</button>
  </div>

  <div class="container signin">
    <p>Already have an account? <a href="#">Sign in</a>.</p>
  </div>
</form>

</body>
</html>
