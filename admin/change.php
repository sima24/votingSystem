<?php
session_start();
if (!isset($_SESSION['admin_name'])) {
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Change Password</title>
  <link rel="stylesheet" href="../assets/bootstrap-5/css/bootstrap.min.css">
  <style>
    body {
      background: linear-gradient(135deg, #74ebd5 0%, #9face6 100%);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .card {
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px;
    }
    .btn-primary {
      border-radius: 50px;
      padding: 10px;
      font-weight: 600;
    }
  </style>
</head>
<body>
  <div class="card p-4">
    <div class="text-center mb-3">
      <h3 class="fw-bold"> Change Password</h3>
      <p class="text-muted">Update your account password securely</p>
    </div>
    <form action="change_pass.php" method="post">
      <div class="mb-3">
        <label class="form-label">Old Password</label>
        <input type="password" name="old_password" class="form-control" placeholder="Enter old password" required>
      </div>
      <div class="mb-3">
        <label class="form-label">New Password</label>
        <input type="password" name="new_password" class="form-control" placeholder="Enter new password" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Confirm New Password</label>
        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm new password" required>
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Change Password</button>
      </div>
    </form>
  </div>
</body>
</html>
