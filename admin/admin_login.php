<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../assets/bootstrap-5/css/bootstrap.min.css">
    <style>
        .error {
            color: red;
            font-size: 12px;
            font-weight: 600;
        }
    </style>
</head>
<body>
<div class="container">
    <form class="row center-align" id="regi" action="admin_logAct.php" method="post">
        <h1 class="text-danger"> Admin login form</h1>
        
      
        <div class="col-12 ">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
            <span class="error" id="email-err"></span>
        </div>

        <div class="col-12">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="Password" name="password">
            <span class="error" id="password-err"></span>
        </div>


        <div class="col-12 mt-2">
            <button type="submit" class="btn btn-primary" id="submit">Sign in</button>
        </div>
    </form>
</div>

<script src="assets/js/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function () {
    $('#regi').on('submit', function (e) {
        let isValid = true;

        const email = $('#email').val().trim();
        const password = $('#Password').val().trim();

        $('.error').text('');

      
        if (!/^\S+@\S+\.\S+$/.test(email)) {
            $('#email-err').text('Enter a valid email.');
            isValid = false;
        }
        if (password.length < 6) {
            $('#password-err').text('Password must be at least 6 characters.');
            isValid = false;
        }
       

        if (!isValid) {
            e.preventDefault(); // stop submission if errors
        } else {
            alert("please wait !");
            // no preventDefault here → form will submit normally
        }
    });
});

</script>
</body>
</html>
