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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <!-- Datatables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link href="<?=CSS?>bootstrap.css" rel="stylesheet">
    <link href="<?=CSS?>font-awesome.css" rel="stylesheet">
    <link href="<?=CSS?>animate.css" rel="stylesheet">
    <link href="<?=CSS?>slick/slick.css" rel="stylesheet">
    <link href="<?=CSS?>slick/slick-theme.css" rel="stylesheet">
    <link href="<?=CSS?>style.css" rel="stylesheet">
    <link href="<?=CSS?>custom_style.css" rel="stylesheet">
    
    <script src="<?=JS?>jquery.js"></script>
</head>
<body>

<div class="header">
    <div class="top-bar-head">
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <a href="javascript://">mail@domain.com</a>
                </div><!-- /6 -->
                <div class="col-xs-6">
                    <div class="social">
                        <ul>
                            <li><a href="javascript://"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="javascript://"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="javascript://"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="javascript://"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="javascript://"><i class="fa fa-google"></i></a></li>
                        </ul>
                    </div><!-- /social -->
                </div><!-- /6 -->
            </div><!-- /row -->
        </div><!-- /container -->
    </div><!-- /top-bar -->
    <div class="menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-md-4">
                    <div class="logo">
                        <a href="<?=BASEURL?>">
                            <img src="<?=IMG?>logo.png">
                        </a>
                    </div>
                </div><!-- /4 -->
                <div class="col-xs-6 col-md-8">
                    <div class="menu">
                        <ul>
                            <li><a href="javascript://">Home</a></li>
                            <li><a href="javascript://">Buy Leads</a></li>
                            <li><a href="javascript://">Affiliates</a></li>
                            <li class="dropdown-li"><a href="javascript://">Services</a>
                                <ul style="width: 200px;">
                                    <li><a href="<?=BASEURL?>">Home Imporvement</a></li>
                                    <li><a href="<?=BASEURL?>">Renovation</a></li>
                                    <li><a href="<?=BASEURL?>">Paiting</a></li>
                                    <li><a href="<?=BASEURL?>">Locksmith</a></li>
                                    <li><a href="<?=BASEURL?>">Garage doors</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript://">About</a></li>
                            <li><a href="javascript://">Contact</a></li>
                            <?php if ($_SESSION['painter']): ?>
                                <li><a href="<?=BASEURL?>painter/dashboard">Dashboard</a></li>
                                <li><a href="<?=BASEURL?>painter/logout">Logout</a></li>
                            <?php elseif ($_SESSION['affiliate']): ?>
                                <li><a href="<?=BASEURL?>affiliate/dashboard">Dashboard</a></li>
                                <li><a href="<?=BASEURL?>affiliate/logout">Logout</a></li>
                            <?php else: ?>
                                <li class="dropdown-li"><a href="javascript://">Login</a>
                                    <ul>
                                        <li><a href="<?=BASEURL?>painter/login">Painter login</a></li>
                                        <li><a href="<?=BASEURL?>affiliate/login">Affiliate login</a></li>
                                        <li><a href="<?=BASEURL?>worker/login">Worker login</a></li>
                                        <li><a href="<?=BASEURL?>admin/login">Admin login</a></li>
                                    </ul>
                                </li>
                            <?php endif ?>
                        </ul>
                    </div>
                </div><!-- /8 -->
            </div><!-- /row -->
        </div><!-- /container -->
    </div><!-- /menu-bar -->
</div><!-- /header -->