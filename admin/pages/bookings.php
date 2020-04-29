<?php
function get_category($id){
    global $con;
    $get_category_query = "SELECT * FROM categories WHERE id = $id";
    $get_category = mysqli_query($con, $get_category_query);

    $row_category = mysqli_fetch_array($get_category);

    $category = $row_category['category_name'];
    return $category;
}
//Bookings page
function getBookings(){
    if(!isset($_GET['messages']) && !isset($_GET['send_mail']) && !isset($_GET['reply_message']) && !isset($_GET['photos']) && !isset($_GET['videos']) && !isset($_GET['more_actions']) && !isset($_GET['profile'])){
        global $con;
        $records_per_page = 9;
        $page = '';

        if(isset($_GET["page"])){
            $page = $_GET["page"];
        } else {
            $page = 1;
        }

        $start_from = ($page - 1)*$records_per_page;

        $get_events = "SELECT * FROM bookings ORDER BY id DESC LIMIT $start_from,$records_per_page";

        $run_get_events = mysqli_query($con, $get_events);
        ?>
        <h1 class="animated slideInDown delay-2s">Bookings</h1>
        <div id="page-container">
            <table class="table table-striped table-dark animated slideInRight">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Event</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php
                while($row_bookings = mysqli_fetch_array($run_get_events)){
                    $mail_id = $row_bookings['id'];
                    $mail_name = $row_bookings['name'];
                    $mail_address = $row_bookings['email'];
                    $event = $row_bookings['event_type'];
                    $event_date = $row_bookings['event_date'];
                    $is_reviewed = $row_bookings['is_reviewed'];
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $mail_name ?></td>
                        <td><?php echo $mail_address ?></td>
                        <td><?php echo get_category($event) ?></td>
                        <td><?php echo $event_date ?></td>
                        <td>
                            <?php
                            if($is_reviewed == true){
                                ?>
                                <span>Reviewed</span>
                                <?php
                            } else {
                                ?>
                                <a href="index.php?send_mail=<?php echo $mail_id ?>"><button type="button" class="btn btn-sm btn-primary">Reply</button></a>
                                <?php
                            }
                            ?>
                        </td>
                    </tr>
                </tbody>
                <?php
                }
                ?>
            </table>
        </div>
            <nav aria-label="Page">
                <ul class="pagination animated slideInUp delay-3s">
                <?php
                $get_all_records = "SELECT * FROM bookings";
                $result = mysqli_query($con, $get_all_records);
                $total_records = mysqli_num_rows($result);
                $total_pages = ceil($total_records/$records_per_page);

                for ($i=1; $i<=$total_pages; $i++){
                ?>
                    <li class="page-item"><a class="page-link" href="index.php?page=<?php echo "$i" ?>"><?php echo"$i" ?></a></li>
                <?php
                }
                ?>
                </ul>
            </nav>
        <?php
    }
}
//End of Bookings
?>