<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
<?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
  <section class="content">
    <div class="box radius6">
      <div class="box-body">
        <h2>
          Timeline
          <span>&#10230;</span> <small> linea temporale delle operazioni compiute </small>
        </h2>
        <div class="row">
          <div class="col-md-10">
            <?=$h2?>
          </div>
          <div class="col-md-2" style="padding:20px 40px 0px 0px;text-align:right">
            <a class="btn btn-warning" href="<?=BASE_URL_SITO?>grafici-anagrafiche_clienti/"><i class="fa fa-arrow-left"></i> Torna
              indietro</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-1"></div>
            <div class="col-md-10">
              <?=$timeline?>
            </div>
            <div class="col-md-1"></div>
          </div>
      </div>
    </div>
  </section><!-- /.content -->

</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>