<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                    <h2>Abilita invio per il Customer Satisfaction, e-mail di Questionario prima/dopo la data di check Out <span>&#10230;</span> <small>Imposta il numero di giorni per il CS</small></h2>
                    <h5><i class="fa fa-exclamation-triangle text-orange"></i> L'e-mail automatica di CsSend invio Questionario sulle Prenotazioni Confermate partirà se impostata ogni giorno alle ore 10:00</h5>
                    <?php   echo $xcrud->render('edit',$id); ?>                
                    <?php   echo $xcrud2->render('edit',$id); ?>
                    <?php   echo $xcrud_reselling->render(); ?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?> 