<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: login.php");
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
      background: #f8f9fa;
      font-family: Arial, sans-serif;
    }
    .card {
      max-width: 450px;
      margin: 80px auto;
      padding: 25px;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    h3 {
      font-weight: 600;
      color: #4e54c8;
    }
    p {
      font-size: 14px;
      color: #666;
    }
    form {
      margin-top: 20px;
    }
    label {
      font-weight: 500;
      margin-bottom: 5px;
    }
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
      outline: none;
    }
    input[type="password"]:focus {
      border-color: #4e54c8;
      box-shadow: 0 0 4px rgba(78, 84, 200, 0.4);
    }
    button {
      background: linear-gradient(to right, #4e54c8, #8f94fb);
      color: white;
      border: none;
      padding: 12px;
      font-size: 16px;
      font-weight: bold;
      border-radius: 25px;
      cursor: pointer;
      width: 100%;
      margin-top: 10px;
      transition: 0.3s;
    }
    button:hover {
      opacity: 0.9;
      transform: scale(1.02);
    }
    .back-link {
      display: block;
      margin-top: 15px;
      text-align: center;
    }
    .back-link a {
      text-decoration: none;
      color: #4e54c8;
      font-weight: 500;
    }
    .back-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="card">
    <div class="text-center mb-3">
      <h3>🔑 Change Password</h3>
      <p>Update your account password securely</p>
    </div>

    <form action="ch_action.php" method="POST">
      <div class="mb-3">
        <label for="old_password">Old Password</label>
        <input type="password" id="old_password" name="old_password" placeholder="Enter old password" required>
      </div><br>

      <div class="mb-3">
        <label for="new_password">New Password</label>
        <input type="password" id="new_password" name="new_password" placeholder="Enter new password" required>
      </div><br>

      <div class="mb-3">
        <label for="confirm_password">Confirm New Password</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password" required>
      </div><br>

      <button type="submit">Change Password</button>
    </form>

    <div class="back-link">
      <a href="dashboard.php">⬅ Back to Dashboard</a>
    </div>
  </div>

</body>
</html>
