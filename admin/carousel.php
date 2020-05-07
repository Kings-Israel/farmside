<?php
include("../include/db.php");

if(isset($_POST['change_carousel_photo'])){
    $carousel_id = $_POST['carousel_id'];
    $get_prev_photo = "SELECT * FROM carousel_images WHERE id = '$carousel_id'";
    $run_get_photo = mysqli_query($con, $get_prev_photo);
    $row_photo = mysqli_fetch_assoc($run_get_photo);
    $prev_photo = $row_photo['image_name'];
    $delete_prev_photo = unlink("../images/carousel/$prev_photo");
    if($delete_prev_photo){
        $image_name = $_FILES['carousel_photo']['name'];
        $image_name_tmp = $_FILES['carousel_photo']['tmp_name'];
        $move_new_photo = move_uploaded_file($image_name_tmp, "../images/carousel/$image_name");
        if($move_new_photo){
            $change_photo = "UPDATE carousel_images SET image_name = '$image_name' WHERE id = '$carousel_id'";
            $run_change_photo = mysqli_query($con, $change_photo);
            if($run_change_photo){
                echo "success";
            } else {
                echo "failed";
            }
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }
}
?>