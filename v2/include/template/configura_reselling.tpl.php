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
                Abilita l'invio automatico dell'Email di Benvenuto al cliente dopo la data di Check-in 
                <br><span>&#10230;</span> 
                <small>imposta quanti giorni DOPO il Check-in deve arrivare l'Email di Benvenuto al cliente.</small></h2>  
                    <h5><i class="fa fa-exclamation-triangle text-orange"></i> L'e-mail automatica di Benvenuto, partirà se impostata sulle Prenotazioni Confermate, dopo il controllo per la sua spedizione che avviene ogni giorno alle ore 17:10</h5>
                    <?php   echo $xcrud->render('edit',$id); ?>                
                    <?php   echo $xcrud2->render('edit',$id); ?>
                    <?php   echo $xcrud_reselling->render(); ?>
                     <?php   echo $xcrud_resellingF->render(); ?>
                    <?php   echo $xcrud_resellingB->render(); ?>
                    <?php   echo $xcrud_resellingBen->render(); ?>
                    <?php   echo $xcrud_resellingS->render(); ?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?> 