
<?php
session_start();
if(!isset($_SESSION['name'])){
    echo "<script> alert('at first login'); window.location.href='login.php'; </script>";
}
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/bootstrap-5/css/bootstrap.min.css">

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
          Online<span style="color: #facc15;font-size: 1.8rem;">Voting System</span> 
      </a>

      <div class="collapse navbar-collapse ">
        <div class="dropdown ms-auto">
          <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown button
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
    <h1 class="text-primary">Welcome <span class="text-secondary"><?php echo $_SESSION['name']; ?></span></h1>
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse deleniti optio nesciunt doloremque itaque dolores maxime aspernatur? Cum neque saepe ratione minima fugiat. Consequatur accusamus cumque voluptatibus dolores voluptas sapiente iste, optio sed suscipit possimus doloremque labore, non est ipsam maiores. In, accusamus. Dignissimos sunt doloremque perferendis, veritatis labore voluptas?</p>
    <a href="#"><button type="button" class="btn btn-primary btn-lg">Give Vote</button></a>
    <a href="#"><button type="button" class="btn btn-secondary btn-lg">Show Result</button></a>
  </div>
  

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>
  <script src="assets/js/jquery-3.7.1.min.js"></script>
</body>
</html>
