<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($_GET['type'] === 'categories') {
        $query = "SELECT category_id, description FROM Category";
        $result = $conn->query($query);
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        echo json_encode($categories);
    } else {
        echo json_encode(['error' => 'Invalid request type']);
    }
}
?>