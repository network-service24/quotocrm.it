<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <h2> Gestione Tipologia Pagamenti
                    <span>&#10230;</span> <small>gestione delle tipologie di pagamento</small></h2>
                    <div style="float:right"><a href="javascript:;" id="attiva_legenda" data-toogle="tooltip" title="Clicca per leggere!" class="h4">Help <i class="fa fa-life-ring text-info" aria-hidden="true"></i></a></div>  
                         <div class="clearfix"></div>
                          <div class="alert alert-profila  alert-default-profila alert-dismissable text-black" id="legenda"  style="display:none">
                            <p><i class="fa fa-exclamation-triangle text-orange"></i> La caparra si può impostare e/o modificare
                                anche dentro la richiesta!!</p>
                            <p><i class="fa fa-exclamation-triangle text-red"></i> <b>LEGENDA CAPARRA:</b><br> se all'interno di
                                ogni preventivo e/o conferma, viene inserito come importo caparra, un valore inferiore ad 1 euro
                                (0.1, 0.01), automaticamente per la richiesta stessa si abilita la modalità Carta di Credito a
                                Garanzia. Attenzione: se utilizzate questa opzione ricordatevi di disabilitare le altre modalità di
                                pagamento, perchè non avrebbero più senso di esistere!</p>
                    </div>
                        <script>
                           $(document).ready(function(){
                             $("#attiva_legenda").on("click",function(){
                               $("#legenda").slideToggle("slow");
                             })
                           })
                         </script>
                <?php   echo $xcrud2->render('edit',$id); ?>
                <br>
                <?php echo $carta_credito_alert; ?> 
                <?php echo $legenda;?>
                <?php echo $legendaVP;?>
                <?php echo $xcrud->render(); ?>

            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->

<?php include_module('footer.inc.php'); ?>
