<?php
include("../include/db.php");
// require "includes/PHPMailer-5.2-stable/PHPMailerAutoload.php";

// if(isset($_POST['send_mail'])){
//     $mail_id = $_POST['mail_id'];
//     $mailTo = $_POST['mail_to'];
//     $mailSub = $_POST['mail_subject'];
//     $mailMsg = $_POST['mail_message'];
//     $mail = new PHPMailer();
//     $mail ->isSMTP();
//     $mail ->SMTPDebug = 0;
//     $mail ->SMTPAuth = true;
//     $mail ->SMTPSecure = 'ssl';
//     $mail ->Host = "smtp.gmail.com";
//     $mail ->Port = 465;
//     $mail ->isHTML(true);
//     $mail ->Username = "milimokings@gmail.com";
//     $mail ->Password = "kingsisraelmilimo";
//     $mail ->setFrom("milimokings@gmail.com");
//     $mail ->Subject = $mailSub;
//     $mail ->Body = $mailMsg;
//     $mail ->addAddress($mailTo);

//     if(!$mail ->send()){
//         echo"Mail not Sent";
//     } else {
//         $change_status = "UPDATE bookings SET is_reviewed = '1' WHERE id = '$mail_id'";
//         $run_change_status = mysqli_query($con, $change_status);
//         if($run_change_status){
//             echo "success";
//         } else {
//             echo "Error Changing Status";
//         }
//     }
// }

if(isset($_POST['send_mail'])){
    $mail_id = $_POST['mail_id'];
    $mailTo = $_POST['mail_to'];
    $mailSub = $_POST['mail_subject'];
    $mailMsg = $_POST['mail_message'];

    $change_status = "UPDATE bookings SET is_reviewed = '1' WHERE id = '$mail_id'";
    $run_change_status = mysqli_query($con, $change_status);
    if($run_change_status){
        echo "success";
    } else {
        echo "Failed";
    }
}
?>