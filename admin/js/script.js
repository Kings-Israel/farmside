$(document).ready(function(){
    $("#mailForm").validate({
        errorElement: "div",
        errorLabelContainer: "#info_area",
        rules: {
            mail_id: "required",
            mail_address: {
                required: true,
                email: true,
            },
            mail_subject: "required",
            mail_message: "required",
        },
        messages: {
            mail_id: {
                required: "Mail ID is missing",
            },
            mail_address: {
                required: "Please Enter an Email Address",
                email: "Enter a valid Email Address",
            },
            mail_subject: {
                required: "Enter a mail Subject",
            },
            mail_message: {
                required: "Please Enter mail message",
            },
        },
        submitHandler: function(form){
            $("#mailForm").ajaxSubmit({
                uploadProgress: function(event, position, total, percentComplete){
                    $("#send_mail").val("Sending Mail. Please Wait...");
                    $("#send_mail").attr("disabled", true);
                    $("#cancel_btn").attr("disabled", true);
                },
                success: function(response){
                    if(response == "success"){
                        $("#mail_info").html("<h3 class='text-align-center pb-2'>Mail Sent.</h3>\n<a href='#' class='modal_close' rel='modal:close'>Click to close</a>");
                        $("#mail_info").modal({
                            fadeDuration: 500,
                            escapeClose: false,
                            clickClose: false,
                            showClose: false,
                        }).css("height", "auto");
                        $(".modal_close").on("click", function(){
                            window.open(window.history.back(), "_self");
                        });
                    } else if(response == "File not attached") {
                        $("#mail_info").html("<h3 class='text-align-center pb-2'>File Not Attached.\nPlease Try Again</h3>\n<a href='#' rel='modal:close'>Click to close</a>");
                        $("#mail_info").modal({
                            fadeDuration: 500,
                            showClose: false,
                        }).css("height", "auto");
                        $("#send_mail").val("Send")
                        $("#send_mail").attr("disabled", false)
                        $("#cancel_btn").attr("disabled", false);
                    } else {
                        $("#mail_info").html("<h3 class='text-align-center pb-2'>Mail Not Sent.\nPlease Try Again</h3>\n<a href='#' rel='modal:close'>Click to close</a>");
                        $("#mail_info").modal({
                            fadeDuration: 500,
                            showClose: false,
                        }).css("height", "auto");
                        $("#send_mail").val("Send")
                        $("#send_mail").attr("disabled", false)
                        $("#cancel_btn").attr("disabled", false);
                    }
                }
            });
        }
    });
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
                    $(el).closest('tr').fadeOut(500, function(){
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

    $("#quotationForm").validate({
        errorElement: "span",
        errorLabelContainer: "#quotationInfo",
        rules: {
            quotation: "required",
        },
        messages: {
            quotation: {
                required: "Please select a file",
            },
        },
        submitHandler: function(form){
            $("#quotationForm").ajaxSubmit({
                success: function(response){
                    if(response == "success"){
                        document.location.reload();
                    } else {
                        $("#quotationInfo").html("Error Uploading file");
                    }
                }
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



    $.validator.addMethod("phoneRegex", function(value, element){
        return this.optional(element) || /^\s*(?:\+?((254|0)?))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/.test(value);
    }, "Please Enter A valid phone Number");

    $("#admin_details").validate({
        errorElement: "div",
        errorLabelContainer: "#info_area",
        rules: {
            admin_name: {
                required: true,
            },
            admin_email: {
                required: true,
            },
            admin_phone_number: {
                required: true,
                phoneRegex: true,
            },
            admin_description: {
                required: true,
            },
        },
        messages: {
            admin_name: {
                required: 'Please Enter Your Name',
            },
            admin_email: {
                required: 'Please Enter Your Email',
            },
            admin_phone_number: {
                required: 'Please Enter your phone Number',
            },
            admin_description: {
                required: "Enter Your Bio please",
            },
        },

        submitHandler: function(form){
            $("#admin_details").ajaxSubmit({
                success: function(response){
                    if(response == 'success'){
                        $("#mail_info").html("<h3 class='pb-2'>Details Updated.\nPlease Login.</h3>\n<a href='#' class='modal_close' rel='modal:close'>Click to close</a>");
                        $("#mail_info").modal({
                            fadeDuration: 500,
                            escapeClose: false,
                            clickClose: false,
                            showClose: false,
                        }).css("height", "auto");
                        $(".modal_close").on("click", function(){
                            window.open('logout.php', '_self');
                        });
                    } else {
                        $("#mail_info").html("<h3 class='pb-2'>Error Updating Details.\nPlease Try Again</h3>\n<a href='#' rel='modal:close'>Click to close</a>");
                        $("#mail_info").modal({
                            fadeDuration: 500,
                            showClose: false,
                        }).css("height", "auto");
                    }
                }
            });
            return false;
        }
    });

    $('#changeCarouselPhoto1').validate({
        errorElement: "div",
        errorLabelContainer: ".carousel_upload_status_1",
        rules: {
            carousel_photo: {
                required: true,
            },
        },
        messages: {
            carousel_photo: {
                required: "Select an image",
            },
        },
        submitHandler: function(form){
            $('#changeCarouselPhoto1').ajaxSubmit({
                success: function(response) {
                    if(response == "success"){
                        document.location.reload();
                    } else {
                        alert("Failed");
                    }
                },
                resetForm: true
            });
            return false;
        }
    });
    $('#changeCarouselPhoto2').validate({
        errorElement: "div",
        errorLabelContainer: ".carousel_upload_status_2",
        rules: {
            carousel_photo: {
                required: true,
            },
        },
        messages: {
            carousel_photo: {
                required: "Select an image",
            },
        },
        submitHandler: function(form){
            $('#changeCarouselPhoto2').ajaxSubmit({
                success: function(response) {
                    if(response == "success"){
                        document.location.reload();
                    } else {
                        alert("Failed");
                    }
                },
                resetForm: true
            });
            return false;
        }
    });
    $('#changeCarouselPhoto3').validate({
        errorElement: "div",
        errorLabelContainer: ".carousel_upload_status_3",
        rules: {
            carousel_photo: {
                required: true,
            },
        },
        messages: {
            carousel_photo: {
                required: "Select an image",
            },
        },
        submitHandler: function(form){
            $('#changeCarouselPhoto3').ajaxSubmit({
                success: function(response) {
                    if(response == "success"){
                        document.location.reload();
                    } else {
                        alert("Failed");
                    }
                },
                resetForm: true
            });
            return false;
        }
    });
    $('#changeCarouselPhoto4').validate({
        errorElement: "div",
        errorLabelContainer: ".carousel_upload_status_4",
        rules: {
            carousel_photo: {
                required: true,
            },
        },
        messages: {
            carousel_photo: {
                required: "Select an image",
            },
        },
        submitHandler: function(form){
            $('#changeCarouselPhoto4').ajaxSubmit({
                success: function(response) {
                    if(response == "success"){
                        document.location.reload();
                    } else {
                        alert("Failed");
                    }
                },
                resetForm: true
            });
            return false;
        }
    });
});
