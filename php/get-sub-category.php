<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($_GET['type'] === 'subcategories' && isset($_GET['category_id'])) {
        $category_id = $conn->real_escape_string($_GET['category_id']);
        $query = "SELECT sub_category_id, description FROM SubCategory";
        $result = $conn->query($query);
        $subcategories = [];
        while ($row = $result->fetch_assoc()) {
            $subcategories[] = $row;
        }
        echo json_encode($subcategories);
    } else {
        echo json_encode(['error' => 'Invalid request type']);
    }
}
?>