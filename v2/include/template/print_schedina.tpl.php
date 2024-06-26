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
                    <div class="row">
                        <div class="col-md-10">
                            Stampa Schedina allogiati alla Questura: <span>&#10230;</span> <small>stampa email P.S.</small>
                        </div>
                        <div class="col-md-2 text-right">
                            <?=$pulsante_indietro?>
                        </div>
                    </div>
                </h2>

                <?=$output?>

            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<style type="text/css" media="print">
  @page { size: landscape; }
</style>

<?php include_module('footer.inc.php'); ?>