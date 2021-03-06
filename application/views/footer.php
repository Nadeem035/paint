    <div class="footer">
        <div class="container">
            <div class="row">
                <!-- <div class="col-md-12">
                    <div class="foot-logo">
                        <img src="<?=IMG?>logo2.png" alt="">
                    </div>
                </div> -->
                <div class="col-md-4">
                    <div class="foot-about">
                        <h3>About</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio delectus velit error, eligendi minima cumque minus explicabo, voluptatibus laudantium autem nostrum dolores quidem repellat ab, sapiente vero illo veritatis. Autem.</p>
                    </div>
                    <div class="social-icons">
                        <ul>
                            <li><a href="javascript://"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="javascript://"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="javascript://"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="javascript://"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="javascript://"><i class="fa fa-google"></i></a></li>
                        </ul>
                    </div>  
                </div><!-- /4 -->
                <div class="col-md-4">
                    <div class="foot-link">
                        <h3>Quick Links</h3>
                        <ul>
                            <li><a href="<?=BASEURL?>">About</a></li>
                            <li><a href="<?=BASEURL?>">Contact Us</a></li>
                        </ul>
                    </div>
                </div><!-- /4 -->
                <div class="col-md-4">
                    <div class="foot-address">
                        <h3>Address</h3>
                        <ul>
                            <li>lahore Pakistan</li>
                            <li>092-12345678</li>
                            <li>info@domain.com</li>
                        </ul>
                    </div>
                </div><!-- /4 -->
            </div><!-- /row -->
        </div><!-- /container -->
    </div><!-- /footer -->
    <div class="copy-right">
        <p class="container">Developed by the <a href="javascript://">Paint Cloud Office</a></p>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="<?=JS?>bootstrap.m.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?=CSS?>slick/slick.js" type="text/javascript" charset="utf-8"></script>
    <script>
        $(function() {
            $('select.services').selectpicker();
            $('#dataTable').DataTable();
            $('.dropdown-class').on('click', function() {
                $(this).parent('.list-group-item').children('.menu-drop').toggle(400);
            });

            $(".regular").slick({
                dots: false,
                infinite: true,
                arrows: false,
                slidesToShow: 5,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 5,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            }); 
            $('#quote-carousel').carousel({
                pause: true, 
                interval: 10000,
            });
            $('.open').on('click', function() {
                $('.mobile-menu').css({'display': 'block'});
                $('.mobile-menu').animate({'right': 0}, 400);
                $('body').css({'overflow-y':'hidden'});
                $('.overlay').fadeIn(400);
            });
            $('.close').on('click', function() {
                $('.mobile-menu').animate({'right': '-250px'}, function(){
                    $('.mobile-menu').css({'display': 'none'});
                });
                $('body').css({'overflow-y':'auto'});
                $('.overlay').fadeOut(400);
            });
        });//onload
    </script>
</body>
</html>
