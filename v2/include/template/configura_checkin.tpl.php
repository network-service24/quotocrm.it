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
                Abilita l'invio automatico del Modulo Check-in online, al cliente prima della data del Check-in 
                <br><span>&#10230;</span> <small>imposta quanti giorni PRIMA del Check-in deve arrivare il Modulo Check-in al cliente.</small>
                </h2>
                <h5><i class="fa fa-exclamation-triangle text-orange"></i> L'e-mail automaticapartirà se impostata ogni giorno alle ore 09:40</h5>
                <?php   echo $xcrud->render('edit',$id); ?>
                <?php   echo $xcrud2->render('edit',$id); ?>
                <?php   echo $xcrud_reselling->render(); ?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>