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
    $("#edit_profile").submit(function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        console.log(formData);

        if ($('#passwordinput').val() === $('#passwordconfirm').val())
        {
            $.ajax(
                    {
                        type: 'POST',
                        url: 'http://localhost/twimini/index.php/userProfileController/updateProfile',
                        data: formData,
                        // dataType: 'json',
                        cache: false,
                        processData: false,
                        contentType: false
                    }).done(function(msg, status, XHR) {
                if (msg === "success") {
                    $("#response-message").html("<div class='edit-message'><span style='color: green;font-weight: bold;'><center>Profile was successfully updated</center></span></div><br>");
                    $('.tweets').empty();
                    getUserFeed(0);
                    $("#tweet-box").val('');
                }
                else {
                    $("#response-message").html("<div class='edit-message'><span style='color: red;font-weight: bold;'><center>There was some problem in updating your profile. Please try again.</center></span></div><br>");
                }
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
        'count': 10,
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
                        '<img class="media-object" src="http://localhost/twimini/profilepics/' + ((x.profile_pic != '') ? x.profile_pic : 'default.png') + '"    style="height: 60px;width: 60px;margin-left: 10px;margin-bottom: 10px;">' +
                        '</a>' +
                        '<div class="media-body">' +
                        '<span class="media-heading"><span class="name">' + x.name + '</span><span class="handle-time">@' + x.handle + ' - ' + t + '</span></span><br>' +
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