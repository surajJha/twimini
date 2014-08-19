$(document).ready(function() {



// =============================================================================================
    getUserFeed(0);
    var lasttid = 0;
    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() && parseInt($('.tweet-object').last().attr('id')) != lasttid) {
            $('body').addClass('loading');
            lasttid = $('.tweet-object').last().attr('id');
            getUserFeed(lasttid);
        }
    });

//==================================update the profile changes=================================================================================

// function to update the profile changes made by the user
// through the form
    $("#edit_profile_button").on("click", function(e) {
    e.preventDefault();
    var form_data = $("#edit_profile").serialize();
    if ($('#passwordinput').val() === $('#passwordconfirm').val())
    {
        $.ajax(
                {
                    type: 'POST',
                    url: 'http://localhost/twimini/index.php/userProfileController/updateProfile',
                    data: form_data,
                    // dataType: 'json',
                    cache: false
                }).done(function(msg, status, XHR) {
// do something if ajax request was successful
            if (msg === "success") {
// update was successful
                $("#response-message").html("<div class='edit-message'><span style='color: green;font-weight: bold;'><center>Profile was successfully updated</center></span></div><br>");
                //$("#edit_profile").trigger("reset");
            }
            else {
                $("#response-message").html("<div class='edit-message'><span style='color: red;font-weight: bold;'><center>There was some problem in updating your profile. Please try again.</center></span></div><br>");
            }
            console.log($('.edit-message').attr('id'));
            $('.edit-message').delay(1600).fadeOut(400);
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        });
    }
    else {
        $("#response-message").html("<div class='edit-message'><span style='color: red;font-weight: bold;'><center>Passwords entered don't match.</center></span></div><br>");
    }
});
}); // END OF DOCUMENT READY FUNCTION

        function timeconvert(x)
        {
            var ds = x.time_created;
            var day = new Date(ds.replace(' ', 'T') + 'Z').toDateString().split(" ");
            return day[2] + ' ' + day[1] + ' ' + day[3];
        }

function getUserFeed(lasttid)
{
    var requestURL = 'http://localhost/twimini/index.php/userTweetController/getUserTweets';
    // console.log(requestURL);
    var data = {'handle': handle,
        'count': 5,
        'tid': lasttid};
    // Get User feed
    $.ajax(
            {
                type: 'POST',
                url: requestURL,
                data: data,
                dataType: 'json',
                cache: false
            }).done(function(msg, status, XHR) {
        if (msg[0] === "success")
        {
            $('body').removeClass('loading');
            // console.log(msg[1][0].retweeter_id);
            for (var i = 0; i < msg[1].length; i++)
            {
                var x = msg[1][i];
                var t = timeconvert(x);
                $('.tweets').append('<div id="' + x.tid + '"class="media tweet-object">' +
                        '<a class="pull-left" href="#">' +
                        '<img class="media-object" src="http://localhost/twimini/libs/images/dp.jpg" alt="..." style="height: 60px;width: 60px;">' +
                        '</a>' +
                        '<div class="media-body">' +
                        '<h4 class="media-heading">' + /*x.name + */' @' + x.handle + ' ' + t + '</h4>' +
                        x.tweet +
                        //(x.retweeter_handle ? '<div style="color:#707070 font-size: 12pt">Retweeted by you</div>' : '') +
                        '</div>' +
                        '</div>');
            }
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
    });
}






/*< div class = "media tweet-object" >
 < a class = "pull-left" href = "#" >
 < img class = "media-object" src = "<?php echo base_url(); ?>libs/images/dp.jpg" alt = "..." style = "height: 60px;width: 60px;" >
 < /a>
 < div class = "media-body" >
 < h4 class = "media-heading" > Media heading < /h4>
 This is some sample text.This is some sample text.
 This is some sample text.This is some sample text.
 This is some sample text.This is some sample text.
 This is some sample text.This is some sample text.
 ...
 < /div>
 < /div>*/