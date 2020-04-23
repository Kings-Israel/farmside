<?php
session_start();
if(!isset($_SESSION['email'])){
    echo"<script>window.open('admin_login.php', '_self')</script>";
    echo"<script>alert('Please Login')</script>";
} else {
include("../include/db.php");
$records_per_page = 9;
$page = '';

if(isset($_GET["page"])){
    $page = $_GET["page"];
} else {
    $page = 1;
}

$start_from = ($page - 1)*$records_per_page;

$get_photos = "SELECT * FROM photos LIMIT $start_from,$records_per_page";

$run_get_photos = mysqli_query($con, $get_photos);

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
      border-radius: 4px;
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
                            <h3 class="mr-5 pt-3">Photos</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" id="add_media_btn">
                    <button type="button" class="btn btn-sm btn-primary p-2 mt-3" data-toggle="modal" data-target="#addMediaModal">Add Photo</button>
                </div>
                <div class="modal fade" id="addMediaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">

                            <!--Content-->
                            <div class="modal-content">

                                <!--Header-->
                                <div class="modal-header">
                                    <h2>Add Photo</h2>
                                </div>

                                <!--Body-->
                                <div class="modal-body justify-content-center">
                                    <form class="form" action="uploadPhoto.php" method="POST" enctype="multipart/form-data" id="uploadMedia">
                                        <label for="select_category">Select Category</label>
                                        <select name="category_id" id="category_id" class="form-control">
                                            <?php
                                            $select_categories_query = "SELECT * FROM categories";
                                            $select_categories = mysqli_query($con, $select_categories_query);
                                            while($row_category = mysqli_fetch_array($select_categories)){
                                            ?>
                                            <option value="<?php echo $row_category['id'] ?>"><?php echo $row_category['category_name'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label for="image">Choose Photo</label>
                                        <input type="file" name="image" id="media" class="form-control" accept=".jpg, .png, .jpeg" required>
                                        <input type="submit" value="Submit" class="btn btn-outline-primary btn-rounded mt-2 mb-2">
                                    </form>
                                    <div id="progress-div">
                                        <div id="progress-bar"></div>
                                        <div id="status"></div>
                                    </div>
                                </div>
                                <!--Footer-->
                                <div class="modal-footer justify-content-center pt-2">
                                    <button type="button" class="btn btn-outline-primary btn-rounded btn-md" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                            <!--/.Content-->

                        </div>
                    </div>
            </div>
            <section id="photos">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                        <th scope="col">Photo</th>
                        <th scope="col">Category</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <?php
                    while ($row_photos = mysqli_fetch_assoc($run_get_photos)){
                        $photo_id = $row_photos['id'];
                        $category_id = $row_photos['category_id'];
                        $category_query = "SELECT * FROM categories WHERE id = '$category_id'";
                        $get_category = mysqli_query($con, $category_query);
                        $row_categories = mysqli_fetch_array($get_category);
                        $category = $row_categories['category_name'];
                        $photo_name = $row_photos['image_name'];
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo"$photo_name" ?></td>
                            <td><?php echo"$category" ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item"><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#<?php echo"$photo_id" ?>">View Image</button></a>
                                        <span class="dropdown-item delete_photo" id="del_<?php echo "$photo_id" ?>">Delete</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <form action="#" method="post">
                    <div class="modal fade" id="<?php echo"$photo_id" ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

                            <!--Content-->
                            <div class="modal-content">

                                <!--Header-->
                                <div class="modal-header">
                                    <h3>Details</h3>
                                </div>

                                <!--Body-->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 class="form-label">Photo</h4>
                                            <p><?php echo "$photo_name" ?></p>
                                            <h4>Category</h4>
                                            <p><?php echo "$category" ?></p>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="image-preview">
                                                <img src="../images/<?php echo"$photo_name" ?>" alt="Image">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--Footer-->
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                            <!--/.Content-->

                        </div>
                    </div>
                    </form>
                    <?php } ?>
                    </table>
                <div class="navigation">
                    <ul class="pagination">
                    <?php
                    $get_all_records = "SELECT * FROM photos";
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
                </div>
            </section>
        </div>
    </div>
</div>
<!-- /#wrapper -->
<?php include ("footer.php") ?>
</div>
</body>
</html>
<?php
}
?>
