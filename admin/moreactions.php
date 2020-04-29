<?php
include("../include/db.php");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $get_category_info = "SELECT * FROM categories WHERE id = '$id'";
    
    $run_get_categories = mysqli_query($con, $get_category_info);
    
    $response = [];
    while($row_categories = mysqli_fetch_assoc($run_get_categories)){
        $category_id = $row_categories['id'];
        $category_name = $row_categories['category_name'];
        $category_description = $row_categories['category_description'];
    }
    $response["id"] = $category_id;
    $response["name"] = $category_name;
    $response["description"] = $category_description;
    echo json_encode($response);
}

if(isset($_POST['add_new_cat'])){
    $category_name = $_POST['category_name'];
    $category_description = $_POST['category_description'];

    $insert_cat = "INSERT INTO categories (category_name, category_description) VALUES ('$category_name', '$category_description')";
    $run_insert_cat = mysqli_query($con, $insert_cat);
    if($run_insert_cat){
        echo "success";
    } else {
        echo "Failed";
    }
}

if(isset($_POST['update_cat'])){
    $category_id = $_POST['update_cat'];
    $category_name = $_POST['category_name'];
    $category_description = $_POST['category_description'];

    $update_cat = "UPDATE categories SET category_name = '$category_name', category_description = '$category_description' WHERE id = '$category_id'";
    $run_update_cat = mysqli_query($con, $update_cat);
    if($run_update_cat){
        echo "success";
    } else {
        echo "Failed";
    }
}

if(isset($_POST['change_carousel_photo'])){
    $carousel_id = $_POST['carousel_id'];
    $image_name = $_FILES['image_name']['name'];
    $image_name_tmp = $_FILES['image_name']['tmp_name'];
    move_uploaded_file($image_name_tmp, "../images/carousel/$image_name");
    $change_photo = "UPDATE carousel_images SET image_name = '$image_name' WHERE id = '$carousel_id'";
    $run_change_photo = mysqli_query($con, $change_photo);
    if($run_change_photo){
        echo "success";
    } else {
        echo ("Failed To Change");
    }
}

if(isset($_POST['delete_cat'])){
    $category_id = $_POST['delete_cat'];
    $get_photo_names = "SELECT * FROM photos WHERE category_id = '$category_id'";
    $run_get_name = mysqli_query($con, $get_photo_names);
    while($row_name = mysqli_fetch_assoc($run_get_name)){
        $image_name = $row_name['image_name'];
        $image_path = "../images/$image_name";
        $delete_from_folder = unlink($image_path);
    }
    $delete_photos = "DELETE FROM photos WHERE category_id = '$category_id'";
    $run_delete_photos = mysqli_query($con, $delete_photos);

    $delete_query = "DELETE FROM categories WHERE id = '$category_id'";
    $run_delete_query = mysqli_query($con, $delete_query);
    if($run_delete_photos && $run_delete_query){
        echo "success";
    } else {
        echo "Failed";
    }
}

if(isset($_POST['delete_photos'])){
    $get_photo_names = "SELECT * FROM photos";
    $run_get_name = mysqli_query($con, $get_photo_names);
    while($row_name = mysqli_fetch_assoc($run_get_name)){
        $image_name = $row_name['image_name'];
        $image_path = "../images/$image_name";
        $delete_from_folder = unlink($image_path);
    }
    $delete_photos = "DELETE FROM photos";
    $run_delete_photos = mysqli_query($con, $delete_photos);
    if($run_delete_photos){
        echo "success";
    } else {
        echo "failed";
    }
}

if(isset($_POST['delete_videos'])){
    $get_video_names = "SELECT * FROM videos";
    $run_get_names = mysqli_query($con, $get_video_names);
    while($row_names = mysqli_fetch_assoc($run_get_names)){
        $video_title = $row_names['video'];
        $video_thumbnail = $row_names['video_thumbnail'];
        $thumbnail_path = "../video_thumbnails/$video_thumbnail";
        $video_path = "../videos/$video_title";
        $delete_thumbnail = unlink($thumbnail_path);
        $delete_video = unlink($video_path);
    }
    $delete_videos = "DELETE FROM videos";
    $run_delete_videos = mysqli_query($con, $delete_videos);
    if($run_delete_videos){
        echo "success";
    } else {
        echo "failed";
    }
}
?>