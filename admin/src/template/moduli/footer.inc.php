        </div>
      </div>
    </div>
  </div>

    <!-- Required Jquery --> 
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/bootstrap/js/bootstrap.min.js"></script> 
    <!-- modalEffects js nifty modal window effects -->
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/assets/js/modalEffects.js"></script>
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/assets/js/classie.js"></script>
   
    <script type="text/javascript" src="<?=BASE_URL_ADMIN?>js/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
              CKEDITOR.config.filebrowserBrowseUrl      = '<?=BASE_URL_ADMIN?>js/ckfinder/ckfinder.html';
              CKEDITOR.config.filebrowserImageBrowseUrl = '<?=BASE_URL_ADMIN?>js/ckfinder/ckfinder.html?type=Images';
              CKEDITOR.config.filebrowserFlashBrowseUrl = '<?=BASE_URL_ADMIN?>js/ckfinder/ckfinder.html?type=Flash';
              CKEDITOR.config.filebrowserUploadUrl      = '<?=BASE_URL_ADMIN?>js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
              CKEDITOR.config.filebrowserImageUploadUrl = '<?=BASE_URL_ADMIN?>js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
              CKEDITOR.config.filebrowserFlashUploadUrl = '<?=BASE_URL_ADMIN?>js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
              CKEDITOR.config.allowedContent            = true;
              CKEDITOR.replaceAll('editor-instance');
    </script>
        <!-- Accordion js -->
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/assets/pages/accordion/accordion.js"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/i18next/js/i18next.min.js"></script>
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/modernizr/js/modernizr.js"></script>
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/modernizr/js/css-scrollbars.js"></script>
    <!-- Select 2 js -->
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/select2/js/select2.full.min.js"></script>
    <!-- list-scroll js -->
    <script src="<?=BASE_URL_SITO?>files/bower_components/stroll/js/stroll.js"></script>
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/assets/pages/list-scroll/list-custom.js"></script>
    <!-- Switch component js -->
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/switchery/js/switchery.min.js"></script>
    <!-- Bootstrap date-time-picker js -->
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/assets/pages/advance-elements/moment-with-locales.min.js"></script>
    <!-- Date-range picker js -->
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/bootstrap-daterangepicker/js/daterangepicker.js"></script>
    <!-- Date-dropper js -->
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/datedropper/js/datedropper.min.js"></script>
    <!-- Color picker js -->
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/spectrum/js/spectrum.js"></script>
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/jscolor/js/jscolor.js"></script>
    <!-- Mini-color js -->
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/jquery-minicolors/js/jquery.minicolors.min.js"></script>

    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/lightbox2/js/lightbox.min.js"></script>
    <!-- notification js -->
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/assets/js/bootstrap-growl.min.js"></script>
    
    <script src="<?=BASE_URL_SITO?>js/jquery.notify.js"></script>
    <!-- amchart js -->
    <script src="<?=BASE_URL_SITO?>files/assets/pages/widget/amchart/amcharts.js"></script>
    <script src="<?=BASE_URL_SITO?>files/assets/pages/widget/amchart/serial.js"></script>
    <script src="<?=BASE_URL_SITO?>files/assets/pages/widget/amchart/light.js"></script>
    <script src="<?=BASE_URL_SITO?>files/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/assets/js/SmoothScroll.js"></script>
    <script src="<?=BASE_URL_SITO?>files/assets/js/pcoded.min.js"></script>
    <!-- custom js -->
    <script src="<?=BASE_URL_SITO?>files/assets/js/vartical-layout.min.js"></script>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script type="text/javascript" src="<?=BASE_URL_SITO?>files/assets/js/script.js"></script>

    <? include_once(BASE_PATH_ADMIN.'src/template/moduli/switch.js.inc.php'); ?>
   
</body>
</html>