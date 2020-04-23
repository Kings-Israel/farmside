<?php

include ("include/db.php");

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

    <link rel="stylesheet" href="css/baguetteBox.min.css">

    <title>Farmside Media - Photography</title>
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
                        <a class="nav-link" href="book.php">BOOK A PHOTOSHOOT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="videography.php">VIDEOGRAPHY</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</section>
<div id="photography-header">
    <h1>PHOTOGRAPHY</h1>
</div>
<div class="photography">
    <div class="container">
        <?php
        $get_categories_query = "SELECT * FROM categories";
        $get_categories = mysqli_query($con, $get_categories_query);
        while($row_categories = mysqli_fetch_assoc($get_categories)){
            $category_id = $row_categories['id'];
            $category_name = $row_categories['category_name'];
        ?>
        <section id="portrait">
            <h2><?php echo $category_name ?></h2>
            <div class="container-fluid tz-gallery">
                <div class="row">
                    <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="1000">
                        <div class="carousel-inner row w-100 mx-auto" role="listbox">
                            <?php
                            $get_portrait_photos = "SELECT * FROM photos WHERE category_id = '$category_id' ORDER BY RAND()";

                            $run_portrait_photos = mysqli_query($con, $get_portrait_photos);

                            if(mysqli_num_rows($run_portrait_photos) <= 0) {
                                ?>
                                <div class="info">
                                    <h4>Photos will be added soon!!!</h4>
                                </div>
                                <?php
                            } else {

                            while ($row_portrait_photos = mysqli_fetch_assoc($run_portrait_photos)){
                                $photo_id = $row_portrait_photos['id'];
                                $photo_category_id = $row_portrait_photos['category_id'];
                                $photo_name = $row_portrait_photos['image_name'];

                            ?>
                            <div class="carousel-item col-md-3 active">
                                <a class="lightbox" href="images/<?php echo "$photo_name" ?> ">
                                    <img class="img-fluid mx-auto d-bloc" src="images/<?php echo "$photo_name" ?>" alt='<?php $photo_category ?>'>
                                </a>
                            </div>
                            <?php
                            }
                        }
                        ?>
                        </div>
                    </div>
                </div>
                <h4 class="gallery-link" style="float: right"><a href=<?php echo "gallery.php?category_id=$category_id" ?>>See More</a></h4>
            </div>
        </section>
        <?php
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
<script src="js/baguetteBox.min.js"></script>
<script>
    var scroll = new SmoothScroll('a[href*="#"]');
    baguetteBox.run('.tz-gallery');
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
        echo"<script>window.open('photography.php', '_self')</script>";
    }
}
?>