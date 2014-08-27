<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TwiMini..</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>libs/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>libs/css/jquery-ui.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>libs/css/user_home.css">



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

                                    <input type="text" class="form-control" placeholder="Search users" name="search_users" id="search_users">
                                    <!--<datalist id="users"></datalist>-->
                                    <ul id="user-list" style="list-style-type: none;margin-top: 35px;position: absolute;width: 100%;padding-left: 1px;padding-right: 0px;"></ul>
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
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="panel panel-default bio_panel">
                            <div id="tweet-panel" class="bio_panel_heading panel-heading " style="background-color: lightblue;"><span class="bio-title">@<?php echo $user_info[0]['handle'];?>&nbsp;<i class="glyphicon glyphicon-user"></i></span></div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                         <img class=' img-responsive visitor_user_pic' src="http://localhost/twimini/profilepics/<?php echo $user_info[0]['profile_pic'];?>">
                                    </div>
                                   
                                </div> 
                                
                                <div class="row">
                                    <div class="col-sm-2 col-md-2 col-lg-2 "></div>
                                    <div class="col-sm-8 col-md-8 col-lg-8 vis-bio">
                                  
                                        <span class='visitor-bio'><b>Name :</b></span> <span class="visitor-bio-text"><?php echo $user_info[0]['name'];?></span>
                                           
                                       
                                        <span> </span>
                                    </div>
                                     <div class="col-sm-2 col-md-2 col-lg-2 "></div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-2 col-md-2 col-lg-2 "></div>
                                    <div class="col-sm-8 col-md-8 col-lg-8 vis-bio">
                                  
                                        <span class='visitor-bio'><b>BIO :</b></span > <span class="visitor-bio-text"><?php echo $user_info[0]['bio'];?></span>
                                           
                                       
                                        <span> </span>
                                    </div>
                                     <div class="col-sm-2 col-md-2 col-lg-2 "></div>
                                </div>
                                
                                 <div class="row">
                                    <div class="col-sm-2 col-md-2 col-lg-2 "></div>
                                    <div class="col-sm-8 col-md-8 col-lg-8 vis-bio">
                                  
                                        <span class='visitor-bio'><b>Gender :</b></span> <span class="visitor-bio-text"><?php  if($user_info[0]['gender']=='m')  echo 'Male';else echo 'Female';?></span>
                                           
                                       
                                        <span> </span>
                                    </div>
                                     <div class="col-sm-2 col-md-2 col-lg-2 "></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 col-md-2 col-lg-2 "></div>
                                    <div class="col-sm-9 col-md-9 col-lg-9 tweet-info" style="padding-top: 3px;">
                                        <div class="row">
                                            <div class="col-sm-4 col-md-4 col-lg-4 tweet-info-coloumns">
                                                <div style="font-weight: bold;color: black;">Tweets</div>
                                                <div><?php echo $tweet[0]['tweet_count']; ?></div>
                                            </div>
                                            <div class="col-sm-4 col-md-4 col-lg-4 tweet-info-coloumns">
                                                <div style="font-weight: bold;color: black;">Followers</div>
                                                <div><?php echo $follower_count[0]['follower_count']; ?></div>
                                            </div>
                                            <div class="col-sm-4 col-md-4 col-lg-4 tweet-info-coloumns">
                                                <div style="font-weight: bold;color: black;">Following</div> 
                                                <div><?php echo $following_count[0]['following_count']; ?></div>
                                            </div>
                                        </div>
                                  
                                        
                                        
                                        
                                    </div>
                                     <div class="col-sm-2 col-md-2 col-lg-2 "></div>
                                </div>
                                
                                
                                
                                
                                
                                
                            </div>

                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12" style="margin-left: 40px;right: 18px;">
                        <a class="btn btn-primary btn-lg edit-profile-button" style="width: 100%;" >Edit Profile&nbsp;&nbsp;<i class="glyphicon glyphicon-edit"></i></a>
                    </div>
                </div>




            </div>


            <div class="col-sm-7 col-md-7 col-lg-7">
                <!-- ==============================USER BIO GOES HERE========================= -->
                <div class="panel panel-default news-feed">
                    <div class=" panel-heading " style="background-color: lightblue;"><span class="news-feed-title">News Feeds&nbsp;&nbsp;<i class="glyphicon glyphicon-list-alt"></i></span></div>
                    <div class="panel-body">

                        <div class="tabbable">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab1" data-toggle="tab">Tweets&nbsp;&nbsp;<i class="glyphicon glyphicon-comment"></i></a></li>
                                <li><a href="#tab2" data-toggle="tab">Following&nbsp;&nbsp;<i class="glyphicon glyphicon-cog"></i></a></li>
                                <li><a href="#tab3" data-toggle="tab">Followers&nbsp;&nbsp;<i class="glyphicon glyphicon-cog"></i></a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <div class="tweets"></div>
                                    <div class="preloader"><center><img src="<?php echo base_url(); ?>libs/712.gif"></center></div>
                                </div>


                                <div class="tab-pane" id="tab2">
                                    <div class="following">
                                        <table style="width:100%"><tbody id="following-table"></tbody></table>
                                    </div>
                                </div>


                                <div class="tab-pane" id="tab3">
                                    <div class="follower">
                                        <table style="width:100%"><tbody id="follower-table"></tbody></table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>



        </div>




        <script type="text/javascript" src="<?php echo base_url(); ?>libs/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>libs/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>libs/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            var sesshandle = '<?php echo $user_data['handle'] ?>';
            var vishandle = '<?php echo $user_info[0]['handle'] ?>';
        </script>
        <script type="text/javascript" src="<?php echo base_url(); ?>libs/js/visit_home.js"></script>


    </body>
</html>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

