<?php
include("../include/db.php");

if(isset($_POST['change_carousel_photo'])){
    $carousel_id = $_POST['category_id'];
    $image_name = $_FILES['media']['name'];
    $image_name_tmp = $_FILES['media']['tmp_name'];
    move_uploaded_file($image_name_tmp, "../images/carousel/$image_name");
    $change_photo = "UPDATE carousel_images SET image_name = '$image_name' WHERE id = '$carousel_id'";
    $run_change_photo = mysqli_query($con, $change_photo);
    if($run_change_photo){
        echo('success');
    } else {
        echo ("Failed To Change");
    }
}
?>