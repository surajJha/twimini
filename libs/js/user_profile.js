$(document).ready(function() {

    var name_status = false;
    var pwd_confirm_status = false;


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
        //event.preventDefault();
        //e.stopPropagation();
        var formData = new FormData($(this)[0]);
        console.log(formData);

        if (name_status && pwd_confirm_status)
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

            $("#response-message").html("<div class='edit-message'><span style='color: red;font-weight: bold;'><center>Please fill the form properly and try again.</center></span></div><br>");
            setTimeout(function() {
                $("#response-message").fadeOut(1000);
            }, 2000, function() {
                $("#response-message").html("");
            });


        }
        // $("#edit_profile").unbind('submit',function(){$("#edit_profile").bind('submit')});


    });

    //=================UPDAE PROFILE VALIDATION

    // name validation
    $("#name-warning").hide();
    $("#name").on("blur", function() {
        // alert($("#name").text().length);
        if ($("#name").val().length <= 0) {
            $("#name-warning").show(300);
        }
        else {
            $("#name-warning").hide(300);
            name_status = true;
        }
    });

    //  CONFIRM PASSWORD CHECK=========================
    $("#password-confirm-warning").hide();
    $("#passwordconfirm").on("blur", function() {
        // alert($("#name").text().length);
        if ($("#passwordinput").val() != $("#passwordconfirm").val()) {
            $("#password-confirm-warning").show(300);
        }
        else {
            $("#password-confirm-warning").hide(300);
            pwd_confirm_status = true;
        }
    });

// function for autocomplete search users ===================================

    var a = [];
    var k;
    $("#search_users").on("keyup", function() {
        //e.preventDefault();
        var value = $("#search_users").val();
        //search_users
        var data = {'search_users': value};
        if (value != '')
        {
            $.ajax(
                    {
                        type: 'POST',
                        url: 'http://localhost/twimini/index.php/userSearchController/searchUsers',
                        cache: false,
                        data: data,
                        async: false
                                //dataType: 'json'

                    }).done(function(msg) {
                k = JSON.parse(msg);
//                console.log(k[0].handle);
//                console.log(k[1].handle);
//                console.log(k[2].handle);


                for (var t = 0; t < k.length; t++) {
                    a[t] = {'label': k[t].name, 'value': k[t].handle};
                }
            });
        }
    });



    //autocomplete and redirect the user to other user's homepage

    $("#search_users").autocomplete({
        /*Source refers to the list of fruits that are available in the auto complete list. */
        minLength: 1,
        source: a,
        /* auto focus true means, the first item in the auto complete list is selected by default. therefore when the user hits enter,
         it will be loaded in the textbox */
        autoFocus: true,
        focus: function(event, ui) {
            event.preventDefault() // <-- prevent the textarea from being updated.
        },
        select: function(event, ui) {
            //console.log(ui.item);
            window.location.assign("http://localhost/twimini/index.php/userHomeController/user/" + ui.item.value);

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
                        '<span class="media-heading"><span class="name">' + x.name + '</span><span class="handle-time"><a href="http://localhost/twimini/index.php/userHomeController/user/' + x.handle + '">@' + x.handle + '</a> - ' + t + '</span>' +
                        ((x.retweeter_handle) ? '<span class="retweet">Retweeted by You</span><br>' : '</span><br>') +
                        x.tweet +
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