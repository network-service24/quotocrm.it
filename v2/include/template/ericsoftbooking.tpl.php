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
                    Dati Account Ericsoft Booking
                    <span>&#10230;</span> <small>configurazione per la sincronizzazione dei dati di Ericsoft Booking</small>
                </h2>
                    <div class="alert alert-profila  alert-default-profila alert-dismissable text-black">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="fa fa-exclamation-triangle text-orange" aria-hidden="true"></i> <b>ATTENZIONE:</b> la sincronizzazione con il PMS di Ericsoft è possibile solo se il cliente ha acquistato il <b>Channel Manager </b>ossia la <b>Suite di Ericsoft</b> (<em>questo il volere di Ericsoft</em>)!</h5>
                    </div>
                <?php echo $xcrud->render(); ?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>