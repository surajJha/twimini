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
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="libs/css/mystyle.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
    <body style="background-image: url('libs/images/people1.jpg');background-repeat:no-repeat;background-attachment:fixed;background-position:bottom;background-size: 80% 80%">


        <div class="container">
            <div class="row">

                <center> <h1 class="twitter-heading"><strong>TwiMini App</strong></h1></center>

            </div>



            <!-- =========================================== FORM FOR LOGIN AND SIGNUP========================================-->

            <div class="row">
                <div class="col-md-4 col-md-offset-4 ">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">TwiMini Login</h3>
                        </div>
                        <div class="panel-body">
                            <form accept-charset="UTF-8" role="form">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="yourmail@example.com" name="email" type="text">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                                        </label>
                                    </div>
                                    <input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
                                </fieldset>
                            </form>
                            <hr/>
                            <center><h4>OR</h4></center>

                            <a href="#registerModal" role="button" class="btn btn-lg btn-facebook btn-block" data-toggle="modal">New User? Register</a>
                        </div>
                    </div>
                </div>
            </div>


            <!-- =====================================MODAL code goes here========================================-->

            <div id="registerModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">TwiMini Registration Form</h3>
                        </div>
                        <div class="modal-body">
                            <!-- modal form goes here -->
                            <form class="form-horizontal">
                                <fieldset>

                                    <!-- Form Name -->
                                    <legend>Form Name</legend>

                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="name">Name</label>  
                                        <div class="col-md-4">
                                            <input id="name" name="name" type="text" placeholder="" class="form-control input-md">

                                        </div>
                                    </div>

                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="handle">Handle</label>  
                                        <div class="col-md-4">
                                            <input id="handle" name="handle" type="text" placeholder="@" class="form-control input-md">

                                        </div>
                                    </div>

                                    <!-- Password input-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="passwordinput">Password</label>
                                        <div class="col-md-4">
                                            <input id="passwordinput" name="passwordinput" type="password" placeholder="" class="form-control input-md">

                                        </div>
                                    </div>

                                    <!-- Password input-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="passwordconfirm">Confirm Password</label>
                                        <div class="col-md-4">
                                            <input id="passwordconfirm" name="passwordconfirm" type="password" placeholder="" class="form-control input-md">

                                        </div>
                                    </div>

                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="email">E-mail ID</label>  
                                        <div class="col-md-4">
                                            <input id="email" name="email" type="text" placeholder="" class="form-control input-md">

                                        </div>
                                    </div>

                                    <!-- Multiple Radios -->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="gender">Gender</label>
                                        <div class="col-md-4">
                                            <div class="radio">
                                                <label for="gender-0">
                                                    <input type="radio" name="gender" id="gender-0" value="M" checked="checked">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label for="gender-1">
                                                    <input type="radio" name="gender" id="gender-1" value="F">
                                                    Female
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Textarea -->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="bio">Bio</label>
                                        <div class="col-md-4">                     
                                            <textarea class="form-control" id="bio" name="bio"></textarea>
                                        </div>
                                    </div>

                                    <!-- File Button --> 
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="profile_pic">Profile Picture</label>
                                        <div class="col-md-4">
                                            <input id="profile_pic" name="profile_pic" class="input-file" type="file">
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                        <button class="btn btn-primary" type="submit">Register</button>
                                    </div>

                                </fieldset>
                            </form>

                        </div>

                    </div>
                </div>
            </div>













            <script type="text/javascript" src="libs/js/jquery.min.js"></script>

            <script type="text/javascript" src="libs/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="libs/js/angular.min.js"></script>

    </body>
</html>