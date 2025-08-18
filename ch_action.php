<?php
include 'db_conn.php';
session_start();


if (!isset($_SESSION['name'])) {
    echo "<script>alert('Please login first'); window.location.href='login.php';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old_pass     = $_POST['old_password'];
    $new_pass     = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];

    // Validate
    if (empty($old_pass) || empty($new_pass) || empty($confirm_pass)) {
        echo "<script>alert('All fields are required'); window.location.href='ch_pass.php';</script>";
        exit();
    }

    if ($new_pass !== $confirm_pass) {
        echo "<script>alert('New passwords do not match the confirm password'); window.location.href='ch_pass.php';</script>";
        exit();
    }

    $stmt = $conn->prepare("SELECT password FROM details WHERE name = ?");
    $stmt->bind_param("s", $_SESSION['name']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($old_pass !== $row['password']) {
            echo "<script>alert('Old password is incorrect'); window.location.href='ch_pass.php';</script>";
            exit();
        }

        
        $stmt_update = $conn->prepare("UPDATE details SET password = ? WHERE name = ?");
        $stmt_update->bind_param("ss", $new_pass, $_SESSION['name']);
        
        if ($stmt_update->execute()) {
            echo "<script>alert('Password changed successfully'); window.location.href='dashboard.php';</script>";
        } else {
            echo "<script>alert('Failed to change password'); window.location.href='ch_pass.php';</script>";
        }

        $stmt_update->close();
    }

    $stmt->close();
    $conn->close();
}
?>
