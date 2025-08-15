<?php
include 'db_conn.php';

$email   = $_POST['email'];
$password= $_POST['password'];


$sql1="select * from details where email='{$email}'";
$run1=mysqli_query($conn, $sql1) or die("query unsucessful !");
if(mysqli_num_rows($run1)>0){
   
    $row=mysqli_fetch_assoc($run1);
    if ($password === $row['password']) {
        session_start();
        $_SESSION['name'] = $row['name'];
       header("Location: dashboard.php");
        exit;
    } else {
        echo "<script>
            alert('Invalid password');
            window.location.href = 'login.php';
        </script>";
    }
} else {
    echo "<script>
        alert('No data found');
        window.location.href = 'login.php';
    </script>";
}
?>