<?php
session_start();
include '../db_conn.php';
if (!isset($_SESSION['admin_name'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Profile</title>
  <link rel="stylesheet" href="../assets/bootstrap-5/css/bootstrap.min.css">
  <style>
    body {
      background: #f7f9fc;
    }
    .profile-card {
      max-width: 500px;
      margin: 50px auto;
      background: #fff;
      padding: 25px;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .profile-pic {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border-radius: 50%;
      border: 3px solid #4e54c8;
    }
    .btn-save {
      background: linear-gradient(to right, #4e54c8, #8f94fb);
      color: white;
      font-weight: bold;
      border-radius: 25px;
      padding: 10px 20px;
      border: none;
    }
    .btn-save:hover {
      opacity: 0.9;
    }
  </style>
</head>
<body>

<div class="profile-card text-center">
  <h3>✏️ Edit Profile</h3>
  <p>Update your personal information</p>
<?php
$stmt = $conn->prepare("SELECT * FROM admin_details WHERE id = ?");
$stmt->bind_param("s", $_SESSION['id']);  

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}
?>
  <form action="update_profile.php" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
      <img src="../image/<?php echo $row['image']; ?>" alt="Profile Picture" class="profile-pic mb-2" id="preview">
      <div>
        <input type="file" class="form-control" name="profile" id="profile_picture" accept="image/*"
              onchange="previewImage(event)">
      </div>
    </div>

    <div class="mb-3 text-start">
      <label for="name" class="form-label">Full Name</label>
      <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name'] ?>" placeholder="Enter full name" required>
    </div>

    <div class="mb-3 text-start">
      <label for="email" class="form-label">Email Address</label>
      <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email'] ?>" placeholder="Enter email" required>
    </div>

    <div class="mb-3 text-start">
      <label for="phone" class="form-label">Phone Number</label>
      <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $row['phone'] ?>" placeholder="Enter phone number" required>
    </div>

    <button type="submit" class="btn-save w-100">Save Changes</button>
  </form>
</div>

<script>
  // Preview 
  function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
      document.getElementById('preview').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
  }
</script>

</body>
</html>
