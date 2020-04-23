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

$get_videos = "SELECT * FROM videos LIMIT $start_from,$records_per_page";

$run_videos = mysqli_query($con, $get_videos);
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Farmside Media - Admin</title>

    <link rel="stylesheet" href="../css/bootstrap.4.1.1.min.css">
    <link rel="stylesheet" href="../css/font-awesome.4.7.0.min.css">

    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="js/ajax.3.0.0.jquery.min.js"></script>
    <script src="js/jquery.4.2.2.form.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap-4.1.1.min.js"></script>

  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="css/style.css">

  <style>
  #progress-div {
    border: 1px solid #05F;
    border-radius: 5px;
    height: 36px;
  }

  #progress-bar {
      background-color: #34A747;
      color: #fff;
      border-radius: 5px;
      height: 34px;
      width: 0%;
      -webkit-transition: width .3s;
      -moz-transition: width .3s;
      transition: width .3s;
  }
  </style>

</head>

<body>
<div class="d-flex" id="wrapper">

<!-- Sidebar -->
<?php include("sidebar.php") ?>
<!-- /#sidebar-wrapper -->

<!-- Page Content -->
<div id="page-content-wrapper">

<?php include("navbar.php") ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-sm-3">
                        <h1 class="mt-2">Media</h1>
                    </div>
                    <div class="col-sm-9">
                        <h3 class="mr-5 pt-3">Videos</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6" id="add_media_btn">
                <button type="button" class="btn btn-sm btn-primary p-2 mt-2 mr-2" data-toggle="modal" data-target="#addMediaModal">Add Video</button>
            </div>
        </div>
        <div class="modal fade" id="addMediaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

                <!--Content-->
                <div class="modal-content">

                    <!--Header-->
                    <div class="modal-header">
                        <h2>Add Video</h2>
                    </div>

                    <!--Body-->
                    <div class="modal-body">
                        <form class="form" action="uploadVideo.php" method="POST" enctype="multipart/form-data" id="uploadMedia" >
                        
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="video_title" class="form-label">Video Title</label>
                                    <input type="text" name="video_title" class="form-control" required>
                                    <label for="video_thumbnail" class="form-label">Video Thumbnail</label>
                                    <input type="file" name="video_thumbnail" class="form-control" required>
                                    <label for="video" class="form-label">Video</label>
                                    <input type="file" name="video" id="media" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="video_description">Video Description</label>
                                    <textarea name="video_description" rows="5" class="form-control"></textarea>
                                    <input type="submit" value="Submit" class="btn btn-outline-primary btn-rounded mt-4 mb-4">
                                </div>
                            </div>
                        </form>
                        
                        <div id="progress-div">
                            <div id="progress-bar"></div>
                            <div id="status"></div>
                        </div>
                    </div>

                    <!--Footer-->
                    <div class="modal-footer justify-content-center pt-2">
                        <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>
                    </div>

                </div>
                <!--/.Content-->

            </div>
        </div>
        <section id="videos">
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                    <th scope="col">Video Title</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <?php
                while($row_videos=mysqli_fetch_assoc($run_videos)){
                    $video_id = $row_videos['id'];
                    $video_title = $row_videos['video_title'];
                    $video_description = $row_videos['video_description'];
                    $video_thumbnail = $row_videos['video_thumbnail'];
                    $video = $row_videos['video'];
                ?>
                <tbody>
                    <tr>
                        <td><?php echo"$video_title" ?></td>
                        <td>
                            <a><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#<?php echo"$video_id" ?>">View Details</button></a>
                        </td>
                    </tr>
                </tbody>
                    <div class="modal fade" id="<?php echo"$video_id" ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">

                            <!--Content-->
                            <div class="modal-content">

                                <!--Header-->
                                <div class="modal-header">
                                    <h3><?php echo"$video_title" ?></h3>
                                </div>

                                <!--Body-->
                                <div class="modal-body">
                                    <p><?php echo"$video_description" ?></p>
                                    <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                                        <video class="embed-responsive-item" controls="controls" src="../videos/<?php echo "$video" ?>" allowfullscreen></video>
                                    </div>
                                </div>

                                <!--Footer-->
                                <div class="modal-footer justify-content-center">
                                    <a href="delete_video.php?video_id=<?php echo"$video_id" ?>"><button type="button" class="btn btn-danger btn-rounded btn-md ml-4">Delete Video</button></a>
                                    <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                            <!--/.Content-->

                        </div>
                    </div>
                    
                <?php
                }
                ?>
            </table>
            <div class="navigation">
                    <ul class="pagination">
                    <?php
                    $get_all_records = "SELECT * FROM videos";
                    $result = mysqli_query($con, $get_all_records);
                    $total_records = mysqli_num_rows($result);
                    $total_pages = ceil($total_records/$records_per_page);

                    for ($i=1; $i<=$total_pages; $i++){
                    ?>
                        <li class="page-item"><a class="page-link" href="video.php?page=<?php echo "$i" ?>"><?php echo"$i" ?></a></li>
                    <?php
                    }
                    ?>
                    </ul>
                </div>
            
        </section>
    </div>
</div>
</div>
<?php include ("footer.php") ?>
</body>
</html>
<?php
}
?>