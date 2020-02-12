
<?php if ($slider): ?>
    <div class="main-slider">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php foreach ($slider as $skey => $slide): ?>
                    <?php
                        if ($skey == 0) {
                            $class = 'active';
                        }
                        else{
                            $class = 'khali';
                        }
                    ?>
                    <div class="item <?=$class?>">
                        <a href="<?=$slide['link']?>"><img src="<?=UPLOADS.$slide['img']?>" alt="<?=$slide['link']?>"></a>
                        <div class="carousel-caption"></div>
                    </div>
                <?php endforeach ?>
            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div><!-- /slider -->
<?php endif ?>

<div class="about">
    <div class="container">
        <div class="row">
            <h3 class="subtitle fancy"><span>About Us</span></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio nam laboriosam alias reiciendis atque illo, at. Corporis molestias quibusdam, sequi rerum qui minima ipsam repellat illum eius perspiciatis, iste quia. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio nam laboriosam alias reiciendis atque illo, at. Corporis molestias quibusdam, sequi rerum qui minima ipsam repellat illum eius perspiciatis, iste quia.</p>
            <!-- <button class="btn btn-primary">Read More</button> -->
        </div>
    </div>
</div><!-- /about -->

<div class="parallax">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                
            </div><!-- /4 -->
        </div><!-- /row -->
    </div><!-- /container --> 
</div><!-- /services -->

<div class="full-width-section remove-border ">
    <div class="container">
        <div class="dt-sc-margin70"></div>
        <h3 class="subtitle fancy"><span>Why Choose Us?</span></h3>
        <div class="dt-sc-margin60"></div>
        <?php if ($services): ?>
            <?php foreach ($services as $key => $s): ?>
                <div class="column dt-sc-one-third no-space <?php if ($key == '0' || $key == '3'): ?>first <?php endif ?>text-aligncenter" style="padding:70px 0; <?php if ($key > '2'): ?>border-width:0 1px 0 0; <?php elseif($key == '2'): ?> border-width:0 0 1px 0; <?php else: ?> border-width:0 1px 1px 0; <?php endif ?> border-style: dashed; border-color:#cccccc;">
                    <div class="dt-sc-ico-content type12">
                        <div class="icon-wrapper">
                            <span><img src="<?=UPLOADS.$s['icon']?>" title="<?=$s['name']?>" alt="<?=$s['name']?>"></span>
                        </div>
                        <h4><a href="<?=BASEURL?>services/<?=$s['slug']?>"><?=$s['name']?></a></h4>
                        <a href="<?=BASEURL?>services/<?=$s['slug']?>">View Detail<span class="fa fa-long-arrow-right"></span></a>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
        <div class="dt-sc-margin100"></div>
    </div>
</div>


<div class="partners">
    <div class="container">
        <h3 class="subtitle fancy"><span>Our Partners</span></h3>
        <section class="regular slider">
            <?php foreach ($slider as $skey => $slide): ?>
                <div class="image-slide">
                    <img src="<?=UPLOADS.$slide['img']?>" alt="<?=$slide['link']?>">
                </div>
                <div class="image-slide">
                    <img src="<?=UPLOADS.$slide['img']?>" alt="<?=$slide['link']?>">
                </div>
                <div class="image-slide">
                    <img src="<?=UPLOADS.$slide['img']?>" alt="<?=$slide['link']?>">
                </div>
            <?php endforeach ?>
        </section>
    </div>
</div><!-- /partners -->


<div class="testimonial">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                    <!-- Bottom Carousel Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#quote-carousel" data-slide-to="1"></li>
                        <li data-target="#quote-carousel" data-slide-to="2"></li>
                    </ol>    
                    <!-- Carousel Slides / Quotes -->
                    <div class="carousel-inner">
                        <!-- Quote 1 -->
                        <div class="item active">
                            <div class="row">
                                <div class="col-sm-12">
                                    <p>&ldquo;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Etiam porta sem malesuada magna mollis euismod. Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget metus.&rdquo;</p>
                                    <small><strong>Vulputate M., Dolor</strong></small>
                                </div>
                            </div>
                        </div><!-- /item -->
                        <!-- Quote 2 -->
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-12">
                                    <p>&ldquo;Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.&rdquo;</p>
                                    <small><strong>Fringilla A., Vulputate Sit</strong></small>
                                </div>
                            </div>
                        </div><!-- /item -->
                        <!-- Quote 3 -->
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-12">
                                    <p>&ldquo;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Etiam porta sem malesuada magna mollis euismod. Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget metus.&rdquo;</p>
                                    <small><strong>Vulputate M., Dolor</strong></small>
                                </div>
                            </div>
                        </div><!-- /item -->
                    </div><!-- /carousel-inner -->
                </div> <!-- /carousel slide -->
            </div><!-- /12 -->
        </div><!-- /row -->
    </div><!-- /container --> 
</div><!-- /testimonial -->