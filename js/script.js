$(document).ready(function(){
    $.validator.addMethod("phoneRegex", function(value, element){
        return this.optional(element) || /^\s*(?:\+?((254|0)?))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/.test(value);
    }, "Please Enter A valid phone Number");

    $("#messageForm").validate({
        errorElement: "div",
        errorLabelContainer: "#errorInfo",
        rules: {
            name: "required",
            email: {
                required: true,
                email: true,
            },
            phoneNum: {
                phoneRegex: true,
            },
            message: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Please enter your name",
            },
            email: {
                required: "Please enter your Email Address",
                email: "Please Enter a valid email address",
            },
            phoneNum: {
                phoneRegex: "Please enter a valid phone number",
            },
            message: {
                required: "Please enter message",
            },
        },
        submitHandler: function(form){
            $("#messageForm").ajaxSubmit({
              success: function (response) {
                    if(response == 'success'){
                        $("#info").html("<h3 class='text-align-center pb-2'>Thank you. Message has been received.\nWe will get back to you soon.</h3>\n<a href='#' rel='modal:close'>Click to close</a>");
                        $("#info").modal({
                            fadeDuration: 500,
                            showClose: false,
                        }).css("height", "auto");
                        $("#messageForm")[0].reset();
                    } else {
                        $("#info").html("<h3 class='text-align-center pb-2'>Message not Sent.\nPlease Try Again.</h3>\n<a href='#' rel='modal:close'>Click to close</a>");
                        $("#info").modal({
                            fadeDuration: 500,
                            showClose: false,
                        }).css("height", "auto");
                    }
                }
            });
        }
    });

    //Display event information on selection
    $("#event_type").on({
        change: function(){
            var category_id = $(this).val();
            $.ajax({
                url: 'category_details.php',
                method: 'GET',
                data: {'category_id': category_id},
                success: function(response){
                    response1 = JSON.parse(response);
                    $("#category-header").html(response1['category_name']);
                    $("#category-details").html(response1['category_description']);
                },
            });
        },
    });

    // Get event information from book.php
    // $("#booking_form").submit(function(){
    //     var name = $("#name").val();
    //     var email = $("#email").val();
    //     var event = $("#event_type").val();
    //     var date = $("#datepicker").val();

    //     $.ajax({
    //         url: "submitBook.php",
    //         method: "POST",
    //         data: {'name': name, 'email': email, 'event_type': event, 'date': date},
    //         cache: false,
    //         success: function(response){
    //             if(response == 'success'){
    //                 $("#book_info").html("<h3 class='text-align-center pb-2'>Thank you " +name+". Event Added.\nWe will get back to you soon.</h3>\n<a href='#' rel='modal:close'>Click to close</a>");
    //                 $("#book_info").modal({
    //                     fadeDuration: 500,
    //                     showClose: false,
    //                 }).css("height", "auto");
    //                 $("#booking_form")[0].reset();
    //             } else {
    //                 $("#book_info").html("<h3 class='text-align-center pb-2'>Error.\nPlease Try Again.</h3>\n<a href='#' rel='modal:close'>Click to close</a>");
    //                 $("#book_info").modal({
    //                     fadeDuration: 500,
    //                     showClose: false,
    //                 }).css("height", "auto");
    //             }
    //         }
    //     });
    //     return false;
    // });

    $("#booking_form").validate({
        errorElement: "div",
        errorLabelContainer: "#info_area",
        rules: {
            name: "required",
            email: {
                required: true,
                email: true,
            },
            event_type: "required",
            date: "required",
        },
        messages: {
            name: {
                required: "Please enter your name",
            },
            email: {
                required: "Please Enter your Email",
                email: "Please Enter a valid email address",
            },
            event_type: {
                required: "Please pick an Event",
            },
            datepicker: {
                required: "Please pick a date",
            },
        },
        submitHandler: function(form){
            $("#booking_form").ajaxSubmit({
                success: function(response){
                    if(response == 'success'){
                        $("#book_info").html("<h3 class='text-align-center pb-2'>Thank you. Event Added.\nWe will get back to you soon.</h3>\n<a href='#' rel='modal:close'>Click to close</a>");
                        $("#book_info").modal({
                            fadeDuration: 500,
                            showClose: false,
                        }).css("height", "auto");
                        $("#booking_form")[0].reset();
                    } else {
                        $("#book_info").html("<h3 class='text-align-center pb-2'>Error.\nPlease Try Again.</h3>\n<a href='#' rel='modal:close'>Click to close</a>");
                        $("#book_info").modal({
                            fadeDuration: 500,
                            showClose: false,
                        }).css("height", "auto");
                    }
                }
            });
        }
    });
});


