<?php
include '../db_conn.php';

$name=$_POST['name'];
$dob=$_POST['dob'];
$email=$_POST['email'];
$party_name=$_POST['party_name'];
 $status=$_POST['status'];


$symbolName = $_FILES['symbol']['name'];
$symbolTemp  = $_FILES['symbol']['tmp_name'];
$SymbolPath ="../image/".$symbolName;


$imageName = $_FILES['image']['name'];
$imageTemp  = $_FILES['image']['tmp_name'];
$imagePath ="../image/".$imageName;


    if (move_uploaded_file($imageTemp, $imagePath) && move_uploaded_file($symbolTemp, $SymbolPath)) {
        $sql = "insert into agent(name, dob, email, party_name, symbol, image, status) values('{$name}', '{$dob}', '{$email}', '{$party_name}', '{$symbolName}', '{$imageName}', '{$status}')";
        echo "Status: ".$stat;
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Agent added successfully'); window.location.href='admin.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Failed to upload image.";
    }



?>