$(document).ready(function() {
    var requestURL = 'http://localhost/twimini/index.php/userFeedController/getUserFeed';
    console.log(requestURL);
    var data = {'handle': 'suraj',
        'count': 50,
        'tid': 0};

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
                
                $('.tweets').append('<div class="media tweet-object">' +
                        '<a class="pull-left" href="#">' +
                        '<img class="media-object" src="http://localhost/twimini/libs/images/dp.jpg" alt="..." style="height: 60px;width: 60px;">' +
                        '</a>' +
                        '<div class="media-body">' +
                        '<h4 class="media-heading">@' + msg[1][i].handle + '</h4>' +
                        msg[1][i].tweet +
                        '...' +
                        ' </div>' +
                        '</div>');
            }

        }






    }).fail(function(XHR, status, response) {
        console.log(response);
    });
});


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