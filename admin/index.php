<?php
session_start();
if(!isset($_SESSION['email'])){
    echo"<script>window.open('admin_login.php', '_self')</script>";
    echo"<script>alert('Please Login')</script>";
} else {
include("../include/db.php");

function get_category($id){
    global $con;
    $get_category_query = "SELECT * FROM categories WHERE id = $id";
    $get_category = mysqli_query($con, $get_category_query);

    $row_category = mysqli_fetch_array($get_category);

    $category = $row_category['category_name'];
    return $category;
}

$records_per_page = 8;
$page = '';

if(isset($_GET["page"])){
    $page = $_GET["page"];
} else {
    $page = 1;
}

$start_from = ($page - 1)*$records_per_page;

$get_events = "SELECT * FROM bookings ORDER BY id DESC LIMIT $start_from,$records_per_page";

$run_get_events = mysqli_query($con, $get_events);
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">


  <title>Farmside Media -  Admin</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="css/style.css">

</head>

<body>
<div class="d-flex" id="wrapper">

<?php include("sidebar.php") ?>

<!-- Page Content -->
<div id="page-content-wrapper">

  <?php include("navbar.php") ?>

  <div class="container-fluid">
    <h1 class="mt-2">Bookings</h1>
    <table class="table table-striped table-dark">
        <thead>
            <tr>
            <th scope="col">Name</th>
            <th scope="col">Contact</th>
            <th scope="col">Event</th>
            <th scope="col">Event Date</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>

        <?php
        while($row_events = mysqli_fetch_assoc($run_get_events)){
            $mail_id = $row_events['id'];
            $name= $row_events['name'];
            $email = $row_events['email'];
            $event_date = $row_events['event_date'];
            $event_type = $row_events['event_type'];
            $isReviewed = $row_events['is_reviewed'];
        ?>
        <tbody>
            <tr>
                <td><?php echo $name ?></td>
                <td><?php echo $email ?></td>
                <td><?php echo get_category($event_type) ?></td>
                <td><?php echo $event_date ?></td>
                <td>
                    <?php
                    if ($isReviewed == true){
                        ?>
                        <span>Reviewed</span>
                        <?php
                    } else {
                        ?>
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#mail_<?php echo $mail_id ?>">Reply</button>
                    <?php
                    }
                    ?>
                </td>
            </tr>
            <div class="modal fade" id="mail_<?php echo $mail_id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <form action="mailHandler.php" method="POST" id="mailForm" enctype="multipart/form-data" novalidate="novalidate">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5><?php echo $name ?></h5>
                            </div>
                            <div class="modal-body">
                                <input type="number" name="mail_id" value="<?php echo $mail_id ?>">
                                <label for="email"><b>To:</b></label>
                                <input type="email" name="mail_to" id="mail_to" class="form-control" value="<?php echo $email ?>">
                                <label for="subject"><b>Subject:</b></label>
                                <input type="text" name="mail_subject" id="mail_subject" class="form-control" value="<?php echo get_category($event_type) ?>">
                                <label for="message"><b>Message:</b></label>
                                <textarea name="mail_message" id="mail_message" rows="6" class="form-control"></textarea>
                            </div>
                            <div class="modal-footer">
                                <div class="message">
                                    <div id="error_message"></div>
                                </div>
                                <input type="submit" name="send_mail" value="Send" class="btn btn-sm btn-outline-primary">
                                <button class="btn btn-sm btn-outline-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </tbody>
        <?php
        }
        ?>
    </table>
    <nav aria-label="Page Navigation example">
        <ul class="pagination">
        <?php
        $get_all_records = "SELECT * FROM bookings";
        $result = mysqli_query($con, $get_all_records);
        $total_records = mysqli_num_rows($result);
        $total_pages = ceil($total_records/$records_per_page);

        for ($i=1; $i<=$total_pages; $i++){
        ?>
            <li class="page-item"><a class="page-link" href="photos.php?page=<?php echo "$i" ?>"><?php echo"$i" ?></a></li>
        <?php
        }
        ?>
        </ul>
    </nav>
  </div>
</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->
<?php include ("footer.php") ?>
<script src="../js/jquery.validate.js"></script>
<script>
    $("#mailForm").validate({
        errorElement: "div",
        errorLabelContainer: "#error_message",
        rules: {
            mail_id: {
                required: true,
            },
            mail_to: {
                required: true,
            },
            mail_subject: {
                required: true,
            },
            mail_message: {
                required: true,
            },
        },
        messages: {
            mail_to: {
                required: "Please enter an email address",
            },
            mail_subject: {
                required: "Please enter a mail subject",
            },
            mail_message: {
                required: "Mail message required",
            },
        },
        submitHandler: function(form){
            $("#mailForm").ajaxSubmit({
                success: function(response){
                    if(response == 'success'){
                        alert("Success");
                    } else {
                        alert("Failed");
                    }
                },
                error: function(){
                    alert("Error");
                }
            });
            return false;
        }
    });
</script>

</body>

</html>
<?php
}
?>
