<?php
include("include/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/jquery-ui.css" type="text/css" media="all">

    <link rel="stylesheet" href="css/bootstrap.4.1.1.min.css">
    <link rel="stylesheet" href="css/font-awesome.4.7.0.min.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap-4.1.1.min.js"></script>

    <title>Farmside Media - Videography</title>
</head>
<body>
<section id = "navbar">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="index.php">FARMSIDE MEDIA</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="book.php">BOOK A VIDEOSHOOT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="photography.php">PHOTOGRAPHY</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</section>
<div id="videography-header">
    <h1>VIDEOGRAPHY</h1>
</div>
<div class="videography">
    <div class="container">
        <?php
        $get_videos = "SELECT * FROM videos";

        $run_videos = mysqli_query($con, $get_videos);

        if(mysqli_num_rows($run_videos) <= 0){
            ?>
            <div class="info">
                <h4>Videos will be uploaded soon!!!</h4>
            </div>
            <?php
        } else {

        while($row_videos = mysqli_fetch_array($run_videos)){
            $video_id = $row_videos['id'];
            $video_title = $row_videos['video_title'];
            $video_description = $row_videos['video_description'];
            $video_thumbnail = $row_videos['video_thumbnail'];
            $video = $row_videos['video'];

        ?>
        <div class="row single-video">
            <div class="col-md-5">

                <!--Modal: Name-->
                <div class="modal fade" id="<?php echo"$video_id" ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

                        <!--Content-->
                        <div class="modal-content">

                        <!--Body-->
                            <div class="modal-body mb-0 p-0">
                                <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                                    <video class="embed-responsive-item" controls="controls" src="videos/<?php echo "$video" ?>" allowfullscreen></video>
                                </div>
                            </div>

                            <!--Footer-->
                            <div class="modal-footer justify-content-center">
                                <span class="mr-4">Spread the word!</span>
                                <a type="button" class="btn-floating btn-sm btn-fb"><i class="fa fa-facebook-f"></i></a>
                                <!--Twitter-->
                                <a type="button" class="btn-floating btn-sm btn-tw"><i class="fa fa-twitter"></i></a>
                                <!--Google +-->
                                <a type="button" class="btn-floating btn-sm btn-gplus"><i class="fa fa-google-plus"></i></a>
                                <!--Linkedin-->
                                <a type="button" class="btn-floating btn-sm btn-ins"><i class="fa fa-linkedin"></i></a>

                                <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                        <!--/.Content-->

                    </div>
                </div>
                <!--Modal: Name-->

                <a><img class="img-fluid z-depth-1" src="video_thumbnails/<?php echo "$video_thumbnail" ?>" alt="video" data-toggle="modal" data-target="#<?php echo "$video_id" ?>"></a>

                </div>
                <div class="col-md-7">
                    <div class="video-info">
                        <h3><?php echo "$video_title" ?></h3>
                        <p><?php echo "$video_description" ?></p>
                    </div>
                </div>
        </div>
        <?php
            }
        }
        ?>
    </div>
</div>
<?php
include("footer.php")
?>
<script src="js/script.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/smooth-scroll.js"></script>
<script>
    var scroll = new SmoothScroll('a[href*="#"]');
</script>
<script>
    $(function() {
        $( "#datepicker").datepicker();
    });
</script>
</body>
</html>
<?php
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $event_type = $_POST['event_type'];
    $date = $_POST['date'];

    $add_to_db = "INSERT INTO bookings (name, email, event_type, event_date) VALUES ('$name', '$email', '$event_type', '$date')";

    $run_add = mysqli_query($con, $add_to_db);

    if($run_add){
        echo"<script>window.open('videography.php', '_self')</script>";
    }
}
?>