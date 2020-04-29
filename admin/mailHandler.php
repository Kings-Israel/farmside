<?php
include ("../include/db.php");
require "includes/PHPMailer-5.2-stable/PHPMailerAutoload.php";

if(isset($_POST['send_mail'])){
    $mail_id = $_POST['mail_id'];
    $mailTo = $_POST['mail_address'];
    $mailSub = $_POST['mail_subject'];
    $mailMsg = $_POST['mail_message'];
    $mail = new PHPMailer();
    $mail ->isSMTP();
    $mail ->SMTPDebug = 0;
    $mail ->SMTPAuth = true;
    $mail ->SMTPSecure = 'ssl';
    $mail ->Host = "smtp.gmail.com";
    $mail ->Port = 465;
    $mail ->isHTML(true);
    $mail ->Username = "milimokings@gmail.com";
    $mail ->Password = "kingsisraelmilimo";
    $mail ->setFrom("milimokings@gmail.com", "Kings Milimo");
    $mail ->Subject = $mailSub;
    $mail ->Body = $mailMsg;
    $mail ->addAddress($mailTo);

    if($mail->send()){
        $change_status = "UPDATE bookings SET is_reviewed = '1' WHERE id = '$mail_id'";
        $run_change_status = mysqli_query($con, $change_status);
        if($run_change_status){
            echo "success";
        } else {
            echo "Error Changing Status";
        }
    } else {
        echo "failed";
    }
}

if(isset($_POST['reply_message'])){
    $message_id = $_POST['message_id'];
    $mailTo = $_POST['message_address'];
    $mailSub = $_POST['message_subject'];
    $mailMsg = $_POST['message'];
    $mail = new PHPMailer();
    $mail ->isSMTP();
    $mail ->SMTPDebug = 0;
    $mail ->SMTPAuth = true;
    $mail ->SMTPSecure = 'ssl';
    $mail ->Host = "smtp.gmail.com";
    $mail ->Port = 465;
    $mail ->isHTML(true);
    $mail ->Username = "milimokings@gmail.com";
    $mail ->Password = "kingsisraelmilimo";
    $mail ->setFrom("milimokings@gmail.com", "Kings Milimo");
    $mail ->Subject = $mailSub;
    $mail ->Body = $mailMsg;
    $mail ->addAddress($mailTo);

    if($mail->send()){
        $change_status = "UPDATE messages SET is_reviewed = '1' WHERE id = '$message_id'";
        $run_change_status = mysqli_query($con, $change_status);
        if($run_change_status){
            echo "success";
        } else {
            echo "Error Changing Status";
        }
    } else {
        echo "failed";
    }
}

if(isset($_GET['mark_read'])){
    $message_id = $_GET['mark_read'];

    $change_status = "UPDATE messages SET is_reviewed = '1' WHERE id = '$message_id'";
    $run_change_status = mysqli_query($con, $change_status);
    if($run_change_status){
        echo "<script>window.open(window.history.back(), '_self')</script>";
    } else {
        alert("Error Changing Status");
    }
}
?>