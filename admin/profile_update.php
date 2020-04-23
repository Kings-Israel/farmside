<?php
include("../include/db.php");
if(isset($_GET['admin_id'])){
    $id = $_GET['admin_id'];
    $query_details = "SELECT * FROM admins WHERE id = '$id'";
    $run_query = mysqli_query($con, $query_details);
    $response = [];
    while($row_details = mysqli_fetch_array($run_query)){
        $id = $row_details['id'];
        $admin_name = $row_details['admin_name'];
        $admin_email = $row_details['admin_email'];
        $phone_number = $row_details['phone_number'];
        $admin_description = $row_details['description'];
        $admin_photo = $row_details['admin_photo'];
    }

    $response['id'] = $id;
    $response['admin_name'] = $admin_name;
    $response['admin_email'] = $admin_email;
    $response['phone_number'] = $phone_number;
    $response['admin_description'] = $admin_description;

    echo json_encode($response);
}

if(isset($_POST['update_profile'])){
    $admin_id = $_POST['admin_id'];
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_phone_number = $_POST['admin_phone_number'];
    $admin_description = $_POST['admin_description'];

    $insert_admin_data = "UPDATE admins SET admin_name = '$admin_name', admin_email = '$admin_email', phone_number = '$admin_phone_number', description = '$admin_description' WHERE id = '$admin_id'";
    $run_insert_data = mysqli_query($con, $insert_admin_data);
    if($run_insert_data){
        echo "success";
    } else {
        echo "failed";
    }
}

if(isset($_POST['change_photo'])){
    $admin_id = $_POST['admin_id'];
    $get_prev_photo = "SELECT * FROM admins WHERE id = '$admin_id'";
    $run_get_photo = mysqli_query($con, $get_prev_photo);
    $row_photo = mysqli_fetch_assoc($run_get_photo);
    $prev_photo = $row_photo['admin_photo'];
    unlink("../images/admin_photos/$prev_photo");
    $image = $_FILES['admin_photo']['name'];
    $image_tmp = $_FILES['admin_photo']['tmp_name'];

    $move_file = move_uploaded_file($image_tmp, "../images/admin_photos/$image");

    if($move_file){
        $insert_query = "UPDATE admins SET admin_photo = '$image' WHERE id = '$admin_id'";
        $run_insert_query = mysqli_query($con, $insert_query);
        if($run_insert_query){
            echo"<script>window.open('edit_profile.php', '_self')</script>";
        } else {
            echo"<script>alert('Error changing photo')</script>";
        }
    } else {
        echo"<script>alert('Error Moving file')</script>";
    }


}
?>