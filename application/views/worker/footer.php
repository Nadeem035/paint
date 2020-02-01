    <!-- Footer -->
  <footer class="site-footer">
    <div class="site-footer-legal">© <?=date('Y')?> <a href="javascript://">Paint</a></div>
    <div class="site-footer-right">
      Crafted with <i class="red-600 icon md-favorite"></i> by <a href="http://hildes.info">HilDes</a>
    </div>
  </footer>
  <!-- Core  -->
  <script src="<?=GLOBAL_?>vendor/jquery/jquery.js"></script>
  <script src="<?=GLOBAL_?>vendor/bootstrap/bootstrap.js"></script>
  <script src="<?=GLOBAL_?>vendor/animsition/animsition.js"></script>
  <script src="<?=GLOBAL_?>vendor/asscroll/jquery-asScroll.js"></script>
  <script src="<?=GLOBAL_?>vendor/mousewheel/jquery.mousewheel.js"></script>
  <script src="<?=GLOBAL_?>vendor/asscrollable/jquery.asScrollable.all.js"></script>
  <script src="<?=GLOBAL_?>vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
  <script src="<?=GLOBAL_?>vendor/waves/waves.js"></script>
  <!-- Plugins -->
  <script src="<?=GLOBAL_?>vendor/switchery/switchery.min.js"></script>
  <script src="<?=GLOBAL_?>vendor/intro-js/intro.js"></script>
  <script src="<?=GLOBAL_?>vendor/screenfull/screenfull.js"></script>
  <script src="<?=GLOBAL_?>vendor/slidepanel/jquery-slidePanel.js"></script>
  <script src="<?=GLOBAL_?>vendor/datatables/jquery.dataTables.js"></script>
  <script src="<?=GLOBAL_?>vendor/datatables-fixedheader/dataTables.fixedHeader.js"></script>
  <script src="<?=GLOBAL_?>vendor/datatables-bootstrap/dataTables.bootstrap.js"></script>
  <script src="<?=GLOBAL_?>vendor/datatables-responsive/dataTables.responsive.js"></script>
  <script src="<?=GLOBAL_?>vendor/datatables-tabletools/dataTables.tableTools.js"></script>
  <script src="<?=GLOBAL_?>vendor/asrange/jquery-asRange.min.js"></script>
  <script src="<?=GLOBAL_?>vendor/bootbox/bootbox.js"></script>
  <script src="<?=GLOBAL_?>vendor/jquery-placeholder/jquery.placeholder.js"></script>
  <script type="text/javascript" src="<?=GLOBAL_?>js/jquery.validate.min.js" ></script>
  <script src="<?=GLOBAL_?>vendor/formvalidation/formValidation.min.js"></script>
  <script src="<?=GLOBAL_?>vendor/formvalidation/framework/bootstrap.min.js"></script>
  <script src="<?=GLOBAL_?>vendor/jquery-ui/jquery-ui.js"></script>
  <script src="<?=GLOBAL_?>vendor/blueimp-tmpl/tmpl.js"></script>
  <script src="<?=GLOBAL_?>vendor/blueimp-canvas-to-blob/canvas-to-blob.js"></script>
  <script src="<?=GLOBAL_?>vendor/blueimp-load-image/load-image.all.min.js"></script>
  <script src="<?=GLOBAL_?>vendor/blueimp-file-upload/jquery.fileupload.js"></script>
  <script src="<?=GLOBAL_?>vendor/blueimp-file-upload/jquery.fileupload-process.js"></script>
  <script src="<?=GLOBAL_?>vendor/blueimp-file-upload/jquery.fileupload-image.js"></script>
  <script src="<?=GLOBAL_?>vendor/blueimp-file-upload/jquery.fileupload-audio.js"></script>
  <script src="<?=GLOBAL_?>vendor/blueimp-file-upload/jquery.fileupload-video.js"></script>
  <script src="<?=GLOBAL_?>vendor/blueimp-file-upload/jquery.fileupload-validate.js"></script>
  <script src="<?=GLOBAL_?>vendor/blueimp-file-upload/jquery.fileupload-ui.js"></script>
  <script src="<?=GLOBAL_?>vendor/dropify/dropify.min.js"></script>
  <script src="<?=GLOBAL_?>vendor/summernote/summernote.min.js"></script>
  <!-- Scripts -->
  <script src="<?=GLOBAL_?>js/core.js"></script>
  <script src="<?=GLOBAL_?>assets/js/site.js"></script>
  <script src="<?=GLOBAL_?>assets/js/sections/menu.js"></script>
  <script src="<?=GLOBAL_?>assets/js/sections/menubar.js"></script>
  <script src="<?=GLOBAL_?>assets/js/sections/gridmenu.js"></script>
  <script src="<?=GLOBAL_?>assets/js/sections/sidebar.js"></script>
  <script src="<?=GLOBAL_?>js/configs/config-colors.js"></script>
  <script src="<?=GLOBAL_?>assets/js/configs/config-tour.js"></script>
  <script src="<?=GLOBAL_?>js/components/asscrollable.js"></script>
  <script src="<?=GLOBAL_?>js/components/animsition.js"></script>
  <script src="<?=GLOBAL_?>js/components/slidepanel.js"></script>
  <script src="<?=GLOBAL_?>js/components/switchery.js"></script>
  <script src="<?=GLOBAL_?>js/components/tabs.js"></script>
  <script src="<?=GLOBAL_?>js/components/datatables.js"></script>
  <script src="<?=GLOBAL_?>js/components/jquery-placeholder.js"></script>
  <script src="<?=GLOBAL_?>js/components/material.js"></script>
  <script src="<?=GLOBAL_?>assets/examples/js/forms/validation.js"></script>
  <script src="<?=GLOBAL_?>js/components/dropify.js"></script>
  <script src="<?=GLOBAL_?>assets/examples/js/forms/uploads.js"></script>
  <script src="<?=GLOBAL_?>js/components/summernote.js"></script>
  <script src="<?=GLOBAL_?>assets/examples/js/forms/editor-summernote.js"></script>
  <script>
  (function(document, window, $) {
    'use strict';
    var Site = window.Site;
    $(document).ready(function() {
      Site.run();
    });
  })(document, window, jQuery);
  </script>
</body>
</html>


<!-- 

<script type="text/javascript">
  $(document).ready(function(e){
    $("#form-login").validate({
    errorElement: "div",
        wrapper: "div",  // a wrapper around the error message
        errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertBefore(element)
            error.addClass('message');  // add a class to the wrapper
            error.css('position', 'absolute');
            error.css('margin-left', 10);
            error.css('margin-top', 50);
      error.css('border-radius','4px');
      error.css('border','1px solid #b2b2b2');
      error.css('padding','0 5px');
      error.css('color','#fff');
        }
  });
    
  });
</script> -->

<script type="text/javascript">
$.extend($.validator.messages, {
    required: "",
    minlength: "",
    maxlength: ""
});
</script>
<script type="text/javascript">
  
$(function(){
  $("li[rel=<?=strtolower($menu)?>]").addClass("active");
  $("li[rel=<?=strtolower($menu)?>]").parent('ul').parent("li").addClass('active');
  $("li[rel=<?=strtolower($menu)?>]").parent('ul').parent("li").addClass('open');
});
</script>


<style>
div.theatre-cover{
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  background: rgba(0,0,0,.9);
  z-index: 2000;
  display: none;
}
div.theatre-cover img{
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  margin: auto;
  width: auto;
  height: auto;
  max-width: 100%;
  max-height: 100%;
}
</style>
<div class="theatre-cover image">
    <img src="<?=IMG?>loader.svg">
</div>