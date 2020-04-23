<?php
include("../include/db.php");

$id = $_POST['id'];

if(isset($id))
{
    $get_image_name = "SELECT * FROM photos WHERE id=$id";
    $run_get_image_name = mysqli_query($con, $get_image_name);
    $get_row = mysqli_fetch_assoc($run_get_image_name);

    $image_name = $get_row['image_name'];
    $image_path = "../images/$image_name";

    $delete_from_folder = unlink($image_path);

    if($delete_from_folder){
        $query = "DELETE FROM photos WHERE id=".$id;
        $run_query = mysqli_query($con, $query);
        if ($run_query){
            echo 1;
            exit();
        }
    }
}

?>