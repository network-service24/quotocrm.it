<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
  <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
  <section class="content">
    <div class="box radius6">
      <div class="box-body">
        <?if($_REQUEST['action']=='eG1sX3NpdG8='){?>
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-2"><a href="<?=BASE_URL_SITO.'uploads/'.IDSITO.'/rate.xml'?>" target="_blank">XML
              Soggiorni</a></div>
          <div class="col-md-2"><a href="<?=BASE_URL_SITO.'uploads/'.IDSITO.'/camere.xml'?>" target="_blank">XML Camere</a></div>
          <div class="col-md-2"><a href="<?=BASE_URL_SITO.'uploads/'.IDSITO.'/avail.xml'?>" target="_blank">XML Query</a></div>
          <div class="col-md-3"></div>
        </div>
        <?}else{?>
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">Non è stata passata la variabile cryptata</div>
          <div class="col-md-3"></div>
        </div>
        <?}?>
      </div>
    </div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php include_module('footer.inc.php'); ?>