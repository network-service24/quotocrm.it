<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i>
                    <?=ucfirst((strlen(NOMEUTENTE)>2?NOMEUTENTE:USER))?>
                </h2>
                <p>Se desiderate modificare il logo della vostra struttura e la password di accesso, potete
                    accedere su Suiteweb v2 sotto il vostro profilo, la ragione sociale ed il sito internet
                    associato non è possibile modificarli.</p>
                <div class="row">
                    <div class="col-md-10">
                        <?= $xcrud_suiteweb->render('edit',$_SESSION['utente']['idutente']);?>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>