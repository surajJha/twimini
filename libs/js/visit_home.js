$(document).ready(function() {

    getUserFeed(0);
    // Get Following
    requestURL = 'http://localhost/twimini/index.php/userFollow/getFollowing';
    data = {'handle': vishandle};
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
                        '<h4 class="media-heading" style="text-align:center;"><span class="name">' + x.name + '</span></h4> <h5 class="media-heading" style="text-align:center;"><span class="handle-time">@' + x.handle + '</span></h5>' +
                        '<div class="row">' + '<img src="http://localhost/twimini/profilepics/' + ((x.profile_pic != '') ? x.profile_pic : 'default.png') + '">' + '</div>' +
                        '<div class="follow-bio">' + (x.bio.length > 75 ? x.bio.substring(0, 75) + '...' : x.bio) + '</div>' +
                        '</div>' +
                        //'<div class="follow-button" style="position:absolute; bottom: 8px;"><input type ="button" class="btn btn-sm btn-primary following" value = "Following" onmouseover="this.value=\'Unfollow\'" onmouseout="this.value=\'Following\'"></div>' +
                        '</div></td>' + ((i % 3) == 2 ? '</tr>' : ''));
            }
            $('#following-table').append(table);

        }
//        $("#tab2 .follow-button input").on("click", function() {
//            follow($(this));
//        });
    });



    // Get Followers
    requestURL = 'http://localhost/twimini/index.php/userFollow/getFollowers';
    data = {'handle': vishandle};
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
                            '<h4 class="media-heading" style="text-align:center;"><span class="name">' + x.name + '</span></h4> <h5 class="media-heading" style="text-align:center;"><span class="handle-time">@' + x.handle + '</span></h5>' +
                            '<div class="row">' + '<img src="http://localhost/twimini/profilepics/' + ((x.profile_pic != '') ? x.profile_pic : 'default.png') + '">' + '</div>' +
                            '<div class="follow-bio">' + (x.bio.length > 75 ? x.bio.substring(0, 75) + '...' : x.bio) + '</div>' +
                            '</div>' +
                            //'<div class="follow-button" style="position:absolute; bottom: 8px;"><input type ="button" class="btn btn-sm btn-primary ' + ((x.status == 'true') ? 'following" value = "Following"></div>' : 'notfollowing" value = "Follow"></div>') +
                            '</div></td>' + ((i % 3) == 2 ? '</tr>' : ''));

                }
                $('#follower-table').append(table);
            }
        }

//        $("#tab3 input.btn-primary").on("click", function() {
//            follow($(this));
//        });
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
         window.location.assign("http://localhost/twimini/index.php/userHomeController/userSearch/"+k[0].handle);
       }
       
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
        data = {'handle': sesshandle, 'follow': e.parent().parent().attr('id')};
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
        data = {'handle': sesshandle, 'follow': e.parent().parent().attr('id')};
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
    var ds = x.time_created;
    var day = new Date(ds.replace(' ', 'T') + 'Z').toDateString().split(" ");
    return day[2] + ' ' + day[1] + ' ' + day[3];
}

function getUserFeed(lasttid)
{
    var requestURL = 'http://localhost/twimini/index.php/userTweetController/getUserTweets';
    // console.log(requestURL);
    var data = {'handle': vishandle,
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
                        '<span class="media-heading"><span class="name">' + x.name + '</span><span class="handle-time">@' + x.handle + ' - ' + t + '</span>' +
                        ((x.retweeter_handle) ? '<span class="retweet">Retweeted by '+(x.retweeter_handle)+'</span><br>' : '</span><br>') +
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
