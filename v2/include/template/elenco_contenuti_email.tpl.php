<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <h2> Creazione dei Templates email di Preventivo e Conferme prenotazione</h2>
                <a href="<?=BASE_URL_SITO?>contenuti_email/" data-task="create" class="btn btn-success xcrud-action">
                    <i class="glyphicon glyphicon-plus-sign"></i> Aggiungi
                </a>
                <div style="clearfix"></div>
                <?php   //echo $xcrud->render(); ?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>