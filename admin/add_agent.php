<?php
session_start();
if (!isset($_SESSION['admin_name'])) {
    echo "<script>alert('Please login first'); window.location.href='login.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Agent</title>
  <link rel="stylesheet" href="../assets/bootstrap-5/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Add New Agent</h4>
    </div>
    <div class="card-body">
      <form action="agent_insert.php" method="POST" enctype="multipart/form-data">

        <!-- Name -->
        <div class="mb-3">
          <label class="form-label">Agent Name</label>
          <input type="text" name="name" class="form-control" required>
        </div>

        <!-- Date of Birth -->
        <div class="mb-3">
          <label class="form-label">Date of Birth</label>
          <input type="date" name="dob" class="form-control" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <!-- Party Name -->
        <div class="mb-3">
          <label class="form-label">Party Name</label>
          <input type="text" name="party_name" class="form-control" required>
        </div>

        <!-- Symbol -->
        <div class="mb-3">
          <label class="form-label">Symbol</label>
          <input type="file" name="symbol" class="form-control" accept="image/*"  required onChange="previewImage(event,'previewSymbol1')">
          <img id="previewSymbol1" class="d-none" height="120px" width="120px" alt="" >
        </div>

        <!-- Image -->
        <div class="mb-3">
          <label class="form-label">Agent Image</label>
          <input type="file" name="image" class="form-control" accept="image/*" required onChange="previewImage(event,'previewSymbol2')">
          <img id="previewSymbol2" class="d-none" height="120px" width="120px" alt="" >
        </div>

        <!-- Submit Button -->
        <div class="text-end">
          <button type="submit" class="btn btn-success">Add Agent</button>
          <a href="admin.php" class="btn btn-secondary">Cancel</a>
        </div>

      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function previewImage(event,id) {
        const file = event.target.files[0];
        console.log(file);
        
        const preview = document.getElementById(id);

        if(file){
            preview.src = URL.createObjectURL(file);
            console.log("URL: ",URL.createObjectURL(file));
            localStorage.setItem('image',URL.createObjectURL(file) )
            
            preview.classList.remove('d-none');
        }
        else{
            preview.src = "";
            preview.classList.add('d-none');

        }
        
    }
</script>
</body>
</html>
