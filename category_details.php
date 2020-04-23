<?php
include("include/db.php");
if(isset($_GET['category_id'])){
    $category_id = $_GET['category_id'];

    $get_data = "SELECT * FROM categories WHERE id = '$category_id'";
    $run_get_data = mysqli_query($con, $get_data);
    $response = [];
    while($row_data = mysqli_fetch_assoc($run_get_data)){
        $category_name = $row_data['category_name'];
        $category_description = $row_data['category_description'];
    }

    $response['category_name'] = $category_name;
    $response['category_description'] = $category_description;

    echo json_encode($response);
}
?>