<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
<?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
<?=contoallarovescia(4,'conferme')?> 
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <?=$alert_voucher?>
                <?=$mssg?>        
                <h2>Conferme: invio conferma e modalità di pagamento! </h2>
                <div style="float:right"><a href="javascript:;" id="attiva_legenda5" data-toogle="tooltip" title="Clicca per leggere!" class="h4">Help <i class="fa fa-life-ring text-info"></i></a></div>
                <div class="clearfix"></div>  
                <div class="alert alert-profila  alert-default-profila alert-dismissable text-black" id="legenda5"  style="display:none">
                        <h5><i class="fa fa-exclamation-triangle text-orange"></i> Se vicino al <b>Cognome</b> appare <i class="fa fa-star text-red"></i>
                            il cliente è già presente in
                            <?=NOME_AMMINISTRAZIONE?>, cioè ha confermato più di una richiesta di preventivo!</h5>
                            <?=$txt_resend?>
                    </div>
                    <script>
                           $(document).ready(function(){
                             $("#attiva_legenda5").on("click",function(){
                               $("#legenda5").slideToggle("slow");
                             })
                           })
                         </script> 
                    <div style="clear:both;height:5px"></div> 
                    <div class="btn-group btn-group-100">
                    <? include(INC_PATH_MODULI.'dimension.inc.php'); ?>
                    <button type="button" class="btn bg-maroon">Azioni</button>
                    <button type="button" class="btn bg-maroon dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu"> 
                        <li><a  data-toggle="modal" data-target="#myModalASearch" href="#"><i class="fa fa-search orange" aria-hidden="true"></i> Ricerca avanzata</a></li>
                    </ul>
                </div>
                <? include(INC_PATH_MODULI.'search.inc.php'); ?>
                <div class="clearfix"></div>
                <?php   echo $xcrud->render(); ?>
                <?//if(check_configurazioni(IDSITO,'check_pagination')==1){echo'<div style=\"clear:both\"></div><small>Per eliminare la memoria della pagina scelta nel menù di paginazione, ripassare sempre dalla pagina N° 1</small><div style=\"clear:both\"></div>';echo $js_pagination;}?>
                <?if(check_configurazioni(IDSITO,'check_pagination')==1){echo'<div id="legendaPagination"></div>';echo $js_pagination;}?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php 
    if(check_configurazioni(IDSITO,'check_notifiche_push')==1){
        echo notifica_mancata_click(IDSITO,'Conferma');
        echo $notifiche_js;
    }
?>
<?php include_module('footer.inc.php'); ?>