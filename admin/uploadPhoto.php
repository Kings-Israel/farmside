<?php
include("../include/db.php");

    $category_id = $_POST['category_id'];

    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

   if(move_uploaded_file($image_tmp, "../images/$image")){
       $add_photo = "INSERT INTO photos (category_id, image_name) VALUES ('$category_id', '$image')";
    
       $run_add_photo = mysqli_query($con, $add_photo);
    
       if($run_add_photo){
           echo"success";
       } else {
           echo"<script>alert('Error Uploading file')</script>";
           echo"<script>window.open('photos.php', '_self')</script>";
       }
   } else {
       echo"<script>alert('Error moving file')</script>";
   }


?>