$(document).ready(function() {
    getUserFeed();

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
            // console.log(msg[1][0].retweeter_id);
            for (var i = 0; i < msg[1].length; i++)
            {
                var x = msg[1][i];


                table = table + (((i % 3) ? '' : '<tr>') + '<td class="follow-table"><div class="media follow-object">' +
                        '<div class="media-body">' +
                        '<h4 class="media-heading" style="text-align: center;">' + x.name + ' @' + x.handle + ' </h4>' +
                        '<div class="row">' +
                        '<img src="http://localhost/twimini/libs/images/dp.jpg" style="height: 80px;width: 120px;float: left;margin-left: 75px;">' +
                        '</div>' +
                        '<div style="text-align: center;">' + x.bio + '</div>' +
                        '</div>' +
                        '</div></td>' + ((i % 3) == 2 ? '</tr>' : ''));

            }
            $('#following-table').append(table);
        }
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
            // console.log(msg[1][0].retweeter_id);
            for (var i = 0; i < msg[1].length; i++)
            {
                var table = '';
                // console.log(msg[1][0].retweeter_id);
                for (var i = 0; i < msg[1].length; i++)
                {
                    var x = msg[1][i];


                    table = table + (((i % 3) ? '' : '<tr>') + '<td class="follow-table"><div class="media follow-object">' +
                            '<div class="media-body">' +
                            '<h4 class="media-heading" style="text-align: center;">' + x.name + ' @' + x.handle + ' </h4>' +
                            '<div class="row">' +
                            '<img src="http://localhost/twimini/libs/images/dp.jpg" style="height: 80px;width: 120px;float: left;margin-left: 75px;">' +
                            '</div>' +
                            '<div style="text-align: center;">' + x.bio + '</div>' +
                            '</div>' +
                            '</div></td>' + ((i % 3) == 2 ? '</tr>' : ''));

                }
                $('#follower-table').append(table);
            }
        }
    });


// function for autocomplete search users ===================================

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
                        dataType: 'json'

                    }).done(function(msg) {
                //  var x =$.parseJSON(response);
                //console.log(response);
                var length = msg.length;
                //$("#users").empty();
                $('#user-list li').empty();
                console.log(msg);
                if (length) {
                    for (var i = 0; i < length; i++) {
                        var opt = '<li style="background-color:white;"><a >' + msg[i].name + '</a></li>';
                        $("#user-list").append(opt);

                    }
                }
            });
        }
        else
        {
            $('#user-list li').empty();
        }
    });


    $("#tweet-box").on("click", function() {
        if ($("#tweet-box").attr("class") == 'tweet-small') {
            $("#tweet-box").toggleClass('tweet-large', true);
            $("#tweet-box").toggleClass('tweet-small', false);
            $("#tweet-counter").append('<span id="text-counter" style="margin-left: 230px;color: gray;font-weight: 600;">140</span><span><button id="tweet-button" class="tweet-button" style="height: 42px;width: 101px;border-radius: 10px;background-color: gray;margin-left: 10px;" disabled="disabled">Tweet</button></span>').css("margin-bottom", "20px");
        }
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
//create Tweet
    $('#tweet-counter').on("click", $('#tweet-button'), function(e) {
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
            console.log(msg);
            if (msg === "success")
            {

                $('.tweets').empty();
                getUserFeed();
                $("#tweet-box").val('');
            }
        });
    });




});

function timeconvert(x)
{
    var ds = x.time_created;
    var day = new Date((new Date(ds.replace(' ', 'T') + 'Z')).toUTCString());
    var t = Math.floor(((new Date()).getTime() - day.getTime()) / 1000);
    var s = t % 60;
    t = Math.floor(t / 60);
    var m = t % 60;
    t = Math.floor(t / 60);
    var h = t % 24;
    var d = Math.floor(t / 24);

    //(d>0?d+' d '+h+' h ago':(h>0?h+' h '+m+' m ago':(m>0?m+' m '+s+' s ago':s+' s ago')))
    return (d > 0 ? d + 'd ' + h + 'h ago' : (h > 0 ? h + 'h ' + m + 'm ago' : (m > 0 ? m + 'm ' + s + 's ago' : s + 's ago')));
}

function getUserFeed()
{
    var requestURL = 'http://localhost/twimini/index.php/userFeedController/getUserFeed';
    // console.log(requestURL);
    var data = {'handle': handle,
        'count': 50,
        'tid': 0};
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
            for (var i = 0; i < msg[1].length; i++)
            {
                var x = msg[1][i];
                var t = timeconvert(x);
                $('.tweets').append('<div id="' + x.tid + '"class="media tweet-object">' +
                        '<a class="pull-left" href="#">' +
                        '<img class="media-object" src="http://localhost/twimini/libs/images/dp.jpg" alt="..." style="height: 60px;width: 60px;">' +
                        '</a>' +
                        '<div class="media-body">' +
                        '<h4 class="media-heading">' + x.name + ' @' + x.handle + ' ' + t + ((x.retweeter_id) ? '<span style="float: right;padding-right: 10px;color: lightslategray;">Retweeted by ' + ((x.retweeter_handle == handle) ? 'You' : x.retweeter_handle) + '</span></h4>' : '</h4>') +
                        x.tweet +
                        //(x.retweeter_handle ? '<div style="color:#707070 font-size: 12pt">Retweeted by @' + x.retweeter_handle + '</div>' : '') +
                        '</div>' +
                        ((x.handle != handle) ? '<br><div class="tweet-bottom-panel"><a class="retweet-link" style="cursor: pointer">Retweet</a></div>' : '<br><div style="padding-bottom:15px"></div>') +
                        '</div>');
            }
        }

        //Retweet
        $('.tweet-bottom-panel').on("click", $('.retweet-link'), function(e) {
            var requestURL = 'http://localhost/twimini/index.php/userFeedController/retweet';
            var tweetobj=e.target.parentElement.parentElement;
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
                    var head=$('#'+tweetobj.id).find('.media-heading');
                    var span = head.find('span');
                    if(span.length){span.empty();span.text('Retweeted by You');}
                    else head.append('<span style="float: right;padding-right: 10px;color: lightslategray;">Retweeted by You</span>');
                }
            });
        });
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