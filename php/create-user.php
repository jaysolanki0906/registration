<?php
// Include database connection file
include 'db.php';

// Function to sanitize input data to prevent SQL injection
function sanitizeData($data, $conn) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $conn->real_escape_string($data);
}

// Check if POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $username = sanitizeData($_POST['username'], $conn);
    $fullname = sanitizeData($_POST['fullname'], $conn);
    $email = sanitizeData($_POST['email'], $conn);
    $mobile = sanitizeData($_POST['mobile'], $conn);
    $password = sanitizeData($_POST['password'], $conn);
    $role = sanitizeData($_POST['role'], $conn);

    // Handle permissions
    $permissions = isset($_POST['permissions']) ? $_POST['permissions'] : array();
    $admin = in_array('admin', $permissions) ? 1 : 0;
    $product = in_array('product', $permissions) ? 1 : 0;
    $purchase = in_array('purchase', $permissions) ? 1 : 0;
    $production = in_array('production', $permissions) ? 1 : 0;
    $billing = in_array('billing', $permissions) ? 1 : 0;
    $customer = in_array('customer', $permissions) ? 1 : 0;
    $report = in_array('report', $permissions) ? 1 : 0;

    // Prepare SQL statement using prepared statement
    $stmt = $conn->prepare("INSERT INTO users (username, fullname, email_id, mobile_number, password, role, admin, product, purchase, production, billing, customer, report)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssiiiiiii", $username, $fullname, $email, $mobile, $password, $role, $admin, $product, $purchase, $production, $billing, $customer, $report);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo json_encode(array("message" => "New record created successfully"));
    } else {
        echo json_encode(array("error" => "Error: " . $stmt->error));
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Handle invalid request method
    echo json_encode(array("error" => "Invalid request method"));
}
?>
