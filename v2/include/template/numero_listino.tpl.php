<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <?=$msg?>
                <?=$SbMsg?>
                <?=$PmsMsg?>
                <?=$SyncroMsg?>
                <?php   echo $xcrud->render('edit',$id);; ?>
                <?php   echo $TipoListino->render(); ?>
                <?php  // echo $listino->render(); ?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?=$legenda?>
<?php include_module('footer.inc.php'); ?>
