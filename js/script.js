$(document).ready(function(){
    $('#carouselExample').on('slide.bs.carousel', function (e) {
    
        var $e = $(e.relatedTarget);
        var idx = $e.index();
        var itemsPerSlide = 4;
        var totalItems = $('.carousel-item').length;
    
        if (idx >= totalItems-(itemsPerSlide-1)) {
            var it = itemsPerSlide - (totalItems - idx);
            for (var i=0; i<it; i++) {
                // append slides to end
                if (e.direction=="left") {
                    $('.carousel-item').eq(i).appendTo('.carousel-inner');
                }
                else {
                    $('.carousel-item').eq(0).appendTo('.carousel-inner');
                }
            }
        }
    });

    //Validate message details and send to database
    $("#messageForm").submit(function(e){
        e.preventDefault();
        var name = $("#name").val();
        var email = $("#email").val();
        var phoneNum = $("#phoneNum").val();
        var message = $("#message").val();
        var phone_pattern = new RegExp("^\\s*(?:\\+?((254|0)?))?[-. (]*(\\d{3})[-. )]*(\\d{3})[-. ]*(\\d{4})(?: *x(\\d+))?\\s*$");
        if(phoneNum !== "" && !phone_pattern.test(phoneNum)){
            $("#errorInfo").fadeIn("slow", function(){
                $(this).css("color", "red");
                $(this).html("<h4>Invalid Phone number</h4>");
                $(this).delay(3000).fadeOut();
            });
        } else {
            $.ajax({
                method: "POST",
                url: "submitmessage.php",
                data: {name: name, email: email, phoneNum: phoneNum, message: message},
                cache: false,
                success: function (response) {
                    $("#info").html("<h3 class='text-align-center pb-2'>Thank you " +name+". Message has been received.\nWe will get back to you soon.</h3>\n<a href='#' rel='modal:close'>Click to close</a>");
                    $("#info").modal({
                        fadeDuration: 500,
                        showClose: false,
                    }).css("height", "auto");
                    $("#messageForm")[0].reset();
                }
            });
        }
        return false;
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

    //Get event information from book.php
    $("#booking_form").submit(function(){
        var name = $("#name").val();
        var email = $("#email").val();
        var event = $("#event_type").val();
        var date = $("#datepicker").val();
    })
});


