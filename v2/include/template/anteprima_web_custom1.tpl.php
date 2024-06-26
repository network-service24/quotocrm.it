<?php include_module('header.inc.php') ?>
<?php include(BASE_PATH_SITO . "smart/include/inc_libraries.php"); ?>
<?php
echo '<style>';
include(BASE_PATH_SITO . "smart/css/style.php");
echo '</style>';
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCEhD0s4UEJdItPacNMZNLE_aoyLYGAHL8"></script>
<?=$init_map?>
<?=$css_script?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<div class="content-wrapper">
<?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
<section class="content">
 <? if($tot > 0){?> 
          <!-- general form elements -->
          <div class="box radius6 smart">
            <div class="box-body">
                <div class="col-md-2 text-right">
                          <?=$PulsanteIndietro?>
                </div>
                <div class="col-md-12 text-center" style="font-size:22px!important;border-bottom:0px!important;color:#FFFFFF!important">                            
                    <i class="fa fa-windows"></i> Anteprima Landing page <b><?=ucwords(get_name_template(IDSITO,'custom1'))?></b> di Preventivo e/o Conferma  <small style="font-size:50%">(FAC SIMILE, NON IMPUTABILE)</small>
                    <?  
                      if($_REQUEST['azione']==''){
                        echo'<br><psn class="t14"><i class="fa fa-exclamation-triangle text-orange"></i> L\'anteprima landing viene compilata sempre con i dati di riferimento del primo preventivo in ordine decrescente! Quindi i contenuti dinamici (testo dedicato e photogallery) potrebbero non rispettare il target</span>';
                      }
                    ?>                          
                </div>
                <div id="start"></div>
                <?php include(BASE_PATH_SITO . "smart/include/inc_CHAT.php"); ?>
                <?php if($TipoRichiesta == 'Conferma'){?>
                  <?php include(BASE_PATH_SITO . "smart/include/inc_PAGAMENTO.php"); ?>
                <?}?>
                <?php include(BASE_PATH_SITO . "smart/include/inc_PROPOSTE.php"); ?>
                <?php if($TipoRichiesta == 'Preventivo'){?>
                  <?php include(BASE_PATH_SITO . "smart/include/inc_PRENOTA.php"); ?>
                <?}?>
                <?php include(BASE_PATH_SITO . "smart/include/inc_INFOHOTEL.php"); ?>
                <?php if($abilita_mappa == 1){?>
                  <?php include(BASE_PATH_SITO . "smart/include/inc_DOVESIAMO.php"); ?>
                <?}?>
                <?php include(BASE_PATH_SITO . "smart/include/inc_EVENTI.php"); ?>
                <?php include(BASE_PATH_SITO . "smart/include/inc_PUNTI.php"); ?>
                <?php include(BASE_PATH_SITO . "smart/include/inc_PHOTOGALLERY.php"); ?>
                <?php include(BASE_PATH_SITO . "smart/include/inc_CONDIZIONI.php"); ?>
                <?php include(BASE_PATH_SITO . "smart/include/inc_FOOTER.php"); ?>
                <script src="<?=BASE_URL_SITO?>smart/js/main.js"></script>
                <script src="<?=BASE_URL_SITO?>js/responsiveslides.min.js"></script>
            </div>
        </div>
    <?}else{?>
      Per visualizzare un'anteprima della Landing page inserire almeno una richiesta!
    <?}?>        
    </section> 
    </div>

<?php include_module('footer.inc.php'); ?>