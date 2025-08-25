<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Agents</title>
  <link rel="stylesheet" href="../assets/bootstrap-5/css/bootstrap.min.css">
</head>
<?php
include '../db_conn.php';
session_start();
if (!isset($_SESSION['admin_name'])) {
    echo "<script>alert('Please login first'); window.location.href='admin_login.php';</script>";
}
?>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">All Agents</h4>
    </div>
    <div class="card-body">
      <table class="table table-bordered table-striped align-middle text-center">
        <thead class="table-dark">
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Date of Birth</th>
            <th>Party Name</th>
            <th>Symbol</th>
            <th>Image</th>
            <th>status</th>
            <th>Action</th>
          </tr>
        </thead>
        <?php
            $sel="select * from agent";
            $run1=mysqli_query($conn, $sel) or die("query unsuccessful!");
           
        ?>
        <tbody>
         
            <?php
            while( $row = mysqli_fetch_assoc($run1)){
                echo  "<tr>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['dob']."</td>";
                echo "<td>".$row['party_name']."</td>";
                echo "<td><img src='../image/" . $row['symbol'] . "' width='60' height='60' class='rounded-circle border' alt='Symbol'></td>";
                echo "<td><img src='../image/" . $row['image'] . "' width='60' height='60' class='rounded-circle border' alt='Symbol'></td>";
                echo "<td>".$row['status']."</td>";
              echo "<td>
        <a href='edit_agent.php?id={$row['id']}'><button type='button' class='btn btn-success'>Edit</button></a>
        <a href='delete_agent.php?id={$row['id']}' onclick=\"return confirm('Are you sure?')\">
            <button type='button' class='btn btn-danger'>Delete</button>
        </a>
      </td>
              </tr>";

                 
            }
            ?>
             

        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
