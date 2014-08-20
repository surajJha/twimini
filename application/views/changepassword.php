<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>libs/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>libs/css/home.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>


            .password-form{
               // margin-left: 546px;
                margin-top: 50px;
                background-color: brown;
                height: 600px;
                width: 775px;
                opacity: 0.7;
                box-shadow: 0px 0px 20px #555;
                border-radius: 20%;
                position: relative;
                padding: 60px;
                
            }
            
            .myip{
                    border-radius: 10px;
                }


        </style>
    </head>
    <body style="background-color: darkgray;">


        <div class="container">
            <div class="row">

                <center> <h1 class="twitter-heading"><strong>Set New Password</strong></h1></center>

            </div>
            <div class="row">
                 <center>
                <div class="password-form" style="opacity:0.95;">
                     <div class="myform">
                            <form id="password-form" role="form">
                                <input type="hidden" name="handle" value="<?php echo $handle;?>">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input type="password" class="form-control myip" name="password" id="passwordinput">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Confirm Password</label>
                                    <input type="password" class="form-control myip" id="passwordconfirm">
                                </div>
                                <button id="passwd-btn" type="submit" class="btn btn-default">Submit</button>
                            </form>
                        </div>
                    <br><br>
                </div></center>
            </div>

        </div>


        <script type="text/javascript" src="<?php echo base_url(); ?>libs/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>libs/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>libs/js/changepassword.js"></script>


    </body>
</html>

