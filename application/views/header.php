<!DOCTYPE html>
<html lang="en">
<head>
    <title>Painting</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">

    <link rel="icon" href="<?=IMG?>favicon.html" type="image/x-icon">
    <link rel="shortcut icon" href="<?=IMG?>favicon.html" type="image/x-icon" />
    <link href="<?=CSS?>bootstrap.css" rel="stylesheet">
    <link href="<?=CSS?>font-awesome.css" rel="stylesheet">
    <link href="<?=CSS?>superslides.css" rel="stylesheet">
    <link href="<?=CSS?>prettyPhoto.css" rel="stylesheet">
    <link href="<?=CSS?>isotope.css" rel="stylesheet">
    <link href="<?=CSS?>animate.css" rel="stylesheet">
    <link href="<?=CSS?>style.css" rel="stylesheet">
    
    <script src="<?=JS?>jquery.js"></script>
    <script src="<?=JS?>jquery-migrate-1.2.1.min.js"></script>
    <script src="<?=JS?>jquery.easing.1.3.js"></script>
    <script src="<?=JS?>superfish.js"></script>
    <script src="<?=JS?>jquery.queryloader2.js"></script>
    <script src="<?=JS?>jquery.superslides.js"></script>
    <script src="<?=JS?>jquery.appear.js"></script>
    <script src="<?=JS?>jquery.ui.totop.js"></script>
    <script src="<?=JS?>jquery.equalheights.js"></script>
    <script src="<?=JS?>jquery.parallax-1.1.3.resize.js"></script>
    <script src="<?=JS?>SmoothScroll.js"></script>
    <script src="<?=JS?>jquery.prettyPhoto.js"></script>
    <script src="<?=JS?>jquery.isotope.min.js"></script>
    <script src="<?=JS?>cform.js"></script>
    <script src="<?=JS?>scripts.js"></script>
</head>
<body class="onepage front" data-spy="scroll" data-target="#top1" data-offset="127">
    <div id="load"></div>
    <div id="main">
        <div id="top1">
            <div class="top1 clearfix">
                <div class="phone1">Call Us Today! <b>1.555.555.555</b> | <a href="#">info@yourdomain.com</a></div>
                <div class="social_wrapper">
                    <ul class="social clearfix">
                        <li><a href="#"><i class="fa fa-vimeo-square"></i></a></li>
                        <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-rss"></i></a></li>
                    </ul>
                </div>

            </div>
            <div class="top2 clearfix">
                <header>
                    <div class="logo_wrapper">
                        <a href="<?=BASEURL?>#home" class="logo scroll-to">
                            <img src="<?=IMG?>logo.png" alt="" class="img-responsive-old">
                        </a>
                    </div>
                </header>
                <div class="navbar navbar_ navbar-default">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="navbar-collapse navbar-collapse_ collapse">
                        <ul class="nav navbar-nav sf-menu clearfix">
                            <li class="nav1 active"><a href="<?=BASEURL?>#home">Home</a></li>
                            <li class="nav3 sub-menu sub-menu-1"><a href="<?=BASEURL?>#services">Services</a>
                                <ul>
                                    <li><a href="<?=BASEURL?>more">Painting</a></li>
                                    <li><a href="<?=BASEURL?>more">Renovation</a></li>
                                    <li><a href="<?=BASEURL?>more">Garage doors</a></li>
                                    <li><a href="<?=BASEURL?>more">Locksmith</a></li>
                                </ul>
                            </li>
                            <li class="nav4"><a href="<?=BASEURL?>#prices">Projects</a></li>
                            <li class="nav5"><a href="<?=BASEURL?>#gallery">About</a></li>
                            <li class="nav6"><a href="<?=BASEURL?>#contacts">Buy leads</a></li>
                            <li class="nav1"><a href="<?=BASEURL?>#contacts">Affiliates</a></li>
                            <li class="nav2"><a href="<?=BASEURL?>#contacts">Contact</a></li>
                            <?php if ($_SESSION['painter']): ?>
                                <li class="nav5"><a href="<?=BASEURL?>logout">Logout</a></li>
                            <?php else: ?>
                                <li class="nav3 sub-menu sub-menu-1"><a href="javascript://">Login</a>
                                    <ul>
                                        <li><a href="<?=BASEURL?>painter/login">Painter login</a></li>
                                        <li><a href="<?=BASEURL?>affiliate/login">Affiliate login</a></li>
                                        <li><a href="<?=BASEURL?>worker/login">Worker login</a></li>
                                        <li><a href="<?=BASEURL?>admin/login">Admin login</a></li>
                                    </ul>
                                </li>
                                <li class="nav4"><a href="<?=BASEURL?>#contacts">CALL NOW (click to call)</a></li>
                            <?php endif ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>