<div id="home-subpage">
    <div id="home-subpage-inner">
        <div class="page_slide"><img src="<?=IMG?>page_slide1.jpg" alt=""></div>
        <div class="slogan_wrapper">
            <div class="">
                <h1>Professional painting services</h1>
                <div class="txt2">is a great way to maintain your property
                    <br>Call today: 1 800 123 4567</div>
            </div>
        </div>
    </div>
</div>

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
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

            <div class="col-sm-3">

                <div class="block1">

                    <h4>Our Services</h4>

                    <ul class="ul1">
                        <?php foreach ($cat as $key => $c): ?>
                            <li><a href="<?=BASEURL?>services/<?=$c['slug']?>"><?=$c['name']?></a></li>
                        <?php endforeach ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
