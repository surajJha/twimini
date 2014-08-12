<!DOCTYPE html>
<html>
    <head>
        <title>TwiMini..</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>libs/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>libs/css/user_home.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">


    </head>
    <body>
        <div class="container">
            <div class="row mynav">
                <!-- NAVBAR GOES HERE=============================================================-->
                <nav class="navbar navbar-default" role="navigation">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">TwiMini</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse problem" id="bs-example-navbar-collapse-1">

                        <div class="col-sm-3 col-md-3">
                            <form class="navbar-form navbar-right" role="search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" name="q">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <ul class="nav navbar-nav navbar-right dropdown-box">

                            <li class="dropdown dropdown-box-inner">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                                <ul class="dropdown-menu  mydrop">
                                    <li><a href="#">Edit Profile</a></li>


                                    <li class="divider"></li>
                                    <li><a href="#">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </nav>	
            </div>

            <div class="row">
                <!-- MAIN CONTENT GOES HERE======================================================-->
                <div class="col-lg-3 bio">
                    <div class="panel panel-default ">
                        <div class="panel-heading bio-heading">Your Name</div>
                        <div class="panel-body biobody">Content here..</div>
                    </div>
                </div>

                <div class="col-lg-offset-4 newsfeed">
                    <div class="panel panel-default ">
                        <div class="panel-heading tweet-heading">Tweets .........</div>
                        <div class="panel-body">
                            <>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <!-- FOOTER GOES HERE=================================================================-->

            </div>

        </div>




        <script type="text/javascript" src="<?php echo base_url(); ?>libs/js/jquery.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>libs/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/user_home.js"></script>
        <script type="text/javascript">
            var k = document.querySelector('.dropdown-box').addEventListener('click', function(e) {
                e.target.style.backgroundColor = 'lightgreen';
            });


        </script>
    </body>
</html>