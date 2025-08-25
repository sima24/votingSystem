<?php
session_start();
include '../db_conn.php';
if (!isset($_SESSION['admin_name'])) {
    echo "<script>alert('Please login first'); window.location.href='login.php';</script>";
}
$id = $_GET['id'];
$sql= "select * from agent where id='{$id}'";
$run= mysqli_query($conn, $sql);

if(mysqli_num_rows($run)>0){
    $row=mysqli_fetch_assoc($run);
}else{
    echo "no data found";
}

if(isset($_POST['update_agent'])){
    $name=$_POST['name'];
    $dob=$_POST['dob'];
    $email=$_POST['email'];
    $party_name=$_POST['party_name'];
    $status=$_POST['status'];

    $sym=$_POST['old_sym'];
    $img=$_POST['old_img'];

    // print_r($_FILES);
    // exit();

    if(isset($_FILES['symbol']) && $_FILES['symbol']['error'] == 0){
        $sym=$_FILES['symbol']['name'];    
    }

    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
        $img=$_FILES['image']['name'];
    }

    $sql2= "update agent set name='{$name}', email='{$email}', dob='{$dob}', party_name='{$party_name}', symbol='{$sym}', image='{$img}', status='{$status}' where id='{$id}' ";
    $run2= mysqli_query($conn, $sql2);
    if($run2){
        if(isset($_FILES['symbol']) && $_FILES['symbol']['error'] == 0){
            $sym_tmp=$_FILES['symbol']['tmp_name'];
            $filepath='../image/'. $sym;
            move_uploaded_file($sym_tmp, $filepath);
            unlink('../image/'.$_POST['old_sym']);
        }

        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){ 
            $img_tmp=$_FILES['image']['tmp_name'];
            $filepath='../image/'. $img;
            move_uploaded_file($sym_tmp, $filepath);
            unlink('../image/'.$_POST['old_img']);
        }
        echo "<script> alert('details updated successfully!'); window.location.href='all_agent.php';</script>";
    }else{
        echo "<script> alert('query unsuccessful!'); window.location.href='all_agent.php';</script>";
    }

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
      <form action="" method="POST" enctype="multipart/form-data">

        <!-- Name -->
        <div class="mb-3">
          <label class="form-label">Agent Name</label>
          <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>">
        </div>

        <!-- Date of Birth -->
        <div class="mb-3">
          <label class="form-label">Date of Birth</label>
          <input type="date" name="dob" class="form-control" value="<?php echo $row['dob']; ?>">
        </div>

        <!-- Email -->
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>">
        </div>

        <!-- Party Name -->
        <div class="mb-3">
          <label class="form-label">Party Name</label>
          <input type="text" name="party_name" class="form-control" value="<?php echo $row['party_name']; ?>">
        </div>

        <!-- Symbol -->
        <div class="mb-3">
      <img src="../image/<?php echo $row['symbol']; ?>" alt="Profile Picture" class="profile-pic mb-2" id="preview_sym" height="140px" width="140px">
      <div>
        <input type="hidden" value="<?php echo $row['symbol']; ?>" name="old_sym" id="">
        <input type="file" class="form-control" name="symbol" id="profile_picture" accept="image/*"
              onchange="previewImage(event,'preview_sym')">
      </div>
    </div>

        <!-- Image -->
       <div class="mb-3">
        <input type="hidden" value="<?php echo $row['image']; ?>" name="old_img" id="">
      <img src="../image/<?php echo $row['image']; ?>" alt="Profile Picture" class="profile-pic mb-2" id="preview_img" height="140px" width="140px" >
      <div>
        <input type="file" class="form-control" name="image" id="profile_picture" accept="image/*"
              onchange="previewImage(event, 'preview_img')">
      </div>
    </div>
      <!-- status -->
        <select name="status" class="form-control" >
          <?php
            if($row['status'] == 'active'){
              echo "<option value='Active' selected>Active</option>";
              echo "<option value='disactive'>Inactive</option>";
            }else{
              echo "<option value='disactive' selected>Inactive</option>";
              echo "<option value='Active'>Active</option>";

            }
          ?>
        </select>


        <!-- Submit Button -->
        <div class="text-end">
          <button type="submit" class="btn btn-success" name="update_agent">Update Agent</button>
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
