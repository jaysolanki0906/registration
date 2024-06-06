<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dummy_project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted for updating
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $username = $_POST['Username'];
    $email = $_POST['Email'];
    $contact_information = $_POST['Contact_information'];
    $account_creation_date = $_POST['Account_creation_date'];
    $last_login = $_POST['Last_login'];
    $varify = $_POST['varify'];

    $username = htmlspecialchars(stripslashes(trim($username)));
    $email = htmlspecialchars(stripslashes(trim($email)));
    $contact_information = htmlspecialchars(stripslashes(trim($contact_information)));
    $account_creation_date = htmlspecialchars(stripslashes(trim($account_creation_date)));
    $last_login = htmlspecialchars(stripslashes(trim($last_login)));
    $varify = htmlspecialchars(stripslashes(trim($varify)));

    $stmt = $conn->prepare("UPDATE register SET Username = ?, Email = ?, Contact_information = ?, Account_creation_date = ?, Last_login = ?, varify = ? WHERE id = ?");
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssssssi", $username, $email, $contact_information, $account_creation_date, $last_login, $varify, $id);

    if ($stmt->execute()) {
        echo "Record updated successfully";
        header("Location: admin.php");
        exit;
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch the user details to populate the form
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT Username, Email, Contact_information, Account_creation_date, Last_login, varify FROM register WHERE id = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($username, $email, $contact_information, $account_creation_date, $last_login, $varify);
    $stmt->fetch();
    $stmt->close();
} else {
    echo "No user ID specified.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<div class="container">
    <h1>Update User</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="Username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="Username" id="Username" value="<?php echo htmlspecialchars($username); ?>" required>

        <label for="Email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="Email" id="Email" value="<?php echo htmlspecialchars($email); ?>" required>

        <label for="Contact_information"><b>Contact Information</b></label>
        <input type="text" placeholder="Enter Contact Information" name="Contact_information" id="Contact_information" value="<?php echo htmlspecialchars($contact_information); ?>" required>

        <label for="Account_creation_date"><b>Account Creation Date</b></label><br>
        <input type="date" name="Account_creation_date" id="Account_creation_date" value="<?php echo htmlspecialchars($account_creation_date); ?>" ><br>

        <label for="Last_login"><b>Last Login</b></label><br>
        <input type="datetime-local" name="Last_login" id="Last_login" value="<?php echo htmlspecialchars($last_login); ?>" ><br>

        <label for="varify"><b>Verify</b></label><br>
        <select name="varify" id="varify" >
            <option value="yes" <?php if ($varify == "yes") echo "selected"; ?>>Yes</option>
            <option value="no" <?php if ($varify == "no") echo "selected"; ?>>No</option>
        </select>

        <button type="submit" class="registerbtn">Update</button>
    </form>
</div>
</body>
</html>
