<?php
include('../db_conn.php');
session_start(); 
$admin_id=$_SESSION['id'];
$name     = $_POST['name'];
$email    = $_POST['email'];
$phone    = $_POST['phone'];

$image = null;

if (isset($_FILES['profile']) && $_FILES['profile']['error'] == 0) {
    
    $imageName = $_FILES['profile']['name'];
    $imageTmp  = $_FILES['profile']['tmp_name'];
    $imgPath   = "../image/$imageName";

    if (move_uploaded_file($imageTmp, $imgPath)) {
        $image = $imageName;
    }
}


if ($image) {
    $stmt = $conn->prepare("UPDATE admin_details SET name=?, email=?, phone=?, image=? WHERE id=?");
    $stmt->bind_param("ssssi", $name, $email, $phone, $image, $admin_id);
} else {
    $stmt = $conn->prepare("UPDATE admin_details SET name=?, email=?, phone=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $email, $phone, $admin_id);
}

if ($stmt->execute()) {
   echo "<script>
         alert('Profile updated successfully!');
         window.location.href='admin.php';
      </script>";

} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
