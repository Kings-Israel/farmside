<?php
function editProfile(){
    if(isset($_GET['profile'])){
        global $con;
        $email = $_SESSION['email'];
        $get_admin_id = "SELECT * FROM admins WHERE admin_email = '$email'";
        $run_admin_id = mysqli_query($con, $get_admin_id);
        while($row_details = mysqli_fetch_assoc($run_admin_id)){
            $admin_id = $row_details['id'];
            $admin_name = $row_details['admin_name'];
            $admin_email = $row_details['admin_email'];
            $phone_number = $row_details['phone_number'];
            $admin_bio = $row_details['description'];
            $admin_photo = $row_details['admin_photo'];
        }
        ?>
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-modal@0.9.2/jquery.modal.min.css">
        <div id="page-container">
            <h1 class="mt-2 animated slideInDown">Edit Profile</h1>
            <div class="card">
                <div class="card-header">
                    <h3>Edit Details</h3>
                    <div id="mail_info" style="display: none">
                        <a href="#close-modal" rel="modal:close" class="close-modal ">Close</a>
                    </div>
                </div>
                <div class="card-body" id="admin_form_card">
                    <div class="row">
                        <div class="col-lg-8 animated slideInLeft">
                            <form action="profile_update.php" method="POST" id="admin_details" enctype="multipart/form-data">
                                <input type="number" name="admin_id" id="admin_id" style="display: none" value="<?php echo $admin_id ?>">
                                <label for="Name"><b>Name</b></label>
                                <input type="text" name="admin_name" class="form-control" id="admin_name" placeholder="Enter Name">
                                <label for="email"><b>Email</b></label>
                                <input type="email" name="admin_email" class="form-control" id="admin_email" placeholder="Enter Email">
                                <label for="admin_phone_number"><b>Phone Number</b></label>
                                <input type="number" name="admin_phone_number" class="form-control" id="admin_phone_number" placeholder="Enter Phone Number (070xxxxxxx)">
                                <label for="description"><b>About Me</b></label>
                                <textarea name="admin_description" class="form-control" id="admin_description" rows="7"></textarea>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="submit" id="update_profile" name="update_profile" value="Submit" class="btn btn-md btn-outline-primary mt-3">
                                    </div>
                                    <div class="col-md-8">
                                        <div id="info_area" class="text-danger mt-3"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-4 animated slideInRight">
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
        <script>

        </script>
        <?php
    }
}
?>