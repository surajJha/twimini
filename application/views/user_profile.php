<!DOCTYPE html>
<html>
    <head>
        <title>TwiMini..</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>libs/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>libs/css/user_home.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">


    </head>
    <body>
        <?php
        $this->load->library('session');
        $user_data = $this->session->all_userdata();
        ?>

        <div class="row">

            <!-- NAVBAR GOES HERE=============================================================-->


            <nav class="navbar navbar-default mynavbar" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>index.php/userHomeController/"><b><span class="brand_name">TwiMini<i class="glyphicon glyphicon-home"></i></span></b></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">

                    </ul>




                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <form class="navbar-form " role="search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" name="q">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </li>


                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="user_name"><?php echo $user_data['name']; ?></span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Privacy Settings</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/LogoutController">Logout</a></li>

                            </ul>
                        </li>
                    </ul>





                </div><!-- /.navbar-collapse -->
            </nav>

        </div>




        <div class="row">
            <!-- MAIN CONTENT GOES HERE======================================================-->
            <div class="col-sm-4 col-md-4 col-lg-4">
                <!-- ==============================USER BIO GOES HERE========================= -->
                <div class="panel panel-default edit_profile_panel">
                    <div class="bio_panel_heading panel-heading " style="background-color: lightblue;"><span class="bio-title">Edit Profile&nbsp;<i class="glyphicon glyphicon-user"></i></span></div>
                    <div class="panel-body">
                        <form class="form-horizontal" id="edit_profile" method="post">
                            <fieldset>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="name">Name</label>  
                                    <div class="col-md-6">
                                        <input id="name" name="name" type="text" value="<?php echo $user_data['name'];?>" class="form-control input-md">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="handle">Handle</label>  
                                    <div class="col-md-6">
                                        <input disabled="disabled" id="handle" name="handlemain" type="text" value="@<?php echo $user_data['handle'];?>" class="form-control input-md">
                                        <input type="hidden" name="handle" value="<?php echo $user_data['handle'];?>">
                                    </div>
                                </div>

                                <!-- Password input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="passwordinput">Password</label>
                                    <div class="col-md-6">
                                        <input id="passwordinput" name="passwordinput" type="password" placeholder="" class="form-control input-md">

                                    </div>
                                </div>

                                <!-- Password input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="passwordconfirm">Confirm Password</label>
                                    <div class="col-md-6">
                                        <input id="passwordconfirm" name="passwordconfirm" type="password" placeholder="" class="form-control input-md">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="emailinput">E-mail ID</label>  
                                    <div class="col-md-6">
                                        <input id="emailinput" name="email" type="emailinput" placeholder="<?php echo $user_data['email'];?>" class="form-control input-md" disabled="disabled">

                                    </div>
                                </div>

                                <!-- Multiple Radios -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="gender">Gender</label>
                                    <div class="col-md-6">
                                        <div class="radio">
                                            <label for="gender-0">
                                                <input type="radio" name="gender" id="gender-0" value="m" <?php echo ($user_data['gender']=='m')?'checked="checked"':''; ?> >
                                                Male
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label for="gender-1">
                                                <input type="radio" name="gender" id="gender-1" value="f" <?php echo ($user_data['gender']=='f')?'checked="checked"':''; ?> >
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Textarea -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="bio">Bio</label>
                                    <div class="col-md-6">                     
                                        <textarea class="form-control" id="bio" name="bio"><?php echo $user_data['bio'];?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="profile_pic">Profile Pic</label>
                                    <div class="pic_input" style="margin-left: 198px;margin-top: 21px;">

                                        <input type="file" name="profile_pic"> 
                                    </div>
                                </div>


                                <!-- ========================FILE INPUT===================== -->


                                <hr>
                                <div id="response-message"></div>

                                <div class="edit_profile_footer">

                                    <button id="edit_profile_button" class="btn btn-primary btn-lg edit_profile_button" type="submit" style="margin-left: 186px;">Save Changes</button>
                                </div>

                            </fieldset>
                        </form>


                    </div>
                </div>






            </div>


            <div class="col-sm-7 col-md-7 col-lg-7">
                <!-- ==============================USER BIO GOES HERE========================= -->
                <div class="panel panel-default user_tweets">
                    <div class=" panel-heading " style="background-color: lightblue;"><span class="news-feed-title">User Tweets&nbsp;&nbsp;<i class="glyphicon glyphicon-list-alt"></i></span></div>
                    <div class="panel-body">
                        <div class="tab-pane active" id="tab1">
                            <div class="tweets"></div>
                            <div class="preloader"><center><img src="<?php echo base_url(); ?>libs/712.gif"></center></div>
                        </div>

                    </div>
                </div>
            </div>



        </div>




        <script type="text/javascript" src="<?php echo base_url(); ?>libs/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>libs/js/bootstrap.min.js"></script>
        <script type="text/javascript">var handle = '<?php echo $user_data['handle'] ?>';</script>
        <script type="text/javascript" src="<?php echo base_url(); ?>libs/js/user_profile.js"></script>



    </body>
</html>