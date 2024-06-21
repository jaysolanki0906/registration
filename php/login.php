<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $email_verify = "select * from user where Email_id='$email' OR Username='$email';";
    $res_email_verify = $conn->query($email_verify);
    if ($res_email_verify->num_rows > 0) {
        while ($row = $res_email_verify->fetch_assoc()) {
            $user_id = $row['User_id'];
            $db_password = $row['Password'];
            $name = $row['Username'];
            $role=$row['Role'];
        }
        if (password_verify($db_password,$hashed_password)){ 
            session_start();
            $_SESSION['User_id'] = $user_id;
            $_SESSION['User_name'] = $name;
            echo "<script>alert('logginnned successfully $name');window.location.href='nextpage.php';</script>";
        }else {
            echo "<script>alert('Please enter correct password');window.location.href='/../woodviz/login.php';</script>";
        }
    }else {
            echo "<script>alert('Please enter correct email-id');window.location.href='/../woodviz/login.php';</script>";
        }
}
?>