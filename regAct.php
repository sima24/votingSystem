<?php
include 'db_conn.php';

$name    = $_POST['name'];
$email   = $_POST['email'];
$password= $_POST['password'];
$dob     = $_POST['dob'];
$mobile  = $_POST['mobile'];
$gender  = $_POST['gender'];
$vill    = $_POST['vill'];
$po      = $_POST['po'];
$ps      = $_POST['ps'];
$dist    = $_POST['dist'];
$state   = $_POST['state'];
$pin     = $_POST['pin'];


$sql1="select * from details where email='{$email}'";
$run1=mysqli_query($conn, $sql1) or die("query unsucessful !");
if(mysqli_num_rows($run1)>0){
    echo "<script> alert('duplicate entry'); window.location.href='index.php'; </script>";
    exit();
}
$sql2="insert into details(name,email,password,dob,mobile,gender,vill,po,ps,dist,state,pin) values('{$name}','{$email}','{$password}','{$dob}','{$mobile}','{$gender}','{$vill}','{$po}','{$ps}','{$dist}','{$state}','{$pin}')";
$run2=mysqli_query($conn, $sql2) or die("query unsucessful !");

echo "<script> alert('Form submitted successfully!'); window.location.href='login.php'; </script>";

?>