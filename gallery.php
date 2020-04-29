<?php
include("include/db.php");
if(isset($_GET['category_id'])){
    $category_id = $_GET['category_id'];
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/gallery-grid.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/baguetteBox.min.css">

    <title>Farmside Media Gallery</title>
    <style>
        li a.nav-link:hover{
            cursor: pointer;
            color: #000;
        }
    </style>
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
                            <a class="nav-link" onclick="window.history.back()">GO BACK</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="book.php">BOOK A DATE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?#contact">CONTACT US</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>
<div class="container gallery-container">
    <?php
    $query = "SELECT category_name FROM categories WHERE id = $category_id";
    $run_query = mysqli_query($con, $query);
    $result = mysqli_fetch_assoc($run_query);
    $category_name = $result['category_name'];
    ?>

    <h1>Gallery - <?php echo $category_name ?></h1>
    
    <div class="tz-gallery">

        <div class="row">
            <?php
            
            $get_photos = "SELECT * FROM photos WHERE category_id = '$category_id' ORDER BY RAND()";

            $run_photos = mysqli_query($con, $get_photos);
            while ($row_photos = mysqli_fetch_assoc($run_photos)){
                $photo_id = $row_photos['id'];
                $photo_category_id = $row_photos['category_id'];
                $photo = $row_photos['image_name'];
                ?>
                <div class="col-sm-6 col-md-4">
                    <a class="lightbox" href="images/<?php echo "$photo" ?>">
                        <img src="images/<?php echo "$photo" ?>" alt="<?php echo "$photo_category_id" ?>">
                    </a>
                </div>
            <?php
            }
            ?>
        </div>

    </div>

</div>
<?php
include("footer.php")
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script src="js/smooth-scroll.js"></script>
<script>
    var scroll = new SmoothScroll('a[href*="#"]');
    baguetteBox.run('.tz-gallery');
</script>
</body>
</html>