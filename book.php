<?php
include("include/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/jquery-ui.css" type="text/css" media="all">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-modal@0.9.2/jquery.modal.min.css">
    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.js"></script>

    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Farmside Media - Book</title>
</head>
<body>
    <section id = "navbar">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="index.php">FARMSIDE MEDIA</a>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" onclick="window.history.back()">BACK TO PREVIOUS PAGE</a>
                    </li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>
    <section id="enquiry-form">
        <div class="container">
            <h2>BOOK A DATE WITH US</h2>
            <div id="book_info" style="display: none">
                <a href="#close-modal" rel="modal:close" class="close-modal ">Close</a>
            </div>
                <div class="row">
                    <div class="col-md-6 right-box">
                    <form action="submitBook.php" method="POST" id="booking_form">
                            <div class="ferry">
                                <input type="text" name="name" id="name" placeholder="Name" required>
                            </div>
                            <div class="ferry">
                                <input type="email" name="email" id="email" placeholder="Email" required>
                            </div>
                            <div class="dropdown">
                                <select name="event_type" id="event_type">
                                    <option selected>Event Type</option>
                                    <?php
                                    $get_categories_query = "SELECT * FROM categories";
                                    $get_categories = mysqli_query($con, $get_categories_query);
                                    while($row_categories = mysqli_fetch_assoc($get_categories)){
                                        $category_id = $row_categories['id'];
                                        $category_name = $row_categories['category_name'];
                                    ?>
                                        <option id="category" value="<?php echo"$category_id" ?>" required><?php echo"$category_name" ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="ferry">
                                <input class="date" type="text" name="datepicker" id="datepicker" placeholder="Date" autocomplete="off" required>
                            </div>
                            <div class="submit-btn">
                                <input type="submit" name="book_event" id="book_event" value="Submit">
                            </div>
                    </form>
                </div>
                <div class="col-md-6 left-box">
                    <h3 id="category-header">Book Your Photoshoot</h3>
                    <p id="category-details">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor, nunc eget malesuada vehicula, odio ex tempor risus</p>
                    <div class="text-danger" id="info_area"></div>
                </div>
            </div>
        </div>
    </section>
    <?php
        include("footer.php")
    ?>
    <script src="js/script.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script>
        $(function() {
            $( "#datepicker").datepicker();
        });
    </script>
</body>
</html>
