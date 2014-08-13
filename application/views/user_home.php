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
                    <a class="navbar-brand" href="<?php echo base_url(); ?>/index.php/userHomeController/"><b><span class="brand_name">TwiMini</span></b></a>
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
                                <li><a href="#">Logout</a></li>

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
                <div class="panel panel-default bio_panel">
                    <div class="bio_panel_heading panel-heading " style="background-color: lightblue;"><span class="bio-title">Your Profile</span></div>
                    <div class="panel-body">

                        <!-- ===========DISPLAY PIC GOES HERE========= -->
                        <div class="row"> <img src="//placehold.it/200x200" class="img-responsive "style="width: 100%;" ></div>
                        <div class="row">
                            <!-- ========== BIO DETAILS GOES HERE =========== -->
                            <pre>
                              <p>
                                            Lorem ipsum dolor sit amet, consectetur adipi
                                            Lorem ipsum dolor sit amet, consectetur adipic
                                             Lorem ipsum dolor sit amet, consectetur adipi
                                </p>

                            </pre>


                        </div>
                    </div>
                </div>



            </div>


            <div class="col-sm-6 col-md-6 col-lg-6">
                <!-- ==============================USER BIO GOES HERE========================= -->
                <div class="panel panel-default news-feed">
                    <div class=" panel-heading " style="background-color: lightblue;"><span class="news-feed-title">Your Profile</span></div>
                    <div class="panel-body">

                        <div class="tabbable">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab1" data-toggle="tab">Section 1</a></li>
                                <li><a href="#tab2" data-toggle="tab">Section 2</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <p>I'm in Section 1.</p>
                                </div>
                                <div class="tab-pane" id="tab2">
                                    <p>I'm in Section 2.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>


            <div class="col-sm-3 col-md-3 col-lg-3">
                <!-- ==============================USER BIO GOES HERE========================= -->
                <div class="panel panel-default follow-panel">
                    <div class=" panel-heading " style="background-color: lightblue;"><span class="follow-panel-heading">Follow These People.</span></div>
                    <div class="panel-body">

                        <!-- ===========DISPLAY PIC GOES HERE========= -->

                        <div class="row">
                            <!-- ========== BIO DETAILS GOES HERE =========== -->
                            <pre>
                              <p>
                                            Lorem ipsum dolor sit amet, consectetur adipi
                                            Lorem ipsum dolor sit amet, consectetur adipic
                                             Lorem ipsum dolor sit amet, consectetur adipi
                                </p>

                            </pre>


                        </div>
                    </div>
                </div>



            </div>














        </div>




        <script type="text/javascript" src="<?php echo base_url(); ?>libs/js/jquery.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>libs/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>libs/js/user_home.js"></script>

    </body>
</html>