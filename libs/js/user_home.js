$(document).ready(function() {

    getUserFeed(0);
    // Get Following
    requestURL = 'http://localhost/twimini/index.php/userFollow/getFollowing';
    data = {'handle': handle};
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
            var table = '';
            for (var i = 0; i < msg[1].length; i++)
            {
                var x = msg[1][i];

                //"this.innerHTML = 'TheWorldwide Leader In Sports'" onmouseout="this.innerHTML = this.alt" alt="ESPN.com"
                table = table + (((i % 3) ? '' : '<tr>') + '<td class="follow-table" style="max-width:33%;"><div id="' + x.userid + '" class="media follow-object">' +
                        '<div class="media-body">' +
                        '<h4 class="media-heading" style="text-align:center;"><span class="name">' + x.name + '</span></h4> <h5 class="media-heading" style="text-align:center;"><span class="handle-time"><a href="http://localhost/twimini/index.php/userHomeController/user/'+x.handle+'">@' + x.handle + '</a></span></h5>' +
                        '<div class="row">' + '<img src="http://localhost/twimini/profilepics/' + ((x.profile_pic != '') ? x.profile_pic : 'default.png') + '">' + '</div>' +
                        '<div class="follow-bio">' + (x.bio.length > 75 ? x.bio.substring(0, 75) + '...' : x.bio) + '</div>' +
                        '</div>' +
                        '<div class="follow-button" style="position:absolute; bottom: 8px;"><input type ="button" class="btn btn-sm btn-primary following" value = "Following" onmouseover="this.value=\'Unfollow\'" onmouseout="this.value=\'Following\'"></div>' +
                        '</div></td>' + ((i % 3) == 2 ? '</tr>' : ''));
            }
            $('#following-table').append(table);

        }
        $("#tab2 .follow-button input").on("click", function() {
            follow($(this));
        });
    });



    // Get Followers
    requestURL = 'http://localhost/twimini/index.php/userFollow/getFollowers';
    data = {'handle': handle};
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
            for (var i = 0; i < msg[1].length; i++)
            {
                var table = '';
                for (var i = 0; i < msg[1].length; i++)
                {
                    var x = msg[1][i];


                    table = table + (((i % 3) ? '' : '<tr>') + '<td class="follow-table" style="max-width:33%;"><div id="' + x.userid + '" class="media follow-object">' +
                            '<div class="media-body">' +
                            '<h4 class="media-heading" style="text-align:center;"><span class="name">' + x.name + '</span></h4> <h5 class="media-heading" style="text-align:center;"><span class="handle-time"><a href="http://localhost/twimini/index.php/userHomeController/user/'+x.handle+'">@' + x.handle + '</a></span></h5>' +
                            '<div class="row">' + '<img src="http://localhost/twimini/profilepics/' + ((x.profile_pic != '') ? x.profile_pic : 'default.png') + '">' + '</div>' +
                            '<div class="follow-bio">' + (x.bio.length > 75 ? x.bio.substring(0, 75) + '...' : x.bio) + '</div>' +
                            '</div>' +
                            '<div class="follow-button" style="position:absolute; bottom: 8px;"><input type ="button" class="btn btn-sm btn-primary ' + ((x.status == 'true') ? 'following" value = "Following" onmouseover="this.value=\'Unfollow\'" onmouseout="this.value=\'Following\'"></div>' : 'notfollowing" value = "Follow"></div>') +
                            '</div></td>' + ((i % 3) == 2 ? '</tr>' : ''));

                }
                $('#follower-table').append(table);
            }
        }

        $("#tab3 input.btn-primary").on("click", function() {
            follow($(this));
        });
    });


    //Who to Follow
    requestURL = 'http://localhost/twimini/index.php/userFollow/whoToFollow';
    data = {'handle': handle};
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
            var table = '';
            for (var i = 0; i < msg[1].length; i++)
            {
                var x = msg[1][i];
                table = table + '<div class="media id="' + x.user + '" style="padding-bottom: 2%;">' +
                                    '<a class="pull-left">' +
                                        '<img class="media-object" src="http://localhost/twimini/profilepics/' + x.profile_pic + '" height="70px" width="70px">' +
                                    '</a>' +
                                    '<div class="media-body">' +
                                        '<h4 class="media-heading" style="font-weight: bold;color: #292f33;">' + x.name + '</h4>' +
                                        '<h5 class="media-heading" style="color: #71A9D3;">@' + x.handle + '</h5>' +
                                    '</div>' +
                                    '<div class="follow-button"><input type ="button" class="btn btn-sm btn-primary notfollowing" style="display: initial;margin: initial;" value = "Follow"></div>' +
                                '</div>';

            }
            $('#whoToFollow').append(table);
        }
        $("#whoToFollow input.btn-primary").on("click", function() {
            follow($(this));
        });
    });
// function for autocomplete search users ===================================

var a = [];
var k;
     $("#search_users").on("keyup", function() {
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
                        //dataType: 'json'

                    }).done(function(msg){
                         k = JSON.parse(msg);
                        for(var t = 0;t<k.length;t++){
                            a[t] = k[t].name;
                        }
                    });
                }
            });
                        
                    
    
     // autocomplete and redirect the user to other user's homepage
     
        $("#search_users").autocomplete({
      /*Source refers to the list of fruits that are available in the auto complete list. */
      minLength: 1,
      source:a,
      /* auto focus true means, the first item in the auto complete list is selected by default. therefore when the user hits enter,
      it will be loaded in the textbox */
      autoFocus: true,
       select: function(event) {
       
       {
           console.log(k[0].handle);
         //  console.log();
         window.location.assign("http://localhost/twimini/index.php/userHomeController/user/"+k[0].handle);
       }
       
      }
    });
 



    $("#tweet-box").on("click", function() {
        if ($("#tweet-box").attr("class") == 'tweet-small') {
            $("#tweet-box").toggleClass('tweet-large', true);
            $("#tweet-box").toggleClass('tweet-small', false);
            $("#tweet-counter").append('<span id="text-counter" style="margin-left: 45%;color: gray;font-weight: 600;">140</span><span><button id="tweet-button" class="tweet-button" style="height: 42px;width: 101px;border-radius: 10px;background-color: gray;margin-left: 10px;" disabled="disabled">Tweet</button></span>').css("margin-bottom", "20px");
        }


        //create Tweet 
        $('#tweet-button').on("click", function(e) {           //$('#tweet-counter').on("click", $('#tweet-button'), function(e) {
            var requestURL = 'http://localhost/twimini/index.php/createTweet/createTweet';
            var data = {'handle': handle,
                'tweet': $("#tweet-box").val()};

            // Get User feed
            $.ajax(
                    {
                        type: 'POST',
                        url: requestURL,
                        data: data,
                        cache: false
                    }).done(function(msg, status, XHR) {
                if (msg === "success")
                {

                    $('.tweets').empty();
                    getUserFeed(0);
                    $("#tweet-box").val('');
                }
            });
        });


    });

    $("#tweet-box").on("keyup", function() {
        var count = $("#text-counter");
        count.text(140 - $("#tweet-box").val().length);
        if (parseInt(count.text()) < 0 || parseInt(count.text()) == 140)
            $("#tweet-button").attr('disabled', 'disabled').css("background-color", "gray");
        else
            $("#tweet-button").removeAttr('disabled').css("background-color", "lightblue");
    });

    $(document).on("click", function(e) {
        var box = $("#tweet-box");
        if (e.target.nodeName != 'TEXTAREA' && box.val() == '' && box.attr("class") == 'tweet-large') {
            $("#tweet-box").toggleClass('tweet-large', false);
            $("#tweet-box").toggleClass('tweet-small', true);
            $("#tweet-counter span").remove();
            $("#tweet-counter").css("margin-bottom", "");
        }
    });

    var lasttid = 0;

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() && parseInt($('.tweet-object').last().attr('id')) != lasttid) {
            $('body').addClass('loading');
            lasttid = $('.tweet-object').last().attr('id');
            getUserFeed(lasttid);

        }
    });


});

function follow(e) {
    if (e.hasClass('following')) {
        requestURL = 'http://localhost/twimini/index.php/userFollow/Unfollow';
        data = {'handle': handle, 'follow': e.parent().parent().attr('id')};
        $.ajax(
                {
                    type: 'POST',
                    url: requestURL,
                    data: data,
                    //dataType: 'json',
                    cache: false
                }).done(function(msg, status, XHR) {
            e.removeClass('following').addClass('notfollowing');
            e.val('Follow');
            e.attr('onmouseover', "this.value=\'Follow\'");
            e.attr('onmouseout', "this.value=\'Follow\'");
        });
    }
    else {
        requestURL = 'http://localhost/twimini/index.php/userFollow/Follow';
        data = {'handle': handle, 'follow': e.parent().parent().attr('id')};
        $.ajax(
                {
                    type: 'POST',
                    url: requestURL,
                    data: data,
                    //dataType: 'json',
                    cache: false
                }).done(function(msg, status, XHR) {
            e.removeClass('notfollowing').addClass('following');
            e.val('Following');
            e.attr('onmouseover', "this.value=\'Unfollow\'");
            e.attr('onmouseout', "this.value=\'Following\'");
        });
    }

}


function timeconvert(x)
{
    var tt = x.time_created.split(":");
    var t = tt[0] * 3600 + tt[1] * 60 + tt[2] * 1;
    var s = t % 60;
    t = Math.floor(t / 60);
    var m = t % 60;
    t = Math.floor(t / 60);
    var h = t % 24;
    var d = Math.floor(t / 24);

    //(d>0?d+' d '+h+' h ago':(h>0?h+' h '+m+' m ago':(m>0?m+' m '+s+' s ago':s+' s ago')))
    return (d > 0 ? d + 'd ' + h + 'h' : (h > 0 ? h + 'h ' + m + 'm' : (m > 0 ? m + 'm ' + s + 's' : s + 's')));
}

function getUserFeed(lasttid)
{
    var requestURL = 'http://localhost/twimini/index.php/userFeedController/getUserFeed';
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
            var len = msg[1].length;
            for (var i = 0; i < len; i++)
            {
                var x = msg[1][i];
                var t = timeconvert(x);
                $('.tweets').append('<div id="' + x.tid + '"class="media tweet-object">' +
                        '<a class="pull-left" href="#">' +
                        '<img class="media-object" src="http://localhost/twimini/profilepics/' + ((x.profile_pic != '') ? x.profile_pic : 'default.png') + '" style="height: 60px;width: 60px;margin-left: 10px;">' +
                        '</a>' +
                        '<div class="media-body">' +
                        '<span class="media-heading"><span class="name">' + x.name + '</span> <span class="handle-time"><a href="http://localhost/twimini/index.php/userHomeController/user/'+x.handle+'">@' + x.handle + '</a> - ' + t + '</span>' + ((x.retweeter_id) ? '<span class="retweet">Retweeted by ' + ((x.retweeter_handle == handle) ? 'You' : x.retweeter_handle) + '</span></span>' : '</span>') + '<br>' +
                        x.tweet +
                        //(x.retweeter_handle ? '<div style="color:#707070 font-size: 12pt">Retweeted by @' + x.retweeter_handle + '</div>' : '') +
                        '</div>' +
                        ((x.handle != handle) ? '<br><div class="tweet-bottom-panel"><a class="retweet-link" style="cursor: pointer">Retweet</a></div>' : '<br><div style="padding-bottom:15px"></div>') +
                        '</div>');
            }
        }

        //Retweet
        $('.retweet-link').on("click", function(e) {
            var requestURL = 'http://localhost/twimini/index.php/userFeedController/retweet';
            var tweetobj = e.target.parentElement.parentElement;
            var data = {'handle': handle,
                'tid': tweetobj.id};
            $.ajax(
                    {
                        type: 'POST',
                        url: requestURL,
                        data: data,
                        cache: false
                    }).done(function(msg, status, XHR) {
                if (msg === "success")
                {
                    var head = $('#' + tweetobj.id).find('.media-heading');
                    var span = head.find('span');
                    if (span.length) {
                        span.empty();
                        span.text('Retweeted by You');
                    }
                    else
                        head.append('<span style="float: right;padding-right: 10px;color: lightslategray;">Retweeted by You</span>');
                }
            });
        });
    });
}
//AUTOCOMPLETE AJAX DELETE AFTERWARDS
//var source = new Array();
//    $("#search_users").on("keyup", function() {
//        var value = $("#search_users").val();
//        //search_users
//        var data = {'search_users': value};
//        if (value != '')
//        {
//            $.ajax(
//                    {
//                        type: 'POST',
//                        url: 'http://localhost/twimini/index.php/userSearchController/searchUsers',
//                        cache: false,
//                        data: data,
//                        //dataType: 'json'
//
//                    }).done(function(msg) {
//                       // console.log(msg);
//                        var m = JSON.parse(msg);
//                       console.log(m[0].name);
//                         for (var i = 0; i < m.length; i++) {
//                              source = m[i].name;
//                             console.log(source[0]);
//                         }
//                var length = msg.length;
////                $('#user-list li').empty();
////                if (length) {
////                    for (var i = 0; i < length; i++) {
////                        var opt = '<li class="user-list"  style="background-color:white;"><a ><span class="user-search-list" style="background-color: white; height: 30px;color: blue;font-size: larger;font-weight: bold">' + msg[i].name + '</span></a></li>';
////                        $("#user-list").append(opt);
////
////                    }
////                }
//            });
//        }
////        else
////        {
////            $('#user-list li').empty();
////        }
//       
//    });
