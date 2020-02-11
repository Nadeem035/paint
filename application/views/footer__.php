     <div id="bot1" class="clearfix">
            <div class="logo2_wrapper">
                <a href="#home" class="logo2 scroll-to">
                    <img src="<?=IMG?>logo2.png" alt="" class="img-responsive-old">
                </a>
            </div>
            <div class="social_wrapper_bot">
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
        <div id="bot2" class="clearfix">
            Copyright © 2020. All rights reserved. &nbsp;&nbsp; [ &nbsp;&nbsp; <a href="#">Privacy Policy</a> &nbsp;&nbsp; ] &nbsp;&nbsp; [ &nbsp;&nbsp; <a href="#">Terms of Use</a> &nbsp;&nbsp; ]
        </div>
    </div>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <script src="<?=JS?>bootstrap.m.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function() {
            $('select.services').selectpicker();
            $('#dataTable').DataTable();
            $('.dropdown-class').on('click', function() {
                $(this).parent('.list-group-item').children('.menu-drop').toggle(400);
            });
        });//onload 
    </script>
</body>
</html>