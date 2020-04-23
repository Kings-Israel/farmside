$(document).ready(function(){
    //Delete one photo from gallery
    $('.delete_photo').click(function(){
        var el = this;
        var id = this.id;
        var splitid = id.split("_")

        $delete_id = splitid[1];

        $.ajax({
            url:'delete_photo.php',
            method:'POST',
            data:{id:$delete_id},
            success:function(response){
                if(response == 1){
                    $(el).closest('tr').fadeOut(800, function(){
                        $(this).remove();
                    });
                } else {
                    alert("Invalid ID");
                }
            }
        });
    });

    //Upload media to gallery
    $('#uploadMedia').submit(function(e){
        e.preventDefault();
        if($('#media').val()){
            $(this).ajaxSubmit({
                target: '',
                beforeSubmit: function() {
                    $("#progress-bar").width('0%');
                },
                uploadProgress: function(event, position, total, percentComplete){
                    $("#progress-bar").width(percentComplete + '%');
                    $("#status").html('<div id="progress-status">Uploading Media... '+percentComplete+'%</div>');
                },
                success: function(response) {
                    if(response == "success"){
                        $('#addMediaModal').modal('hide');
                        document.location.reload();
                    } else {
                        $('#addMediaModal').modal('hide');
                        alert("Failed");
                    }
                },
                resetForm: true
            });
            return false;
        }
    });

    //Edit Category Details
    $('.edit_category').on("click", function() {
        var id = this.id;
        var split_id = id.split("_");

        var category_id = split_id[1];
        $.ajax({
            url: "moreactions.php",
            method: "GET",
            data: {'id': category_id},
            success: function(response){
                response1 = JSON.parse(response);
                $("#category_id").val(response1["id"]);
                $("#category_name").val(response1["name"]);
                $("#category_description").val(response1["description"]);
            }
        });
    });

    //Delete Category and Photos in the category
    $('.delete_category').click(function(){
        var id = this.id;
        var split_id = id.split("_")

        $delete_id = split_id[1];
        $("#deleteCategory").modal('hide');

        $.ajax({
            url:'moreactions.php',
            method:'POST',
            data:{'delete_cat':$delete_id},
            success:function(response){
                if(response == "success"){
                    window.location.reload();
                    $("#message").fadeIn("slow", function(){
                        $(this).css("color", "green");
                        $(this).html("<h5>Category Deleted</h5>");
                        $(this).delay(6000).fadeOut();
                    });
                } else {
                    alert("Invalid ID");
                }
            }
        });
    });

    //Add and update category details
    $("#category_details").on("submit", function(e){
        e.preventDefault();
        if($("#category_id").val()){
            var id = $("#category_id").val();
            var name = $("#category_name").val();
            var description = $("#category_description").val();
            $.ajax({
                url: "moreactions.php",
                method: "POST",
                data: {'update_cat': id, 'category_name': name, 'category_description': description},
                success: function(response){
                    if(response == "success"){
                        window.location.reload();
                        $("#message").fadeIn("slow", function(){
                            $(this).css("color", "green");
                            $(this).html("<h5>Category Updated</h5>");
                            $(this).delay(6000).fadeOut();
                        });
                    }
                },
                resetForm: true,
            });
        }
        if($("#category_id").val() == ""){
            var add_new_cat = 'add_new_cat';
            var name = $("#category_name").val();
            var description = $("#category_description").val();

            $.ajax({
                url: "moreactions.php",
                method: "POST",
                data: {'add_new_cat': add_new_cat, "category_name": name, "category_description": description},
                success: function(response){
                    if(response == "success"){
                        window.location.reload();
                        $("#message").fadeIn("slow", function(){
                            $(this).css("color", "green");
                            $(this).html("<h5>Category Added</h5>");
                            $(this).delay(6000).fadeOut();
                        });
                    }
                },
                resetForm: true,
            });
        }
    });

    //Delete all photos in the gallery
    $("#delete_photos").on("click", function(){
        var info = $("#delete_photo_info");
        function blinker(){
            info.html("<h5>Deleting Photos...</h5>");
            info.fadeOut(500);
            info.fadeIn(500);
        }
        var Interval = setInterval(blinker, 1000);
        var delete_photos = 'delete_photos';
        $.ajax({
            url: "moreactions.php",
            method: "POST",
            data: {'delete_photos':delete_photos },
            success: function(response){
                if(response == "success"){
                    function stop_blinker(){
                        clearInterval(Interval);
                        info.html("<h5>Click Below to Delete All Photos In The Gallery</h5>").fadeIn("slow");
                    }
                    setTimeout(stop_blinker, 4500);
                }
            }
        });
    });

    //Delete all videos
    $("#delete_videos").on("click", function(){
        var info = $("#delete_video_info");
        function blinker(){
            info.html("<h5>Deleting videos...</h5>");
            info.fadeOut(500);
            info.fadeIn(500);
        }
        var Interval = setInterval(blinker, 1000);
        var delete_videos = 'delete_videos';
        $.ajax({
            url: "moreactions.php",
            method: "POST",
            data: {'delete_videos':delete_videos },
            success: function(response){
                if(response == "success"){
                    function stop_blinker(){
                        clearInterval(Interval);
                        info.html("<h5>Click Below to Delete All videos In The Gallery</h5>").fadeIn("slow");
                    }
                    setTimeout(stop_blinker, 4500);
                }
            }
        });
    });

    $(".change_carousel_photo").click(function(){
        var id = this.id;
        $("#carousel_id").val(id);
        $(".changeCarouselPhoto").css("display", "block");
    });

    // $('#changeCarouselPhoto').submit(function(e){
    //     if($('#image_name').val()){
    //         $(this).ajaxSubmit({
    //             target: '',
    //             beforeSubmit: function() {
    //                 $("#status").html('0%');
    //             },
    //             uploadProgress: function(event, position, total, percentComplete){
    //                 $("#status").html('<div id="progress-status">'+percentComplete+'%</div>');
    //             },
    //             success: function(response) {
    //                 if(response == "success"){
    //                     document.location.reload();
    //                 } else {
    //                     alert("failed");
    //                 }
    //             },
    //             resetForm: true
    //         });
    //         return false;
    //     }
    // });

    // $("#admin_details").submit(function(e){
    //     e.preventDefault();
    //     var admin_id = $("#admin_id").val();
    //     var admin_name = $("#admin_name").val();
    //     var admin_email = $("#admin_email").val();
    //     var admin_phone_number = $("#admin_phone_number").val();
    //     var admin_description = $("#admin_description").val();
    //     var phone_pattern = new RegExp("^\\s*(?:\\+?((254|0)?))?[-. (]*(\\d{3})[-. )]*(\\d{3})[-. ]*(\\d{4})(?: *x(\\d+))?\\s*$");
    //     if($("#admin_details").validate() && !phone_pattern.test(admin_phone_number)){
    //         $("#error_message").html("<h5 style='color: red'>Check phone number</h5>")
    //         $("#error_message").delay(3000).fadeOut("slow");
    //     } else {
    //     }
    // });
});



