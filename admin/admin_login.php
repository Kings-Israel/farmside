<?php

session_start();

include ("../include/db.php") 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/bootstrap.4.1.1.min.css">

    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="js/ajax.3.0.0.jquery.min.js"></script>
    <script src="../js/bootstrap-4.1.1.min.js"></script>

    <link href="css/register.css" rel="stylesheet">

    <title>Farmside Admin - Login</title>
</head>
<body class="text-center">
    <form class="form-signin" action="admin_login.php" method="POST">
      <h1 class="h3 mb-3 font-weight-normal">Login</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" name="admin_email" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="admin_password" class="form-control" placeholder="Password" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="admin_login">Login</button>
      <div id="message_body">
          <div id="message" class="pt-2" style="display: none"></div>
      </div>
      <p class="mt-5 mb-3">&copy; FARMSIDE MEDIA <?php echo date('Y')?></p>
    </form>
    <script src="js/script.js"></script>
</body>
</html>
<?php
if(isset($_POST['admin_login'])){
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $admin_password = hash('md5', $admin_password);

    $admin_login_query = "SELECT * FROM admins WHERE admin_email = '$admin_email' AND admin_password = '$admin_password'";

    $admin_login = mysqli_query($con, $admin_login_query);

    $check_num_users = mysqli_num_rows($admin_login);

    if($check_num_users == 1){
        $_SESSION['email'] = $admin_email;
        echo"<script>window.open('index.php', '_self')</script>";
    } else {
        echo"
        <script>
        var message = $('#message');
        message.fadeIn('slow');
        message.css('display','block');
        message.html('<h5>You have entered the wrong credentials.<br/>Please try again</h5>');
        message.delay(3000).fadeOut('slow');
        </script>";
    }
}
?>