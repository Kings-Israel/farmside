<?php
function getPhotos(){
    if(isset($_GET['photos'])){
        global $con;
        $records_per_page = 9;
        $page = '';

        if(isset($_GET["photos"])){
            $page = $_GET["photos"];
        } else {
            $page = 1;
        }

        $start_from = ($page - 1)*$records_per_page;

        $get_photos = "SELECT * FROM photos LIMIT $start_from,$records_per_page";

        $run_get_photos = mysqli_query($con, $get_photos);
        ?>
        <div class="row">
            <div class="col-md-6">
                <div class="row animated slideInDown">
                    <div class="col-sm-3">
                        <h1>Media</h1>
                    </div>
                    <div class="col-sm-9">
                        <h3 class="mr-5 pt-2 animated slideInDown delay-4s" id="media_label">Photos</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6" id="add_media_btn">
                <button type="button" class="btn btn-sm btn-primary p-2 mt-2 animated slideInDown delay-2s" data-toggle="modal" data-target="#addMediaModal">Add Photo</button>
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
                            <button type="button" class="btn btn-outline-secondary btn-rounded btn-md" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                    <!--/.Content-->

                </div>
            </div>
        </div>
    <section id="photos">
        <div id="page-container" class="table-responsive">
            <table class="table table-striped table-dark animated slideInLeft">
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
                    $photo_name = $row_photos['image_name'];
                ?>
                <tbody>
                    <tr>
                        <td><?php echo"$photo_name" ?></td>
                        <td><?php echo get_category($category_id) ?></td>
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
                                        <p><?php echo get_category($category_id) ?></p>
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
                <?php } ?>
            </table>
        </div>
            <div class="navigation">
                <ul class="pagination animated slideInUp delay-3s">
                <?php
                $get_all_records = "SELECT * FROM photos";
                $result = mysqli_query($con, $get_all_records);
                $total_records = mysqli_num_rows($result);
                $total_pages = ceil($total_records/$records_per_page);

                for ($i=1; $i<=$total_pages; $i++){
                ?>
                    <li class="page-item"><a class="page-link" href="index.php?photos=<?php echo "$i" ?>"><?php echo"$i" ?></a></li>
                <?php
                }
                ?>
                </ul>
            </div>
    </section>
<?php
    }
}
?>