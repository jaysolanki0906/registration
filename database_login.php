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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST['Username'];
    $input_password = $_POST['password'];

    $input_username = htmlspecialchars(stripslashes(trim($input_username)));
    $input_password = htmlspecialchars(stripslashes(trim($input_password)));

    // Prepare and bind
    $stmt = $conn->prepare("SELECT pass, login_type FROM register WHERE Username = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $stmt->bind_result($stored_hashed_password, $login_type);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($input_password, $stored_hashed_password)) {
        $_SESSION['username'] = $input_username;
        
        // Update last_login field with the current time
        $current_time = date('Y-m-d H:i:s');
        $update_stmt = $conn->prepare("UPDATE register SET Last_login = ? WHERE Username = ?");
        if (!$update_stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $update_stmt->bind_param("ss", $current_time, $input_username);
        if (!$update_stmt->execute()) {
            die("Update failed: " . $update_stmt->error);
        }
        $update_stmt->close();
        
        if ($login_type == 'admin') {
            header("Location: admin.php"); // Redirect to admin page
        } else {
            header("Location: another_page.php"); // Redirect to user page
        }
        exit;
    } else {
        echo "<script>alert('Incorrect username or password. Please try again.');</script>";
    }
}

$conn->close();
?>
