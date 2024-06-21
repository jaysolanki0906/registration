<?php
// updateUser.php

// Ensure you include database connection
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data from the request
    $userId = $_POST['id'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $permissions = isset($_POST['permissions']) ? $_POST['permissions'] : array();
    $admin = in_array('admin', $permissions) ? 1 : 0;
    $product = in_array('product', $permissions) ? 1 : 0;
    $purchase = in_array('purchase', $permissions) ? 1 : 0;
    $production = in_array('production', $permissions) ? 1 : 0;
    $billing = in_array('billing', $permissions) ? 1 : 0;
    $customer = in_array('customer', $permissions) ? 1 : 0;
    $report = in_array('report', $permissions) ? 1 : 0;

    // Update the user in the database
    $sql = "UPDATE users SET 
            username = ?, 
            fullname = ?, 
            email_id = ?, 
            mobile_number = ?, 
            role = ?, 
            password = ?, 
            admin = ?, 
            product = ?, 
            purchase = ?, 
            production = ?, 
            billing = ?, 
            customer = ?, 
            report = ? 
            WHERE user_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssiiiiiiis', $username, $fullname, $email, $mobile, $role, $password, $admin, $product, $purchase, $production, $billing, $customer, $report, $userId);
    
    if ($stmt->execute()) {
        echo json_encode(['message' => 'User updated successfullyyyyyyyyyyyyyyyyyyyyyyy']);
    } else {
        echo json_encode(['error' => 'Failed to update user']);
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
