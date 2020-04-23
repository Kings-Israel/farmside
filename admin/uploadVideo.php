<?php
include("../include/db.php");

    $video_title = $_POST['video_title'];

    $video_thumbnail = $_FILES['video_thumbnail']['name'];
    $video_thumbnail_tmp = $_FILES['video_thumbnail']['tmp_name'];

    move_uploaded_file($video_thumbnail_tmp, "../video_thumbnails/$video_thumbnail");

    $video = $_FILES['video']['name'];
    $video_tmp = $_FILES['video']['tmp_name'];

    move_uploaded_file($video_tmp, "../videos/$video");

    $video_description = $_POST['video_description'];


    $add_video_query = "INSERT INTO videos (video_title, video_description, video_thumbnail, video) VALUES ('$video_title', '$video_description', '$video_thumbnail', '$video')";

    $add_video = mysqli_query($con, $add_video_query);

    if($add_video){
        echo "success";
    } else {
        echo"<script>alert('Error adding Video')</script>";
    }

?>