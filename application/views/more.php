<div id="home-subpage">
    <div id="home-subpage-inner">
        <div class="page_slide" style="background: url(<?=IMG?>page_slide1.jpg) no-repeat center center/cover;">
            <!-- <img src="<?=IMG?>page_slide1.jpg" alt=""> -->
            <div class="main-title">
                <div class="container">
                    <div class="row">
                        <div class="breadcrumb">
                            <a href="<?=BASEURL?>">Home</a> 
                            <span class="fa fa-angle-right"></span>
                            <span class="current">Services</span>
                        </div>
                        <h1>Services</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-9">
                <h2><?=$services['name']?></h2>
                <div class="thumb5">
                    <div class="thumbnail clearfix">
                        <figure>
                            <img src="<?=UPLOADS.$services['img']?>" alt="" class="img-responsive-old">
                        </figure>
                        <div class="caption">
                            <h3>Service!</h3>
                            <p>
                                <?=$services['detail']?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-md-3">

                <div class="block1">

                    <h4>Our Services</h4>

                    <ul class="ul1">
                        <?php foreach ($cat as $key => $c): ?>
                            <li><a href="<?=BASEURL?>services/<?=$c['slug']?>"><?=$c['name']?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div><br>
                <div class="signup-form" style="padding: 0;">
                    <div id="alert">
                        <?php if (isset($_GET['msg'])): ?>
                            <div class="alert alert-success"><?=$_GET['msg']?></div>
                        <?php endif ?>
                    </div>
                    <div class="form-title">
                        <div class="form-block-title">
                            <h2>Generate Lead</h2>
                        </div>
                        <h4><?=$services['name']?></h4>
                    </div>
                    <form action="<?=BASEURL?>service-post-lead" method="post">
                        <input type="hidden" name="services" value="<?=$services['category_id']?>">
                        <div class="row">
                            <div class="col-md-offset-1 col-md-10">
                                <div class="form-group">
                                    <label class="small-font">Name</label>
                                    <input type="text" class="form-control" required name="name">
                                </div><!-- /form-group -->
                            </div><!-- /3 -->
                            <div class="col-md-offset-1 col-md-10">
                                <div class="form-group">
                                    <label class="small-font">Phone</label>
                                    <input type="text" class="form-control" required name="phone">
                                </div><!-- /form-group -->
                            </div><!-- /3 -->
                            <div class="col-md-offset-1 col-md-10">
                                <div class="form-group">
                                    <label class="small-font">Country</label>
                                    <select name="country" class="form-control" required>
                                        <?php if ($q['country'] == 'pakistan'): ?>
                                            <option value="pakistan" selected>Pakistan</option>
                                            <option value="india">India</option>
                                        <?php elseif ($q['country'] == 'india'): ?>
                                            <option value="india" selected>India</option>
                                            <option value="pakistan">Pakistan</option>
                                        <?php else: ?>
                                            <option value="">Select Country</option>
                                            <option value="pakistan">Pakistan</option>
                                            <option value="india">India</option>
                                        <?php endif ?>  
                                    </select>
                                </div><!-- /form-group -->
                            </div><!-- /3 -->
                            <div class="col-md-offset-1 col-md-10">
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" value="Generate Lead">
                                </div>
                            </div><!-- /3 -->
                        </div><!-- /row -->
                    </form>
                </div><!-- /signup-form -->
            </div>
        </div>
    </div>
</div>
