<?php
include("../include/db.php");

if(isset($_GET['video_id'])){
    $video_id = $_GET['video_id'];

    $get_video_name_query = "SELECT * FROM videos WHERE id=$video_id";

    $get_video_name = mysqli_query($con, $get_video_name_query);

    $row_video_name = mysqli_fetch_assoc($get_video_name);

    $video_name = $row_video_name['video'];

    $video_thumbnail_name = $row_video_name['video_thumbnail'];

    $thumbnail_path = "../video_thumbnails/$video_thumbnail_name";

    $delete_thumbnail = unlink($thumbnail_path);

    $video_path = "../videos/$video_name";

    $delete_from_folder = unlink($video_path);

    if($delete_thumbnail && $delete_from_folder){
        $delete_video_query = 'DELETE FROM videos WHERE id='.$video_id;

        $delete_video = mysqli_query($con, $delete_video_query);

        if($delete_video){
            echo"<script>window.open('index.php?videos','_self')</script>";
        } else {
            echo "<script>alert('Error deleting video')</script>";
        }
    }
} else {
    echo"<script>alert('Video ID not set')</script>";
}

?>