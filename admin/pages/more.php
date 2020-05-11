<?php
function getActions(){
    if(isset($_GET["more_actions"])){
        global $con;
        ?>
        <link rel="stylesheet" href="../../css/baguetteBox.min.css">
        <div id="page-container">
            <h1 class="mt-2 animated slideInDown">Advanced Options</h1>
            <div class="row mb-5">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header animated slideInLeft">
                            <h4>Edit Categories</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-dark animated slideInLeft" id="categories_table">
                                <thead>
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <?php
                                $select_categories_query = "SELECT * FROM categories";
                                $select_categories = mysqli_query($con, $select_categories_query);
                                while($row_category = mysqli_fetch_array($select_categories)){
                                    $category_id = $row_category['id'];
                                    $category_name = $row_category['category_name'];
                                    $category_description = $row_category['category_description'];
                                    ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $category_name ?></td>
                                        <td><input type="button" value="Edit" class="btn btn-sm btn-outline-warning edit_category" id="edit_<?php echo $category_id ?>"></td>
                                        <td><input type="button" value="Delete" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#deleteCategory_<?php echo $category_id ?>" id=""></td>
                                    </tr>
                                </tbody>
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
                                <?php
                                }
                                ?>
                            </table>
                            <div class="row animated slideInLeft">
                                <div class="col-md-7">
                                    <h4>Add Or Edit Category Details</h4>
                                </div>
                                <div class="col-md-5">
                                    <div id="message" class="mt-1 mr-4"></div>
                                </div>
                            </div>
                            <form action="#" method="post" id="category_details" class="form-control mt-3 animated slideInLeft">
                                <input type="number" name="category_id" id="category_id" class="form-control" style="display: none">
                                <label for="category" class="form-label">Category Name</label>
                                <input type="text" name="category_name" id="category_name" class="form-control" required>
                                <label for="category_desc" class="form-label">Category Description</label>
                                <textarea name="category_description" id="category_description" rows="8" class="form-control" required></textarea>
                                <input type="submit" class="btn btn-sm btn-outline-secondary mt-2" value="Submit">
                            </form>
                        </div>
                    </div>
                    <div class="quotation_section animated slideInLeft">
                        <div class="card">
                            <div class="card-header"><h4>Quotation</h4></div>
                            <div class="card-body">
                                <h5>Current Quotation</h5>
                                <?php
                                $get_quotations = "SELECT * FROM quotation";
                                $run_get_quotation = mysqli_query($con, $get_quotations);
                                while($row_quotation = mysqli_fetch_array($run_get_quotation)){
                                    $quotation = $row_quotation['quotation'];
                                }
                                echo $quotation;
                                ?>
                                <form action="moreactions.php" method="post" id="quotationForm" class="mt-2">
                                    <label for="upload_quotation"><b>Upload Quotation</b>:</label>
                                    <input type="file" name="quotation" id="quotation" class="form-control">
                                    <input type="submit" name="upload_quotation" value="Submit" class="btn btn-md btn-outline-primary mt-1">
                                    <span class="m-5 pt-5" id="quotationInfo"></span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row delete-media">
                        <div class="col-sm-6">
                            <div class="card animated slideInRight">
                                <div class="card-header"><h4>Delete Photos</h4></div>
                                <div class="card-body" id="delete_photo_info" style="height: 95px"><h5>Click Below to Delete All Photos in The Gallery</h5></div>
                                <div class="card-footer"><button class="btn btn-sm btn-outline-danger" id="delete_photos">Delete All Photos</button></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card delete_video_card animated slideInRight">
                                <div class="card-header"><h4>Delete Videos</h4></div>
                                <div class="card-body" id="delete_video_info" style="height: 95px"><h5>Click Below to Delete All Videos in The Gallery</h5></div>
                                <div class="card-footer"><button class="btn btn-sm btn-outline-danger" id="delete_videos">Delete All Videos</button></div>
                            </div>
                        </div>
                    </div>
                    <h3 class="mt-1 animated slideInRight">Carousel Images</h3>
                    <div class="row">
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
                        <div class="col-sm-6">
                            <div class="card animated slideInRight">
                                <div class="card-header">
                                    <h5>Carousel Image 1</h5>
                                </div>
                                <form action="carousel.php" id="changeCarouselPhoto1" enctype="multipart/form-data" method="POST">
                                    <div class="card-body tz-gallery">
                                        <a class="lightbox" href="../../images/carousel/<?php echo getCarouselPhoto(1) ?>">
                                            <img class="carousel_image_preview" src="../../images/carousel/<?php echo getCarouselPhoto(1) ?>" alt="Image 1">
                                        </a>
                                        <input type="number" name="carousel_id" id="carousel_id" value="1" style="display: none">
                                        <input type="file" name="carousel_photo" id="carousel_photo" class="form-control mt-2 p-1">
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <button type="submit" name="change_carousel_photo" class="btn btn-sm btn-outline-primary">Change Photo</button>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="carousel_upload_status_1 pt-1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card animated slideInRight image_card">
                                <div class="card-header">
                                    <h5>Carousel Image 2</h5>
                                </div>
                                <form action="carousel.php" id="changeCarouselPhoto2" enctype="multipart/form-data" method="POST">
                                    <div class="card-body tz-gallery">
                                        <a class="lightbox" href="../../images/carousel/<?php echo getCarouselPhoto(2) ?>">
                                            <img class="carousel_image_preview" src="../../images/carousel/<?php echo getCarouselPhoto(2) ?>" alt="Image 1">
                                        </a>
                                        <input type="number" name="carousel_id" id="carousel_id" value="2" style="display: none">
                                        <input type="file" name="carousel_photo" id="carousel_photo" class="form-control mt-2 p-1">
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <button type="submit" name="change_carousel_photo" class="btn btn-sm btn-outline-primary">Change Photo</button>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="carousel_upload_status_2 pt-1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card animated slideInRight">
                                <div class="card-header">
                                    <h5>Carousel Image 3</h5>
                                </div>
                                <form action="carousel.php" id="changeCarouselPhoto3" enctype="multipart/form-data" method="POST">
                                    <div class="card-body tz-gallery">
                                        <a class="lightbox" href="../../images/carousel/<?php echo getCarouselPhoto(3) ?>">
                                            <img class="carousel_image_preview" src="../../images/carousel/<?php echo getCarouselPhoto(3) ?>" alt="Image 1">
                                        </a>
                                        <input type="number" name="carousel_id" id="carousel_id" value="3" style="display: none">
                                        <input type="file" name="carousel_photo" id="carousel_photo" class="form-control mt-2 p-1">
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <button type="submit" name="change_carousel_photo" class="btn btn-sm btn-outline-primary">Change Photo</button>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="carousel_upload_status_3 pt-1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card animated slideInRight image_card">
                                <div class="card-header">
                                    <h5>Carousel Image 4</h5>
                                </div>
                                <form action="carousel.php" id="changeCarouselPhoto4" enctype="multipart/form-data" method="POST">
                                    <div class="card-body tz-gallery">
                                        <a class="lightbox" href="../../images/carousel/<?php echo getCarouselPhoto(4) ?>">
                                            <img class="carousel_image_preview" src="../../images/carousel/<?php echo getCarouselPhoto(4) ?>" alt="Image 1">
                                        </a>
                                        <input type="number" name="carousel_id" id="carousel_id" value="4" style="display: none">
                                        <input type="file" name="carousel_photo" id="carousel_photo" class="form-control mt-2 p-1">
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <button type="submit" name="change_carousel_photo" class="btn btn-sm btn-outline-primary">Change Photo</button>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="carousel_upload_status_4 pt-1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
        <script>
            baguetteBox.run('.tz-gallery');
        </script>
        <?php
    }
}
?>