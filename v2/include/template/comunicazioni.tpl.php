<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
            <div class="alert alert-profila  alert-default-profila alert-dismissable text-black">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="fa fa-question-circle text-blue"></i> In questa sezione trovate il riepilogo di tutte le
                    comunicazione <b>da</b> Network Service <b>a</b> Voi (<em>cliente utilizzatore di QUOTO</em>).
                    Possono essere di carattere informativo, upgrade o update del software e/o a scopo didattico!</h5>
                <h5><i class="fa fa-exclamation-triangle text-red"></i> Le comunicazioni con data di fine pubblicazione
                    in <b>rosso</b> sono scadute!</h5>
                <h5><i class="fa fa-exclamation-circle text-orange" aria-hidden="true"></i> Le comunicazione <b>attive</b>,
                    oltre ad essere presenti nella pagina di riepilogo ed aprirsi automaticamente al momento del login
                    in QUOTO, le trovate (<em>se attive</em>) nella barra verde in alto sulla destra.</h5>
            </div>
            <h3>Riepilogo degli interventi, aggiornamenti e comunicazioni avvenute nel tempo su QUOTO!</h3>
                <?php echo $xcrud_suiteweb->render();?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php include_module('footer.inc.php'); ?>