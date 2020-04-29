<?php
include ("include/db.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="include/dist/css/lightbox.min.css">
    <script src="include/dist/js/lightbox.js"></script>
    <link rel="stylesheet" href="css/style.css">

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
            <div class="container-fluid">
                <div class="row mx-auto my-auto">
                    <div id="myCarousel" class="carousel slide w-100" data-ride="carousel">
                        <div class="carousel-inner w-100" role="listbox">
                            <?php
                            $get_portrait_photos = "SELECT * FROM photos WHERE category_id = '$category_id' ORDER BY RAND() LIMIT 0,5";

                            $run_portrait_photos = mysqli_query($con, $get_portrait_photos);

                            $i=0;
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

                                if($i==0){
                                    ?>
                                    <div class="carousel-item active">
                                        <div class="col-lg-4 col-md-6">
                                            <a class="demo" href="images/<?php echo "$photo_name" ?>" data-lightbox="example-set">
                                                <img class="img-fluid" src="images/<?php echo "$photo_name" ?>" alt='<?php $photo_category ?>'>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                } else {
                                    ?>
                                    <div class="carousel-item">
                                        <div class="col-lg-4 col-md-6">
                                            <a class="demo" href="images/<?php echo "$photo_name" ?>" data-lightbox="example-set">
                                                <img class="img-fluid" src="images/<?php echo "$photo_name" ?>" alt='<?php $photo_category ?>'>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                }
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

<!--scripts loaded here-->

<script src="js/script.js"></script>
<script src="js/smooth-scroll.js"></script>
<script>
    $(document).ready(function(){
        $("#myCarousel").carousel({
        interval: 5000
        });

        $(".carousel .carousel-item").each(function() {
            var minPerSlide = 4;
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));

            for (var i = 0; i < minPerSlide; i++) {
                next = next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }

                next.children(':first-child').clone().appendTo($(this));
            }
        });
    });
</script>
</body>
</html>
