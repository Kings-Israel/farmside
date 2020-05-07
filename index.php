<?php
 include("include/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/indexpage.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-modal@0.9.2/jquery.modal.min.css">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.js"></script>

    <title>Farmside Media</title>
</head>
<body>
    <section id = "navbar">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="#top">FARMSIDE MEDIA</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="book.php">BOOK A DATE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">ABOUT US</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#portfolio">PORTFOLIO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">CONTACT US</a>
                    </li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>
    <section id="carousel">
        <?php
        function getCarouselPhoto($id){
            global $con;
            $get_images = "SELECT * FROM carousel_images WHERE id='$id'";
            $run_get_images = mysqli_query($con, $get_images);
            $row_images = mysqli_fetch_assoc($run_get_images);
            $image_name = $row_images['image_name'];
            return $image_name;
        }
        ?>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" id="homepage-carousel" data-interval="10000">
                    <img src="images/carousel/<?php echo getCarouselPhoto(1) ?>" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" id="homepage-carousel" data-interval="5000">
                    <img src="images/carousel/<?php echo getCarouselPhoto(2) ?>" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" id="homepage-carousel" data-interval="5000">
                    <img src="images/carousel/<?php echo getCarouselPhoto(3) ?>" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" id="homepage-carousel" data-interval="5000">
                    <img src="images/carousel/<?php echo getCarouselPhoto(4) ?>" class="d-block w-100" alt="...">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    <section id="about">
        <div class="container">
            <h1>GET TO KNOW US</h1>
            <div class="row">
                <?php
                $admin_details = "SELECT * FROM admins WHERE id = '4'";
                $run_admin_details = mysqli_query($con, $admin_details);
                while($row_admin_details = mysqli_fetch_array($run_admin_details)){
                    $admin_name = $row_admin_details['admin_name'];
                    $admin_phone_number = $row_admin_details['phone_number'];
                    $admin_info = $row_admin_details['description'];
                    $admin_photo = $row_admin_details['admin_photo'];
                ?>
                <div class="col-md-8">
                    <div class="about-text">
                        <h3><?php echo $admin_name ?></h3>
                        <p><?php echo $admin_info ?></p>
                    </div>
                </div>
                <div class="col-md-4" id="admin_photo">
                    <img src="images/admin_photos/<?php echo $admin_photo ?>" class="d-block w-100" alt="...">
                </div>
                <?php
                }
                ?>
            </div>
            <div class="row">
            <?php
                $admin_details = "SELECT * FROM admins WHERE id = '6'";
                $run_admin_details = mysqli_query($con, $admin_details);
                while($row_admin_details = mysqli_fetch_array($run_admin_details)){
                    $admin_name = $row_admin_details['admin_name'];
                    $admin_phone_number = $row_admin_details['phone_number'];
                    $admin_info = $row_admin_details['description'];
                    $admin_photo = $row_admin_details['admin_photo'];
                ?>
                <div class="col-md-4" id="admin_photo">
                    <img src="images/admin_photos/<?php echo $admin_photo ?>" class="d-block w-100" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="about-text">
                        <h3><?php echo $admin_name ?></h3>
                        <p><?php echo $admin_info ?></p>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
    </section>
    <section id="portfolio">
        <div class="container">
            <h1>WHAT WE DO</h1>
            <div class="row">
                <div class="col-md-6">
                    <h2>PHOTOGRAPHY</h2>
                    <hr/>
                    <div class="portfolio-image">
                        <img src="images/photography.jpg" alt="">
                        <h5 class="portfolio-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio blanditiis iusto iure doloribus reiciendis quia
                        expedita necessitatibus illo et minima</h5>
                        <h3><a class="portfolio-link" href="photography.php">See More</a></h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2>VIDEOGRAPHY</h2>
                    <hr/>
                    <div class="portfolio-image">
                        <img src="images/videography.jpg" alt="">
                        <h5 class="portfolio-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio blanditiis iusto iure doloribus reiciendis quia
                        expedita necessitatibus illo et minima</h5>
                        <h3><a class="portfolio-link" href="videography.php">See More</a></h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="contact">
        <div class="container">
            <h1>CONTACT US</h1>
            <div id="info" style="display: none">
                <a href="#close-modal" rel="modal:close" class="close-modal ">Close</a>
            </div>
            <form action="submitmessage.php" method="post" id="messageForm">
                <div class="row pt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Your Name">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email">
                        </div>
                        <div class="form-group">
                            <input type="number" name="phoneNum" id="phoneNum" class="form-control" placeholder="Enter Your Phone Number">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea name="message" id="message" class="form-control" placeholder="Brief Message" rows="4"></textarea>
                        </div>
                        <div class="submit_button">
                            <button type="submit" class="btn btn-primary" id="send_message" name="send_message">SEND MESSAGE</button>
                        </div>
                    </div>
                </div>
            </form>
                <div class="row">
                    <div class="col-md-7">
                        <a href="#"><i class="fa fa-instagram"></i>Farmside media</a>
                        <a href="#"><i class="fa fa-twitter pl-5"></i>Farmside media</a>
                    </div>
                    <div class="col-md-5">
                        <i class="fa fa-phone"></i><span class="phone_numbers mb-5">+254 (0) 796812044 or +254 (0) 708290980</span>
                    </div>
                </div>
            <div class="container" style="height: 20px">
                <div id="errorInfo"></div>
            </div>
        </div>

    </section>
    <?php
        include("footer.php")
    ?>
    <script src="js/jquery-ui.js"></script>
    <script src="js/script.js"></script>
    <script src="js/smooth-scroll.js"></script>
    <script>
        var scroll = new SmoothScroll('a[href*="#"]');
    </script>
</body>
</html>