<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<script src="<?=BASE_URL_SITO?>js/jquery.jMaxLength.js"></script>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <h2> Gestione contenuti delle e-mail al cliente
                    <span>&#10230;</span> <small>Inserimento testi per le e-mail rivolte al cliente!</small></h2>
                <?=$xcrud->render();?>
                <?=$xcrud_conferma->render();?>
                <?=$xcrud_chat->render();?>
                <?=$xcrud_vaucher->render();?>
                <?=$xcrud_questionario->render();?>
                <?=$xcrud_checkin->render();?>
                <?=$xcrud_disdetta->render();?>
                <?=$xcrud_disponibilita->render();?>
                <?=$xcrud_annulla->render();?>
                <?=$xcrud_annulla_p->render();?>
                <?=$xcrud2->render();?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->

<?php include_module('footer.inc.php'); ?>