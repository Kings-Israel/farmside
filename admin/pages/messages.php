<?php
//Messages
function getMessages(){
    if(isset($_GET['messages'])){
        global $con;

        $page = '';

        $records_per_page = 9;

        if(isset($_GET["messages"])){
            $page = $_GET["messages"];
        } else {
            $page = 1;
        }

        $start_from = ($page - 1)*$records_per_page;

        $get_messages = "SELECT * FROM messages LIMIT $start_from,$records_per_page";

        $run_get_messages = mysqli_query($con, $get_messages);
        ?>
        <h1 class="animated slideInDown delay-2s">Messages</h1>
        <div id="page-container">
            <table class="table table-striped table-dark animated slideInRight">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <?php
                while($row_messages=mysqli_fetch_array($run_get_messages)){
                    $message_id = $row_messages['id'];
                    $user_name = $row_messages['name'];
                    $user_email = $row_messages['email'];
                    $user_phone_number = $row_messages['phone_number'];
                    $message = $row_messages['message'];
                    $is_reviewed = $row_messages['is_reviewed'];
                ?>
                <tbody>
                    <tr>
                        <td><?php echo "$user_name" ?></td>
                        <td><?php echo "$user_email" ?></td>
                        <td>#<?php echo "$user_phone_number" ?></td>
                        <td>
                            <?php
                            if($is_reviewed == true){
                                ?>
                                <span>Reviewed</span>
                                <?php
                            } else {
                                ?>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item">
                                            <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#<?php echo "$message_id" ?>" aria-haspopup="true" aria-expanded="false">
                                                View Message
                                            </button>
                                        </a>
                                        <a class="dropdown-item" href="mailHandler.php?mark_read=<?php echo $message_id ?>"><span>Mark As Read</span></a>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                </tbody>
                
                <div class="modal fade" id="<?php echo "$message_id" ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">

                        <!--Content-->
                        <div class="modal-content">

                            <!--Header-->
                            <div class="modal-header">
                                <h3><?php echo "$user_name" ?></h3>
                                <h5><?php echo $user_phone_number ?></h5>
                            </div>

                            <!--Body-->
                            <div class="modal-body">
                                <p><?php echo "$message" ?></p>
                            </div>

                            <!--Footer-->
                            <div class="modal-footer justify-content-center">
                                <a href="index.php?reply_message=<?php echo $message_id ?>"><button type="button" class="btn btn-md btn-outline-primary">Reply</button></a>
                                <button type="button" class="btn btn-outline-secondary btn-rounded btn-md" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                        <!--/.Content-->

                    </div>
                </div>
                <?php } ?>
            </table>
        </div>
        <nav aria-label="Page">
            <ul class="pagination animated slideInUp delay-3s">
            <?php
            $get_all_records = "SELECT * FROM messages";
            $result = mysqli_query($con, $get_all_records);
            $total_records = mysqli_num_rows($result);
            $total_pages = ceil($total_records/$records_per_page);

            for ($i=1; $i<=$total_pages; $i++){
            ?>
                <li class="page-item"><a class="page-link" href="index.php?messages=<?php echo "$i" ?>"><?php echo"$i" ?></a></li>
            <?php
            }
            ?>
            </ul>
        </nav>

    <?php
    }
}
?>