<?php
session_start();
if(!isset($_SESSION['email'])){
    echo"<script>window.open('admin_login.php', '_self')</script>";
    echo"<script>alert('Please Login')</script>";
} else {
include("../include/db.php");
$records_per_page = 8;
$page = '';

if(isset($_GET["page"])){
    $page = $_GET["page"];
} else {
    $page = 1;
}

$start_from = ($page - 1)*$records_per_page;

$get_messages = "SELECT * FROM messages LIMIT $start_from,$records_per_page";

$run_get_messages = mysqli_query($con, $get_messages);

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">


  <title>Farmside Media -  Admin</title>

    <link rel="stylesheet" href="../css/bootstrap.4.1.1.min.css">
    <link rel="stylesheet" href="../css/font-awesome.4.7.0.min.css">

    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="js/ajax.3.0.0.jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap-4.1.1.min.js"></script>

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
    <h1 class="mt-2">Messages</h1>
    <table class="table table-striped table-dark">
        <thead>
            <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <?php
        while($row_messages=mysqli_fetch_array($run_get_messages)){
            $message_id = $row_messages['id'];
            $user_name = $row_messages['name'];
            $user_email = $row_messages['email'];
            $user_phone_number = $row_messages['phone_number'];
            $message = $row_messages['message'];
        ?>
        <tbody>
            <tr>
                <td><?php echo "$user_name" ?></td>
                <td><?php echo "$user_email" ?></td>
                <td>#<?php echo "$user_phone_number" ?></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown button
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#<?php echo "$message_id" ?>">View Message</a>
                            <a class="dropdown-item" href="#">Mark As Read</a>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
        </tbody>
        <div class="modal fade" id="<?php echo "$message_id" ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">

                <!--Content-->
                <div class="modal-content">

                    <!--Header-->
                    <div class="modal-header justify-content-center">
                        <h2><?php echo "$user_name" ?></h2>
                    </div>

                    <!--Body-->
                    <div class="modal-body">
                        <p><?php echo "$message" ?></p>
                    </div>

                    <!--Footer-->
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>
                    </div>

                </div>
                <!--/.Content-->

            </div>
        </div>
        <?php } ?>
    </table>
    <div class="navigation">
        <ul class="pagination">
        <?php
        $get_all_records = "SELECT * FROM messages";
        $result = mysqli_query($con, $get_all_records);
        $total_records = mysqli_num_rows($result);
        $total_pages = ceil($total_records/$records_per_page);

        for ($i=1; $i<=$total_pages; $i++){
        ?>
            <li class="page-item"><a class="page-link" href="messages.php?page=<?php echo "$i" ?>"><?php echo"$i" ?></a></li>
        <?php
        }
        ?>
        </ul>
    </div>
  </div>
</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->
    <?php include ("footer.php") ?>

</body>

</html>
<?php
}
?>

