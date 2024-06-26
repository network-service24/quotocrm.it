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
                    Abilita l'invio automatico dell'Email info utili al cliente prima della data del Check-in
                    <br><span>&#10230;</span> <small> imposta quanti giorni PRIMA del Check-in deve arrivare l'Email info Utili al cliente</small></h2>
                     <h5><i class="fa fa-exclamation-triangle text-orange"></i> L'e-mail automatica se impostata, partirà ogni giorno alle ore 09:30</h5>
                    <?php   echo $xcrud->render('edit',$id); ?>                
                    <?php   echo $xcrud2->render('edit',$id); ?>
                    <small>ATTENZIONE: se si abilitano più contenuti, quelli presi in considerazione dal software saranno gli ultimi inseriti, ossia quelli più in alto!</small>
                    <?php   echo $xcrud3->render(); ?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?> 