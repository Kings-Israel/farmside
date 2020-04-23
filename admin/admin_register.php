<?php include ("../include/db.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">

    <link href="css/register.css" rel="stylesheet">

    <title>Farmside Admin - Register</title>
</head>
<body class="text-center">
    <form class="form-signin" action="admin_register.php" method="POST">
      <h1 class="h3 mb-3 font-weight-normal">Register</h1>
      <label for="admin_name" class="sr-only">Name</label>
      <input type="text" id="admin_name" name="admin_name" class="form-control" placeholder="Name" required autofocus>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" name="admin_email" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="admin_password" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="admin_register">Register</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
</body>
</html>
<?php
if(isset($_POST['admin_register'])){
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $admin_password = hash('md5', $admin_password);

    $admin_register_query = "INSERT INTO admins (admin_name, admin_email, admin_password) VALUES ('$admin_name', '$admin_email', '$admin_password')";

    $admin_register = mysqli_query($con, $admin_register_query);

    if($admin_register){
        echo"<script>alert('Admin added to DB')</script>";
        echo"<script>window.open('admin_register.php', '_self')</script>";
    } else {
        echo"<script>alert('Error adding admin')</script>";
    }
}
?>