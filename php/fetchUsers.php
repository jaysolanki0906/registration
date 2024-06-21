<?php
$servername = "154.41.233.52";
$username = "u839503646_admin";
$password = "Ads@2024";
$dbname = "u839503646_woodviz";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    $response = array('message' => 'Connection failed: ' . $conn->connect_error);
    http_response_code(500); 
    echo json_encode($response);
    exit(); 
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result === false) {
    $response = array('message' => 'Query failed: ' . $conn->error);
    http_response_code(500); 
    echo json_encode($response);
    $conn->close(); 
    exit(); 
}

$rows = array();
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($rows); 
?>
