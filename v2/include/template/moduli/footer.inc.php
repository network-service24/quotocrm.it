      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <?php
              $execution_time = getExecutionTime();
              echo '<small style="padding-right:30px">Il codice di questa pagina è stato generato in: ' . number_format($execution_time,5,',','.').' secondi</small>';
          ?>
          <b>Version</b> <span data-toogle="tooltip" title="<?=EXPLANE_VERSIONE?>"><?=VERSIONE?></span>
        </div>
        <strong>Copyright <span id="licenza">&copy;</span> <?=date('Y')?> <a href="https://www.network-service.it">Network Service s.r.l.</a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->
    <!-- Bootstrap 3.3.5 -->
    <script src="<?=BASE_URL_SITO?>bootstrap/js/bootstrap.min.js"></script>

    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?=BASE_URL_SITO?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <?php
    echo"<script type=\"text/javascript\">
              CKEDITOR.config.filebrowserBrowseUrl = '".BASE_URL_ROOT."js/ckfinder/ckfinder.html';
              CKEDITOR.config.filebrowserImageBrowseUrl = '".BASE_URL_ROOT."js/ckfinder/ckfinder.html?type=Images';
              CKEDITOR.config.filebrowserFlashBrowseUrl = '".BASE_URL_ROOT."js/ckfinder/ckfinder.html?type=Flash';
              CKEDITOR.config.filebrowserUploadUrl = '".BASE_URL_ROOT."js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
              CKEDITOR.config.filebrowserImageUploadUrl = '".BASE_URL_ROOT."js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
              CKEDITOR.config.filebrowserFlashUploadUrl = '".BASE_URL_ROOT."js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
              CKEDITOR.config.allowedContent = true;
              CKEDITOR.replaceAll('editor-instance');
        </script>"."\r\n";
    ?>

    <script src="<?=BASE_URL_SITO?>js/jquery.notify.js"></script>

    <script src="<?=BASE_URL_SITO?>plugins/image-picker/image-picker.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?=BASE_URL_SITO?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- InputMask -->
    <script src="<?=BASE_URL_SITO?>plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="<?=BASE_URL_SITO?>plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="<?=BASE_URL_SITO?>plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
    <!-- FastClick -->
    <!-- <script src="<?=BASE_URL_SITO?>plugins/fastclick/fastclick.min.js"></script> -->
    <!-- AdminLTE App -->
    <script src="<?=BASE_URL_SITO?>dist/js/app.min.js"></script>
    <!-- Sparkline -->
    <script src="<?=BASE_URL_SITO?>plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?=BASE_URL_SITO?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?=BASE_URL_SITO?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <script src="<?=BASE_URL_SITO?>material/assets/plugins/toast-master/js/jquery.toast.js"></script>

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

  </body>
</html>
