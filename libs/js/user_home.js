$(document).ready(function() {
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
            // console.log(msg[1][0].retweeter_id);
            for (var i = 0; i < msg[1].length; i++)
            {
                var x = msg[1][i];
                var t = timeconvert(x);

                $('.tweets').append('<div class="media tweet-object">' +
                        '<a class="pull-left" href="#">' +
                        '<img class="media-object" src="http://localhost/twimini/libs/images/dp.jpg" alt="..." style="height: 60px;width: 60px;">' +
                        '</a>' +
                        '<div class="media-body">' +
                        '<h4 class="media-heading">' + x.name + ' @' + x.handle + ' '+t+'</h4>' +
                        x.tweet +
                        //(x.retweeter_handle ? '<div style="color:#707070 font-size: 12pt">Retweeted by @' + x.retweeter_handle + '</div>' : '') +
                        '</div>' +
                        '</div>');
            }
        }
    });




// function for autocomplete search users ===================================

    $("#search_users").on("keyup",function(){
            var value = $("#search_users").val();
            //search_users
            var data = {'search_users': value};
            if(value != '')
            {
            $.ajax(
                {   
                    
                    type: 'POST',
                    url: 'http://localhost/twimini/index.php/userSearchController/searchUsers',
                    cache: false,
                    data: data,
                    dataType: 'json'
                    
                }).done(function(msg){
                  //  var x =$.parseJSON(response);
                     //console.log(response);
                    var length = msg.length;
                    //$("#users").empty();
                    $('#user-list li').empty();
                    console.log(msg);
                    if(length){
                    for(var i = 0;i<length;i++){
                        var opt = '<li style="background-color:white;"><a >'+msg[i].name+'</a></li>';
                        $("#user-list").append(opt);
                        
                    }}
                });
            }
            else
            {
                $('#user-list li').empty();
            }
    });

});

function timeconvert(x)
{
    var ds = x.time_created;
    var day = new Date((new Date(ds.replace(' ', 'T') + 'Z')).toUTCString());
    var t = Math.floor(((new Date()).getTime() - day.getTime())/1000);
    var s=t%60;
    t= Math.floor(t/60);
    var m=t%60;
    t= Math.floor(t/60);
    var h=t%24;
    var d= Math.floor(t/24);
    
    //(d>0?d+' d '+h+' h ago':(h>0?h+' h '+m+' m ago':(m>0?m+' m '+s+' s ago':s+' s ago')))
    return (d>0?d+'d '+h+'h ago':(h>0?h+'h '+m+'m ago':(m>0?m+'m '+s+'s ago':s+'s ago')));
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