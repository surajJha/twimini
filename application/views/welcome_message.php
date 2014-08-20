<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Welcome to CodeIgniter</title>
        <script type="text/javascript" src="<?php echo base_url(); ?>libs/js/jquery.min.js"></script>
        <script type="text/javascript">


            function showlocation() {
                // One-shot position request.
                navigator.geolocation.getCurrentPosition(callback);
            }

            function callback(position) {
                document.getElementById('latitude').innerHTML = position.coords.latitude;
                document.getElementById('longitude').innerHTML = position.coords.longitude;
                var latt = position.coords.latitude;
                var long = position.coords.longitude;
                $.ajax(
                        {
                            type: 'POST',
                            url: 'http://localhost/twimini/index.php/loginController/getaddress',
                            cache: false,
                            dataType: 'json',
                            data: {'lat': latt, 'lon': long},
                            success: function(response)
                            {
                                console.log(response);

                            },
                            error: function()
                            {
                                $("#register_error_message").html("Registration failed. Please try again!");
                                //error message
                            }
                        });
            }





        </script>

    </head>
    <body>

        <input type="button" value="Show Location"
               onclick="showlocation()" />   <br/>

        Latitude: <span id="latitude"></span>       <br/>

        Longitude: <span id="longitude"></span>


        <form action="<?php echo base_url();?>index.php/userProfileController/uploadPic" method="POST" enctype="multipart/form-data" >
            Select File To Upload:<br />
            <input type="file" name="userfile"  />
            <br /><br />
            <input type="submit" name="submit" value="Upload" class="btn btn-success" />
        </form>



    </body>
</html>