<?php
session_start();
if(!isset($_SESSION['email'])){
    echo "<script>window.open('admin_login.php','_self')</script>";
    echo "<script>alert('Please Login')</script>";
} else {
include("../include/db.php");
include("pages/bookings.php");
include("pages/messages.php");
include("pages/mailer.php");
include("pages/photos.php");
include("pages/videos.php");
include("pages/more.php");
include("pages/edit_profile.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.4.0/animate.css">

    <link rel="stylesheet" href="css/style.css">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <title>Farmside Admin</title>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <?php include("sidebar.php"); ?>
        <div id="page-content-wrapper">
            <?php include("navbar.php"); ?>
            <div class="container-fluid">
                <?php
                getBookings();
                getMessages();
                sendMail();
                getPhotos();
                getVideos();
                getActions();
                editProfile();
                ?>
            </div>
        </div>
        <?php include ("footer.php") ?>
    </div>
</body>
</html>
<?php
}
?>