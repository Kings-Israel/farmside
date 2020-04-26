<?php
session_start();
if(!isset($_SESSION['email'])){
    echo"<script>window.open('admin_login.php', '_self')</script>";
    echo"<script>alert('Please Login')</script>";
} else {
include("../include/db.php");
$email = $_SESSION['email'];
$get_admin_id = "SELECT * FROM admins WHERE admin_email = '$email'";
$run_admin_id = mysqli_query($con, $get_admin_id);
while($row_details = mysqli_fetch_assoc($run_admin_id)){
    $admin_id = $row_details['id'];
    $admin_photo = $row_details['admin_photo'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.4.1.1.min.css">
    <link rel="stylesheet" href="../css/font-awesome.4.7.0.min.css">
    <link rel="stylesheet" href="css/animate..3.7.2.css">

    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="js/ajax.3.0.0.jquery.min.js"></script>
    <script src="js/jquery.4.2.2.form.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap-4.1.1.min.js"></script>

    <link rel="stylesheet" href="css/style.css">
    <title>Edit Profile</title>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <?php include("sidebar.php") ?>
        <div id="page-content-wrapper">
            <?php include("navbar.php") ?>
            <div class="container-fluid pb-5">
                <h1 class="mt-2">Edit Profile</h1>
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Details</h3>
                    </div>
                    <div class="card-body" id="admin_form_card">
                        <div class="row">
                            <div class="col-lg-8">
                                <form action="profile_update.php" method="POST" id="admin_details" enctype="multipart/form-data">
                                    <input type="number" name="admin_id" id="admin_id" style="display: none" value="<?php echo $admin_id ?>">
                                    <label for="Name"><b>Name</b></label>
                                    <input type="text" name="admin_name" class="form-control" id="admin_name" placeholder="Enter Name">
                                    <label for="email"><b>Email</b></label>
                                    <input type="email" name="admin_email" class="form-control" id="admin_email" placeholder="Enter Email">
                                    <label for="admin_phone_number"><b>Phone Number</b></label>
                                    <input type="number" name="admin_phone_number" class="form-control" id="admin_phone_number" placeholder="Enter Phone Number (070xxxxxxx)">
                                    <label for="description"><b>About Me</b></label>
                                    <textarea name="admin_description" class="form-control" id="admin_description" rows="6"></textarea>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="submit" id="update_profile" name="update_profile" value="Submit" class="btn btn-md btn-outline-primary mt-3">
                                        </div>
                                        <div class="col-md-8">
                                            <div id="error_message" class="text-danger mt-3"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-4">
                                <div class="preview ml-5 mt-3">
                                    <h5 class="ml-5">Current Profile Photo</h5>
                                    <img src="../images/admin_photos/<?php echo $admin_photo ?>" alt="Image">
                                </div>
                                <form action="profile_update.php" method="post" enctype="multipart/form-data" class="mt-4">
                                    <input type="number" name="admin_id" id="admin_id" style="display: none" value="<?php echo $admin_id ?>">
                                    <label for="admin_photo"><b>Choose a photo</b></label>
                                    <input type="file" name="admin_photo" class="form-control" id="admin_photo">
                                    <input type="submit" name="change_photo" value="Change Photo" class="btn btn-md btn-outline-primary mt-3">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include ("footer.php") ?>
    </div>
    <script src="../js/jquery.validate.js"></script>
    <script>
    //Get details and fill in form
    $("#admin_form_card").ready(function(){
        var id = $("#admin_id").val();

        $.ajax({
            url: 'profile_update.php',
            method: 'GET',
            data: {'admin_id': id},
            success: function(response){
                response1 = JSON.parse(response);
                $("#admin_name").val(response1['admin_name']);
                $("#admin_email").val(response1['admin_email']);
                $("#admin_phone_number").val(response1['phone_number']);
                $("#admin_description").val(response1['admin_description']);
            }
        });
    });

    $.validator.addMethod("phoneRegex", function(value, element){
        return this.optional(element) || /^\s*(?:\+?((254|0)?))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/.test(value);
    }, "Please Enter A valid phone Number");

    $("#admin_details").validate({
        errorElement: "div",
        errorLabelContainer: "#error_message",
        rules: {
            admin_name: {
                required: true,
            },
            admin_email: {
                required: true,
            },
            admin_phone_number: {
                required: true,
                phoneRegex: true,
            },
            admin_description: {
                required: true,
            },
        },
        messages: {
            admin_name: {
                required: 'Please Enter Your Name',
            },
            admin_email: {
                required: 'Please Enter Your Email',
            },
            admin_phone_number: {
                required: 'Please Enter your phone Number',
            },
            admin_description: {
                required: "Enter Your Bio please",
            },
        },

        submitHandler: function(form){
            $("#admin_details").ajaxSubmit({
                success: function(response){
                    if(response == 'success'){
                        window.open('logout.php', '_self');
                        alert("Please login");
                    } else {
                        alert("Error")
                    }
                }
            });
            return false;
        }
    });
    </script>
</body>
</html>
<?php
}
?>