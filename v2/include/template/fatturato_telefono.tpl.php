<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
            <h4>
                Relazione tra tutte le prenotazioni di QUOTO e tabella analytics <small>(<em>Telefono per campagna</em>)</small>!
                <br><br>
                La lista è composta dalle prenotazione e le conferme presenti in QUOTO che hanno la relazione con il numero di telefono dalla tabella analytics!
            </h4>                                                                                        
            <?=$output?>   
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php include_module('footer.inc.php'); ?>