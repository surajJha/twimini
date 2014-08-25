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
            <div class="col-sm-3 col-md-3 col-lg-3">
                <!-- ==============================USER BIO GOES HERE========================= -->
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="panel panel-default bio_panel">
                            <div id="tweet-panel" class="bio_panel_heading panel-heading " style="background-color: lightblue;"><span class="bio-title">Compose Tweet&nbsp;<i class="glyphicon glyphicon-user"></i></span></div>
                            <div class="panel-body">
                                <div class="row" ><textarea id="tweet-box" class="tweet-small"></textarea></div>                        
                            </div>
                            <div id="tweet-counter"></div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12" style="margin-left: 40px;right: 18px;">
                        <a class="btn btn-primary btn-lg edit-profile-button" style="width: 100%;" href="<?php echo base_url(); ?>index.php/userProfileController">Edit Profile&nbsp;&nbsp;<i class="glyphicon glyphicon-edit"></i></a>
                    </div>
                </div>




            </div>


            <div class="col-sm-6 col-md-6 col-lg-6">
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


            <div class="col-sm-3 col-md-3 col-lg-3">
                <!-- ==============================USER BIO GOES HERE========================= -->
                <div class="panel panel-default follow-panel">
                    <div class=" panel-heading " style="background-color: lightblue;"><span class="follow-panel-heading">Follow These People&nbsp;&nbsp;<i class="glyphicon glyphicon-globe"></i></span></div>
                    <div class="panel-body">

                        <!-- ===========DISPLAY PIC GOES HERE========= -->

                        <div class="row">
                            <!-- ========== PEOPLE YOU MAY FOLLOW =========== -->
                            <div class="col-md-12" id="whoToFollow">

                            </div>


                        </div>
                    </div>
                </div>



            </div>














        </div>




        <script type="text/javascript" src="<?php echo base_url(); ?>libs/js/jquery.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>libs/js/bootstrap.min.js"></script>
        <script type="text/javascript">var handle = '<?php echo $user_data['handle'] ?>';</script>
        <script type="text/javascript" src="<?php echo base_url(); ?>libs/js/user_home.js"></script>

    </body>
</html>
