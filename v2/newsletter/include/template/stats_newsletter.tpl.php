<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<?=$js_script?>
<div class="content-wrapper">
<?php include(BASE_PATH_SITO.'newsletter/include/template/moduli/breadcrumb.inc.php') ?>
  <section class="content">
    <div class="box radius6">
      <div class="box-body">

        <div class="row">
        <?php include(BASE_PATH_SITO.'newsletter/include/template/moduli/menu.inc.php');?>
            <div class="col-md-10">
            <h2>STATISTICHE <?=NOME_CLIENT_EMAIL?></h2>
              <?=$stat?>
            </div>
        </div>
      </div>
    </div>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php include_module('footer.inc.php'); ?>