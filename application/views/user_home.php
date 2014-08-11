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
                            Using the CSS @import Rule
                            Published March 19, 2008 by Rob Glazebrook.

                            box of crayons

                            Even the most complex style sheet starts out with a single rule. But when you’re working on a particularly massive and complex website, over time your style sheet will inevitably start to reflect the site’s size and complexity. And even if you employ every trick for organizing your CSS in the book, you might find that the sheer size of the file is simply overwhelming. At that point, you might want to consider splitting your style sheet up into several smaller CSS files. That’s when the @import rule can come in quite handy.

                            The @import rule is another way of loading a CSS file. You can use it in two ways. The simplest is within the header of your document, like so:


                            But that isn’t necessarily the best method for keeping your XHTML small and your code clean. To that end, you can import a style sheet from within another stylesheet. And better still, you can import any number of styles this way. So your document’s head could look like this:


                            Nice and clean. But then your “styles.css” document can contain calls to any number of additional style sheets:

                            @import url('/css/typography.css');
                            @import url('/css/layout.css');
                            @import url('/css/color.css');

                            /* All three CSS files above will be loaded from
                            this single document. */
                            This lets you break up your gargantuan stylesheet into two or more logical portions — I chose typography, layout and color for this example, but you might prefer dividing your CSS according to the site sections they style (content versus sidebar, etc) or something similar. Either way, the benefit is immense — you can have the same number of CSS rules overall, but in smaller, easier to manage units.

                            You can even load both your screen and print (or handheld, etc) stylesheets all at the same time using this trick. If you’d like to specify a media, just write your rules like this:


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