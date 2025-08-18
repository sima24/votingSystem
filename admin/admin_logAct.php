<?php
// include '../db_conn.php';

// $email   = $_POST['email'];
// $password= $_POST['password'];


// $sql1="select * from admin_details where email='{$email}'";
// $run1=mysqli_query($conn, $sql1) or die("query unsucessful !");
// if(mysqli_num_rows($run1)>0){
   
//     $row=mysqli_fetch_assoc($run1);
//     if ($password === $row['password']) {
//         session_start();
//         $_SESSION['admin_name'] = $row['name'];
//         $_SESSION['admin_img']= $row['image'];
//         echo "<script>
//             alert('Details found');
//             window.location.href = 'admin.php';
//         </script>";
//     } else {
//         echo "<script>
//             alert('Invalid password');
//             window.location.href = 'admin_login.php';
//         </script>";
//     }
// } else {
//     echo "<script>
//         alert('No data found');
//         window.location.href = 'admin_login.php';
//     </script>";
// }
?>


<?php
include '../db_conn.php';

$email    = $_POST['email'];
$password = $_POST['password'];


$stmt = $conn->prepare("SELECT * FROM admin_details WHERE email = ?");
$stmt->bind_param("s", $email); 


$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if ($password === $row['password']) {
        session_start();
        $_SESSION['admin_name'] = $row['name'];
        $_SESSION['admin_img']  = $row['image'];
        $_SESSION['id']=$row['id'];

        echo "<script>
            alert('Details found');
            window.location.href = 'admin.php';
        </script>";
    } else {
        echo "<script>
            alert('Invalid password');
            window.location.href = 'admin_login.php';
        </script>";
    }
} else {
    echo "<script>
        alert('No data found');
        window.location.href = 'admin_login.php';
    </script>";
}


$stmt->close();
$conn->close();
?>
