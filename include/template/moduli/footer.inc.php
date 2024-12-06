        </div>
      </div>
    </div>
  </div>


    <script type="text/javascript">

        if (typeof CKEDITOR !== 'undefined') {
            CKEDITOR.config.filebrowserBrowseUrl = '<?=BASE_URL_SITO?>js/ckfinder/ckfinder.html';
            CKEDITOR.config.filebrowserImageBrowseUrl = '<?=BASE_URL_SITO?>js/ckfinder/ckfinder.html?type=Images';
            CKEDITOR.config.filebrowserFlashBrowseUrl = '<?=BASE_URL_SITO?>js/ckfinder/ckfinder.html?type=Flash';
            CKEDITOR.config.filebrowserUploadUrl = '<?=BASE_URL_SITO?>js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
            CKEDITOR.config.filebrowserImageUploadUrl = '<?=BASE_URL_SITO?>js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
            CKEDITOR.config.filebrowserFlashUploadUrl = '<?=BASE_URL_SITO?>js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
            CKEDITOR.config.allowedContent = true;
            CKEDITOR.replaceAll('editor-instance');
        }
    </script>
    <!-- Bootstrap 4 Autocomplete -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-4-autocomplete/dist/bootstrap-4-autocomplete.min.js" crossorigin="anonymous"></script>
    <!-- modalEffects js nifty modal window effects -->
    <script type="text/javascript" src="<?=CDN_URL_SITO?>files/assets/js/modalEffects.js"></script>
    <script type="text/javascript" src="<?=CDN_URL_SITO?>files/assets/js/classie.js"></script>
    <!-- Accordion js -->
    <script type="text/javascript" src="<?=CDN_URL_SITO?>files/assets/pages/accordion/accordion.js"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="<?=CDN_URL_SITO?>files/bower_components/i18next/js/i18next.min.js"></script>
    <script type="text/javascript" src="<?=CDN_URL_SITO?>files/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="<?=CDN_URL_SITO?>files/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="<?=CDN_URL_SITO?>files/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="<?=CDN_URL_SITO?>files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="<?=CDN_URL_SITO?>files/bower_components/modernizr/js/modernizr.js"></script>
    <script type="text/javascript" src="<?=CDN_URL_SITO?>files/bower_components/modernizr/js/css-scrollbars.js"></script>
    <!-- Select 2 js -->
    <script type="text/javascript" src="<?=CDN_URL_SITO?>files/bower_components/select2/js/select2.full.min.js"></script>
    <!-- list-scroll js -->
    <script src="<?=CDN_URL_SITO?>files/bower_components/stroll/js/stroll.js"></script>
    <script type="text/javascript" src="<?=CDN_URL_SITO?>files/assets/pages/list-scroll/list-custom.js"></script>
    <!-- Switch component js -->
    <script type="text/javascript" src="<?=CDN_URL_SITO?>files/bower_components/switchery/js/switchery.min.js"></script>
    <!-- Date-dropper js -->
    <script type="text/javascript" src="<?=CDN_URL_SITO?>files/bower_components/datedropper/js/datedropper.min.js"></script>
    <!-- Color picker js -->
    <script type="text/javascript" src="<?=CDN_URL_SITO?>files/bower_components/spectrum/js/spectrum.js"></script>
    <script type="text/javascript" src="<?=CDN_URL_SITO?>files/bower_components/jscolor/js/jscolor.js"></script>
    <!-- Mini-color js -->
    <script type="text/javascript" src="<?=CDN_URL_SITO?>files/bower_components/jquery-minicolors/js/jquery.minicolors.min.js"></script>
    <!-- light-box js -->
    <script type="text/javascript" src="<?=CDN_URL_SITO?>files/bower_components/ekko-lightbox/js/ekko-lightbox.js"></script>
    <?php
/*     switch($_SERVER['REQUEST_URI']){
        case !"/grafici-statistiche_new/": */
            echo '<script type="text/javascript" src="'.CDN_URL_SITO.'files/bower_components/lightbox2/js/lightbox.min.js"></script>'."\r\n";
        //break;
   // }
    ?>
    <!-- notification js -->
    <script type="text/javascript" src="<?=CDN_URL_SITO?>files/assets/js/bootstrap-growl.min.js"></script>
    <!-- notify js -->
    <script src="<?=CDN_URL_SITO?>js/jquery.notify.js"></script>
    <!-- amchart js -->
    <script src="<?=CDN_URL_SITO?>files/assets/pages/widget/amchart/amcharts.js"></script>
    <script src="<?=CDN_URL_SITO?>files/assets/pages/widget/amchart/serial.js"></script>
    <script src="<?=CDN_URL_SITO?>files/assets/pages/widget/amchart/light.js"></script>
    <script src="<?=CDN_URL_SITO?>files/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="<?=CDN_URL_SITO?>files/assets/js/SmoothScroll.js"></script>
    <script src="<?=CDN_URL_SITO?>files/assets/js/pcoded.min.js"></script>
    <!-- custom js -->
    <script src="<?=CDN_URL_SITO?>files/assets/js/vartical-layout.min.js"></script>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script type="text/javascript" src="<?=CDN_URL_SITO?>files/assets/js/script.js"></script>

    <? include_module('notifiche.push.inc.php'); ?>
    
    <? echo ckeck_notify_chat_modal(IDSITO);?>

    <!-- CHAT DI SUPPORTO -->
    <script>
      window.fwSettings={
      'widget_id':80000004567
      };
      !function(){if("function"!=typeof window.FreshworksWidget){var n=function(){n.q.push(arguments)};n.q=[],window.FreshworksWidget=n}}()
    </script>
    <script type='text/javascript' src='https://euc-widget.freshworks.com/widgets/80000004567.js' async defer></script>
    <script type='text/javascript'>
      FreshworksWidget('identify', 'ticketForm', {
        name: '<?=NOMEHOTEL?>',
        email: '<?=EMAILHOTEL?>',
      });
    </script>

    <div class="modal fade" id="privacy"  role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <button type="button" class="close text-right m-r-20" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-body">
                  <iframe src="<?=BASE_URL_SITO?>privacy_policy.html" frameborder="no" scrolling="yes" onload="resizeIframe(this)" style="min-height:800px;width:100%"></iframe>
            </div>
        </div>
    </div>
</body>
</html>