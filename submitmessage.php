<?php
include("include/db.php");

$name = $_POST['name'];
$email = $_POST['email'];
$phoneNum = $_POST['phoneNum'];
$message = $_POST['message'];

$add_message = "INSERT INTO messages (name, email, phone_number, message) VALUES ('$name', '$email', '$phoneNum', '$message')";

$run_add_message = mysqli_query($con, $add_message);
?>