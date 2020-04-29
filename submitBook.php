<?php
include("include/db.php");
if(isset($_POST['book_event'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $event_type = $_POST['event_type'];
    $date = $_POST['datepicker'];
    $is_reviewed = '0';
    
    $add_to_db = "INSERT INTO bookings (name, email, event_type, event_date, is_reviewed) VALUES ('$name', '$email', '$event_type', '$date', '$is_reviewed')";
    
    $run_add = mysqli_query($con, $add_to_db);
    if($run_add){
        echo "success";
    } else {
        echo 'failed';
    }
}
?>