
<?php
include '../db_conn.php';
session_start();
if(!isset($_SESSION['admin_name'])){
    echo "<script> alert('at first login'); window.location.href='admin_login.php'; </script>";
}
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/bootstrap-5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


    <style>
      body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f9f6fe;
    }

    .navbar {
      background-color: #6b21a8;
    }

    .navbar-brand, .nav-link {
      color: #fff !important;
    }
    .navbar-brand {
      transition: all 0.3s ease;
    }

    .navbar-brand:hover {
      transform: scale(1.05);
      text-shadow: 0 0 8px rgba(255, 255, 255, 0.3);
    }
    .nav-item{
        font-size:18px;
        font-weight:600;
        padding:0 10px;
    }
    </style>
</head>
<body class="bg-body-tertiary">
    <nav class="navbar navbar-expand-lg">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
      
      <a class="navbar-brand fw-bold d-flex align-items-center gap-2 text-white" href="#">
        <span style="font-family: 'Poppins', sans-serif; font-size: 1.5rem;">
          Online   <span style="color: #facc15;font-size: 1.8rem;">Voting System</span> 
      </a>

      <div class="collapse navbar-collapse ">
        <div class="dropdown ms-auto">
           <img src="../image/<?php echo $_SESSION['admin_img']; ?>" 
            alt="Profile" 
            class="rounded-circle me-2" 
            width="40" height="40">
        
          <button class="btn  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="text-white fs-5"><?php echo $_SESSION['admin_name']; ?>
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">profile</a></li>
            <li><a class="dropdown-item" href="#">change password</a></li>
            <li><a class="dropdown-item" href="logout.php">Log out</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <div class="m-4">
    <h1 class="text-primary">Welcome <span class="text-secondary"><?php echo $_SESSION['admin_name']; ?></span></h1>
   
<!-- nmbasjvbfdahvbasdbaesgbjkaedhasdngbkjgb -->
 <!-- vvdkhjgdbkjgcdjhfdghg -->

  <!-- Dashboard Features Section -->
  <div class="container my-5">
    <div class="row g-4">
      <!-- Agent Count -->
      <div class="col-md-3">
        <div class="card shadow-sm border-0 text-center p-3 h-100">
          <div class="card-body">
            <?php
              $sel="select count(* ) as total from agent";
              $run1=mysqli_query($conn, $sel) or die("query unsuccessful!");
              $row = mysqli_fetch_assoc($run1);
              $agentCount = $row['total'];
            ?>
            <div class="display-5 fw-bold text-primary mb-2"><?php echo $agentCount; ?></div>
           
            <h5 class="card-title">Agent Count</h5>
          </div>
        </div>
      </div>

      <!-- Add Agent -->
      <div class="col-md-3">
         <a href="add_agent.php" style="text-decoration: none; color: white;">
        <div class="card shadow-sm border-0 text-center p-3 h-100">
          <div class="card-body">
           <div class="display-5 fw-bold text-success mb-2">+</div>
            <h5 class="card-title ">Add Agent</h5>
          </div>
        </div>
        </a>
      </div>

      <!-- All Agents -->
      <div class="col-md-3">
        <div class="card shadow-sm border-0 text-center p-3 h-100">
           <a href="all_agent.php" style="text-decoration: none; color: white;">
          <div class="card-body">

            <div class="display-5 fw-bold text-warning mb-2">
              <i class="bi bi-people-fill"></i>
            </div>
           
            <h3 class="card-title text-primary fw-bold ">All Agents</h3>
            <p>show all agents</p>
            
          </div>
          </a>
        </div>
      </div>

      <!-- Result -->
      <div class="col-md-3">
        <div class="card shadow-sm border-0 text-center p-3 h-100">
          <a href="#" style="text-decoration: none; color: white;">
          <div class="card-body">
            <div class="display-5 fw-bold text-danger mb-2">
              <i class="bi bi-bar-chart-fill"></i>
            </div>
            <h3 class="card-title text-primary fw-bold">Result</h3>
            <p>publish result</p>
          </div>
          </a>
        </div>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>
  <script src="assets/js/jquery-3.7.1.min.js"></script>
</body>
</html>