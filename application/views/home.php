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

    </head>
    <body style="background-image: url('<?php echo base_url(); ?>libs/images/people1.jpg');background-repeat:no-repeat;background-attachment:fixed;background-position:bottom;background-size: 80% 80%">


        <div class="container">
            <div class="row">

                <center> <h1 class="twitter-heading"><strong>TwiMini App</strong></h1></center>

            </div>



            <!-- =========================================== FORM FOR LOGIN AND SIGNUP========================================-->

            <div class="row">
                <div class="col-md-4 col-md-offset-4 ">
                    <div class="panel panel-default login-form" >
                        <div class="panel-heading">
                            <h3 class="panel-title login-form-heading">TwiMini Login</h3>
                        </div>
                        <div class="panel-body">
                            <form accept-charset="UTF-8" role="form" method="post" action="<?php echo base_url();?>index.php/loginController/login/">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="yourmail@example.com" name="email" type="email" required>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                                        </label>
                                    </div>
                                    <div >
                                        
                                        <strong><?php echo @$error  ; ?></strong>
                                    </div>
                                    <div >                                        
                                        <strong><a id='forgot-passwd' style="color: blanchedalmond;">Forgot password? Click here</a></strong>                                        
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
                            <form class="form-horizontal" id="register-form" method="post">
                                <fieldset>

                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="name">Name</label>  
                                        <div class="col-md-6">
                                            <input id="name" name="name" type="text" placeholder="" class="form-control input-md" required>
                                            <span class ="input-warning alert alert-danger" id="name-warning"> field length should be greater than 0</span>
                                        </div>
                                    </div>

                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="handle">Handle</label>  
                                        <div class="col-md-6">
                                            <input id="handle" name="handle" type="text" placeholder="@" class="form-control input-md" required>
                                            <span class ="input-warning alert alert-danger" id="handle-warning">field length should be greater than 0</span>
                                        </div>
                                    </div>

                                    <!-- Password input-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="passwordinput">Password</label>
                                        <div class="col-md-6">
                                            <input id="passwordinput" name="passwordinput" type="password" placeholder="" class="form-control input-md" required>
                                            <span class ="input-warning alert alert-danger" id="password-warning">password length must be atlest 3 characters long</span>
                                        </div>
                                    </div>

                                    <!-- Password input-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="passwordconfirm">Confirm Password</label>
                                        <div class="col-md-6">
                                            <input id="passwordconfirm" name="passwordconfirm" type="password" placeholder="" class="form-control input-md" required>
                                            <span class ="input-warning alert alert-danger" id="password-confirm-warning">passwords don't match</span>
                                        </div>
                                    </div>

                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="emailinput">E-mail ID</label>  
                                        <div class="col-md-6">
                                            <input id="emailinput" name="email" type="emailinput" placeholder="" class="form-control input-md" required>
                                            <span class ="input-warning alert alert-danger" id ="email-warning">please enter a valid email address</span>
                                        </div>
                                    </div>

                                    <!-- Multiple Radios -->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="gender">Gender</label>
                                        <div class="col-md-6">
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
                                        <div class="col-md-6">                     
                                            <textarea class="form-control" id="bio" name="bio"></textarea>
                                        </div>
                                    </div>

                                    

                                    <div class="modal-footer">
                                        <button class="btn close-modal" data-dismiss="modal" aria-hidden="true">Close</button>
                                        <button id="register-button" class="btn btn-primary" type="submit">Register</button>
                                    </div>

                                </fieldset>
                            </form>
                            <div class="alert alert-success" id="register_success_message"> </div>
                            <div class="alert alert-warning" id="register_error_message"> </div>
                        </div>

                    </div>
                </div>
            </div>













            <script type="text/javascript" src="<?php echo base_url(); ?>libs/js/jquery.min.js"></script>

            <script type="text/javascript" src="<?php echo base_url(); ?>libs/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>libs/js/home.js"></script>
            

    </body>
</html>
