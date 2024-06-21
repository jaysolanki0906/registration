
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

<?php
header('Content-Type: application/json');

include 'db.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT User_id, username, fullname, email_id, mobile_number FROM users";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();
echo json_encode($data);
?>
