<?php
session_start();
if(!isset($_SESSION['email'])){
    echo"<script>window.open('admin_login.php', '_self')</script>";
    echo"<script>alert('Please Login')</script>";
} else {
include("../include/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

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
    <title>Farmside Media</title>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <?php include("sidebar.php") ?>

        <div id="page-content-wrapper">
            <?php include("navbar.php") ?>

            <div class="container-fluid pb-5">
                <h1 class="mt-2">Advanced Options</h1>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Categories</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-dark" id="categories_table">
                                    <thead>
                                        <tr>
                                            <th>Category Name</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $select_categories_query = "SELECT * FROM categories";
                                        $select_categories = mysqli_query($con, $select_categories_query);
                                        while($row_category = mysqli_fetch_array($select_categories)){
                                            $category_id = $row_category['id'];
                                            $category_name = $row_category['category_name'];
                                            $category_description = $row_category['category_description'];
                                        ?>
                                        <tr>
                                            <td><?php echo $category_name ?></td>
                                            <td><input type="button" value="Edit" class="btn btn-sm btn-outline-warning edit_category" id="edit_<?php echo $category_id ?>"></td>
                                            <td><input type="button" value="Delete" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#deleteCategory_<?php echo $category_id ?>" id=""></td>
                                            <div class="modal fade" id="deleteCategory_<?php echo $category_id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm modal-dialog-centered" role="dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body justify-content-center">
                                                            <h3>Are you sure?</h3>
                                                            <h5>This will delete all photos in this category!</h5>
                                                        </div>
                                                        <div class="modal-footer justify-content-center">
                                                            <input type="button" value="Delete" class="btn btn-sm btn-outline-danger delete_category" id="del_<?php echo $category_id ?>">
                                                            <input type="button" value="Cancel" class="btn btn-sm btn-outline-success" data-dismiss="modal">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-7">
                                        <h4>Add Or Edit Category Details</h4>
                                    </div>
                                    <div class="col-md-5">
                                        <div id="message" class="mt-1 mr-4"></div>
                                    </div>
                                </div>
                                <form action="#" method="post" id="category_details" class="form-control mt-3">
                                    <input type="number" name="category_id" id="category_id" class="form-control" style="display: none">
                                    <label for="category" class="form-label">Category Name</label>
                                    <input type="text" name="category_name" id="category_name" class="form-control" required>
                                    <label for="category_desc" class="form-label">Category Description</label>
                                    <textarea name="category_description" id="category_description" rows="8" class="form-control" required></textarea>
                                    <input type="submit" class="btn btn-sm btn-outline-secondary mt-2" value="Submit">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-header"><h4>Delete Photos</h4></div>
                                    <div class="card-body" id="delete_photo_info" style="height: 95px"><h5>Click Below to Delete All Photos in The Gallery</h5></div>
                                    <div class="card-footer"><button class="btn btn-sm btn-outline-danger" id="delete_photos">Delete All Photos</button></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-header"><h4>Delete Videos</h4></div>
                                    <div class="card-body" id="delete_video_info" style="height: 95px"><h5>Click Below to Delete All Videos in The Gallery</h5></div>
                                    <div class="card-footer"><button class="btn btn-sm btn-outline-danger" id="delete_videos">Delete All Videos</button></div>
                                </div>
                            </div>
                        </div>
                        <h3 class="mt-1">Carousel Images</h3>
                        <div class="row">
                            <table class="table table-striped" style="width: 98%">
                                <thead>
                                    <th>Image Name</th>
                                    <th>Change</th>
                                </thead>
                                <?php
                                $get_images = 'SELECT * FROM carousel_images';
                                $run_get_images = mysqli_query($con, $get_images);
                                while($row_images = mysqli_fetch_assoc($run_get_images)){
                                    $image_id = $row_images['id'];
                                    $image_name = $row_images['image_name'];
                                ?>
                                <tbody>
                                    <tr>
                                        <td class="image_name"><?php echo $image_name ?></td>
                                        <td><button class="btn btn-sm btn-outline-primary change_carousel_photo" data-toggle="modal" data-target=".<?php echo $image_id ?>" id="">Change</button></td>
                                    </tr>
                                </tbody>
                                <div class="modal fade <?php echo $image_id ?>" id="addMediaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            
                                        <!--Content-->
                                        <div class="modal-content">
            
                                            <!--Header-->
                                            <div class="modal-header">
                                                <h2>Change Photo</h2>
                                            </div>
            
                                            <!--Body-->
                                            <div class="modal-body justify-content-center">
                                                <form class="form" action="carousel.php" method="POST" enctype="multipart/form-data" id="uploadMedia">
                                                    <input type="number" name="category_id" id="category_id" style="display: none" value="<?php echo $image_id ?>">
                                                    <label for="image">Choose Photo</label>
                                                    <input type="file" name="media" id="media" class="form-control" accept=".jpg, .png, .jpeg" required>
                                                    <input type="submit" value="Submit" class="btn btn-outline-primary btn-rounded mt-2 mb-2">
                                                </form>
                                                <div id="progress-div">
                                                    <div id="progress-bar"></div>
                                                    <div id="status"></div>
                                                </div>
                                            </div>
                                            <!--Footer-->
                                            <div class="modal-footer justify-content-center pt-2">
                                                <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-2" data-dismiss="modal">Close</button>
                                            </div>
            
                                        </div>
                                        <!--/.Content-->
            
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include ("footer.php") ?>
    </div>
</body>
</html>
<?php
}
?>