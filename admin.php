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

// Fetch all users
$sql = "SELECT * FROM register";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/main.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .container {
            margin: 20px;
        }
        .btn {
            padding: 10px 15px;
            margin: 5px;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn.delete {
            background-color: #f44336;
        }
        .btn.update {
            background-color: #008CBA;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Admin Panel</h1>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Contact Information</th>
                <th>Account Creation Date</th>
                <th>Last Login</th>
                <th>Verified</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["Username"] . "</td>";
                    echo "<td>" . $row["Email"] . "</td>";
                    echo "<td>" . $row["Contact_information"] . "</td>";
                    echo "<td>" . $row["Account_creation_date"] . "</td>";
                    echo "<td>" . $row["Last_login"] . "</td>";
                    echo "<td>" . $row["varify"] . "</td>";
                    echo "<td>
                            <a href='update_user.php?id=" . $row["Id"] . "' class='btn update'>Update</a>
                            <a href='delete_user.php?id=" . $row["Id"] . "' class='btn delete' onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No users found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php
$conn->close();
?>
