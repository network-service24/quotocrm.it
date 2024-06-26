<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <h2> Gestione Dizionario del Form dedicato 
                    <span>&#10230;</span> <small>gestione delle traduzioni dei vocabili/etichette del form</small></h2>
                <h5>Le variabili che iniziano per "Response" compilano i campi dell'e-mail in risposta all'invio del form</h5> 
                <h5> Le variabili che iniziano per "Form" compilano i campi del form </h5>
                <?php   echo $xcrud->render(); ?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>