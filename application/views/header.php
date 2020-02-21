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
    <div class="overlay"></div>
    <div class="header">
        <div class="top-bar-head">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <?php if ($_SESSION['painter']): ?>
                            <a href="<?=BASEURL?>painter/dashboard" class="btn btn-default">Dashboard</a>
                            <a href="<?=BASEURL?>painter/logout" class="btn btn-default"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                        <?php elseif ($_SESSION['affiliate']): ?>
                            <a href="<?=BASEURL?>affiliate/dashboard" class="btn btn-default">Dashboard</a>
                            <a href="<?=BASEURL?>affiliate/logout" class="btn btn-default"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                        <?php else: ?>
                            <a class="btn btn-primary btn-sm" href="<?=BASEURL?>affiliate">Affiliate Login</a>
                            <a class="btn btn-success btn-sm" href="<?=BASEURL?>painter">Painter Login</a>
                        <?php endif ?>
                    </div><!-- /6 -->
                </div><!-- /row -->
            </div><!-- /container -->
        </div><!-- /top-bar -->
        <!-- <div class="menu-bar">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-md-4">
                        <div class="logo">
                            <a href="<?=BASEURL?>">
                                <img src="<?=IMG?>logo.png">
                            </a>
                        </div>
                    </div>/4
                    <div class="col-xs-6 col-md-8">
                        <div class="menu">
                            <ul>
                                <li><a href="<?=BASEURL?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                                <li><a href="<?=BASEURL?>lead"><i class="fa fa-file" aria-hidden="true"></i> Buy Leads</a></li>
                                <li><a href="javascript://"><i class="fa fa-users" aria-hidden="true"></i> Affiliates</a></li>
                                <li class="dropdown-li"><a href="javascript://"><i class="fa fa-wrench" aria-hidden="true"></i> Services</a>
                                    <ul style="width: 200px;">
                                        <?php foreach ($ser as $key => $s): ?>
                                            <li><a href="<?=BASEURL.'services/'.$s['slug']?>"><?=$s['name']?></a></li>
                                        <?php endforeach ?>
                                    </ul>
                                </li>
                                <li><a href="javascript://">About</a></li>
                                <li><a href="javascript://"><i class="fa fa-phone" aria-hidden="true"></i> Contact</a></li>
                            </ul>
                        </div>
                        <div class="open-btn">
                            <button class="btn btn-default open">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>
                    </div>/8
                </div>/row
            </div>/container
        </div>/menu-bar
        <div class="mobile-menu">
            <button type="button" class="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul>
                <li><a href="<?=BASEURL?>">Home</a></li>
                <li><a href="<?=BASEURL?>lead">Buy Leads</a></li>
                <li><a href="javascript://">Affiliates</a></li>
                <li class="dropdown-li"><a href="javascript://">Services <i class="fa fa-angle-down"></i></a>
                    <ul>
                        <?php foreach ($ser as $key => $s): ?>
                            <li><a href="<?=BASEURL.'services/'.$s['slug']?>"><?=$s['name']?></a></li>
                        <?php endforeach ?>
                    </ul>
                </li>
                <li><a href="javascript://">About</a></li>
                <li><a href="javascript://">Contact</a></li>
            </ul>
        </div> -->

        <div class="menu-bar">
            <nav class="navbar navbar-default">
              <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="logo">
                        <a class="navbar-brand" href="<?=BASEURL?>">
                            <img src="<?=IMG?>logo.png">
                        </a>
                    </div>
                </div>
                <div class="collapse navbar-collapse menu" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?=BASEURL?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                        <li><a href="<?=BASEURL?>lead"><i class="fa fa-file" aria-hidden="true"></i> Buy Leads</a></li>
                        <li><a href="javascript://"><i class="fa fa-users" aria-hidden="true"></i> Affiliates</a></li>
                        <li class="dropdown-li"><a href="javascript://"><i class="fa fa-wrench" aria-hidden="true"></i> Services</a>
                            <ul style="width: 200px;">
                                <?php foreach ($ser as $key => $s): ?>
                                    <li><a href="<?=BASEURL.'services/'.$s['slug']?>"><?=$s['name']?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </li>
                        <li><a href="javascript://">About</a></li>
                        <li><a href="javascript://"><i class="fa fa-phone" aria-hidden="true"></i> Contact</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>
        </div>
    </div><!-- /header -->