<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<script type="text/javascript" src="<?=BASE_URL_SITO?>html2canvas/js/html2canvas.js"></script>
<script type="text/javascript" src="<?=BASE_URL_SITO?>html2canvas/js/jquery.plugin.html2canvas.js"></script>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
              <div class="row">
                <div class="col-md-2"></div>
                  <div class="col-md-8 text-center">
                      <?='<img src="'.BASE_URL_SITO.'upload/'.IDSITO.'/img_graph_'.$Id.'.jpeg" />'?>  
                  </div>
                <div class="col-md-2"></div>
              </div>
            </div>
        </div>
  </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>
