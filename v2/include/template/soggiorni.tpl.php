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
                    Gestione Tipologia Soggiorni
                    <span>&#10230;</span> <small>gestione delle tipologie di soggiorno</small>
                </h2>
                <div style="float:right"><a href="javascript:;" id="attiva_legenda" data-toogle="tooltip" title="Clicca per leggere!" class="h4">Help <i class="fa fa-life-ring text-info" aria-hidden="true"></i></a></div>  
                    <div class="clearfix"></div>
                        <div class="alert alert-profila  alert-default-profila alert-dismissable text-black" id="legenda"  style="display:none">
                            <?=$msg?>
                            <?=$FormMsg?>
                            <? if(check_ericsoftbooking(IDSITO) == 1){?>
                                <h4 class="text-right"><a href="<?=BASE_URL_SITO?>update_syncro_eb/sg/" class="btn bg-light-blue btn-xs" id="resynchBtn">Re-Synch</a><br><small>Sincronizza/Ri-sincronizza i tipi di soggiorno se hai aggiunto una o più tipologie nuove su Ericsoft Booking!</small></h4>
                            <?}?>
                            <? if(check_bedzzlebooking(IDSITO) == 1){?>
                                <h4 class="text-right"><a href="<?=BASE_URL_SITO?>update_syncro_bedzzle/sg/" class="btn btn-danger btn-xs" id="resynchBtn">Re-Synch</a><br><small>Sincronizza/Ri-sincronizza i tipi di soggiorno se hai aggiunto una o più tipologie nuove su Bedzzle Booking/PMS!</small></h4>
                            <?}?>
                            <? if(check_simplebooking(IDSITO) == 1){?>
                                <h4 class="text-right"><a href="<?=BASE_URL_SITO?>update_syncro_sb/sg/" class="btn bg-purple btn-xs" id="resynchBtn">Re-Synch</a><br><small>Ri-sincronizza i tipi di soggiorno se hai aggiunto una o più tipologie nuove su SimpleBooking!</small></h4>
                                <?php   if(IS_NETWORK_SERVICE_USER==1){
                                            echo'<h4 class="text-right"><i class="fa fa-exclamation-triangle text-orange"></i> <small>Solo l\'operatore Network Service vede il pulsante per eliminare le tipologie di soggiorno sincronizzate, se dovesse essere neccessario re-sincronizzare da SimpleBooking:<br>per esempio se i nomi delle tipologie sono stati modificati, disabilitare i soggiorni interessati, re-sincronizzare e successivamente eliminare i soggiorni vecchi!</small></h4>';
                                        }
                                ?>
                            <?}?>
                            <?=$SyncroMsg?>
                    </div>     
                    <script>
                           $(document).ready(function(){
                             $("#attiva_legenda").on("click",function(){
                               $("#legenda").slideToggle("slow");
                             })
                           })
                         </script>     
                <?php   echo $xcrud->render(); ?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>
