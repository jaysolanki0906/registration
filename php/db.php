<?php
$servername = "154.41.233.52";
$username = "u839503646_admin";
$password = "Ads@2024";
$dbname = "u839503646_woodviz";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>