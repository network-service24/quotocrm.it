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
                    Abilita l'invio automatico per il Recall dell'email di scelta del metodo di pagamento della caparra da parte del cliente
                    <br><span>&#10230;</span> 
                    <small>imposta il numero di giorni prima della data di scadenza impostata nella conferma in trattativa entro i quali dovrà essere inviata la mail di Recall.</small>
                </h2>  
                    <h5><i class="fa fa-exclamation-triangle text-orange"></i> L'e-mail automatica partirà se impostata ogni giorno alle ore 08:30</h5>
                    <?php   echo $xcrud->render('edit',$id); ?>                
                    <?php   echo $xcrud2->render('edit',$id); ?>
                    <?php   echo $xcrud_resend->render(); ?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?> 