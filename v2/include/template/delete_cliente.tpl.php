<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <h2> Cancella tuti i dati di questi cliente
                    <span>&#10230;</span> <small>delete</small></h2>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-center">
                        <a class="btn btn-danger" href="javascript:validator('<?=BASE_URL_SITO?>setting-delete_cliente/&action=ZGVsZXRlX2lkc2l0bw==')">CANCELLA
                            TOTALMENTE I DATI DI QUESTO CLIENTE</a>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>