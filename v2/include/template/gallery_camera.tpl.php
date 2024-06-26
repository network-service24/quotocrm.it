<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <h2> Gestione Galleria Immagini per ogni tipologia di Camera
                    <span>&#10230;</span> <small>gestione immagini per camera</small></h2>
                <div class="xcrud-top-actions btn-group">
                    <a href="<?=BASE_URL_SITO?>camere/" data-task="list" class="btn btn-warning xcrud-action">Ritorna a
                        Camere</a>
                </div>
                <?php
                    
                    if($_GET['azione'] == '' && $_GET['param'] == '' ) {
                        echo $xcrud->render();
                    }else{
                        echo $xcrud->render('add',$_GET['param']);
                    }
                    ?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>