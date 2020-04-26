<?php
//Send Mail to Client
function sendMail(){
    if(isset($_GET['send_mail'])){
        global $con;
        $mail_id = $_GET['send_mail'];

        $get_booking_info = "SELECT * FROM bookings WHERE id = '$mail_id'";
        $run_get_booking_info = mysqli_query($con, $get_booking_info);
        while($row_info = mysqli_fetch_array($run_get_booking_info)){
            $mail_name = $row_info['name'];
            $mail_address = $row_info['email'];
            $event = $row_info['event_type'];
            $event_date = $row_info['event_type'];
        }
        ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-modal@0.9.2/jquery.modal.min.css">
        <h1 class="animated slideInDown delay-2s">Mail Client</h1>
        <div id="page-container" class="container animated slideInRight">
            <form action="mailHandler.php" method="POST" id="mailForm" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <h5><b><?php echo $mail_name ?></b></h5>
                    </div>
                    <div class="card-body">
                        <input type="number" name="mail_id" id="mail_id" value="<?php echo $mail_id ?>" class="form-control" style="display: none">
                        <label for="mail_address"><b>To</b>:</label>
                        <input type="email" name="mail_address" id="mail_address" value="<?php echo $mail_address ?>" class="form-control">
                        <label for="mail_subject"><b>Subject</b>:</label>
                        <input type="text" name="mail_subject" id="mail_subject" value="<?php echo get_category($event) ?>" class="form-control">
                        <label for="mail_message"><b>Message</b>:</label>
                        <textarea name="mail_message" id="mail_message" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="card-footer">
                        <div class="message" style="float: right">
                            <div id="info_area"></div>
                        </div>
                        <input type="submit" name="send_mail" id="send_mail" value="Send" class="btn btn-sm btn-outline-primary">
                        <button type="button" id="cancel_btn" onclick="window.history.back()" class="btn btn-sm btn-outline-secondary">Cancel</button>
                    </div>
                </div>
            </form>
            <div id="mail_info" style="display: none">
                <a href="#close-modal" rel="modal:close" class="close-modal ">Close</a>
            </div>
        </div>
        <?php
    }
}
?>