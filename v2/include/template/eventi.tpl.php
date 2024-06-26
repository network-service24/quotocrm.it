<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <h2> Gestione Eventi</h2>
                <h5><i class="fa fa-exclamation-triangle text-orange"></i> Gli Eventi si vedranno nella landing page se
                    la <b>data di inizio evento</b> sarà <b>maggiore o uguale</b> alla <b>data di arrivo</b> della
                    richiesta presente in
                    <?=NOME_AMMINISTRAZIONE?>!</h5>
                <h5><i class="fa fa-exclamation-circle text-red"></i> Gli Eventi si vedranno nella landing page in
                    ordine ascendente in base alla data di inizio dell'evento!</h5>
                <?php   echo $xcrud->render(); ?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>