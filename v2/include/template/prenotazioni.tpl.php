<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<?=$css?>
<?php
####CONTROLLO E SPEDIZIONE DEL VOUCHER TRAMITE WHATSAPP###
if($_REQUEST['azione'] == 'sendVoucherW' && $_REQUEST['param'] != '') {
    
    $db->query("SELECT Cellulare FROM hospitality_guest  WHERE Id = ".$_REQUEST['param']);
    $dati = $db->row();        
    $Cellulare      = $dati['Cellulare'];

    if(strlen($Cellulare)<3 || $Cellulare == ''){
        $prt->alertgo('Il numero di Cellulare non è presente, modificare la conferma e compilare il campo!',BASE_URL_SITO.'conferme/');
        exit;
    }else{
        $prt->opento(BASE_URL_SITO.'send_whatsapp_voucher/send/'.$_REQUEST['param']);
    }
    echo'
        <script>
            $(document).ready(function(){
                setTimeout(function(){ document.location="'.BASE_URL_SITO.'prenotazioni/"; }, 1000);
            });
        </script>'."\r\n";

}
####FINE CONTROLLO E SPEDIZIONE DEL VOUCHER TRAMITE WHATSAPP###
?>
<div class="content-wrapper">
<?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
<?php 
        if(check_ericsoftbooking(IDSITO)!=0){
            echo contoallarovescia(4,'prenotazioni');
        }
    ?> 
    <section class="content">
        <div class="box radius6">
            <div class="box-body">           
                <div id="dialog" title="ATTENZIONE!" style="display:none">
                    <small><small> CLICCA <b>SI</b>:<br>
                            Se desideri <b>disdirre la prenotazione ed inviare la e-mail di avviso</b> al cliente!<br><br>
                            CLICCA <b>NO</b> OPPURE CLICCA SULLA <b>X</b>:<br>
                            Se desideri disdirre la prenotazione <b>MA NON inviare</b> la e-mail di avviso</b> al
                            cliente!<br>
                        </small></small>
                </div>
                <?=$msg?>
                <h2>Prenotazioni: confermate!</h2>
                <?php if(CHECKINONLINE==0){?>
                    <div style="float:right"><a href="javascript:;" id="attiva_legenda6" data-toogle="tooltip" title="Clicca per leggere!" class="h4">Help <i class="fa fa-life-ring text-info"></i></a></div>
                    <div class="clearfix"></div>
                    <div class="alert alert-profila  alert-default-profila alert-dismissable text-black" id="legenda6"  style="display:none">
                        <h5><i class="fa fa-exclamation-triangle text-orange"></i> Se vicino al <b>Cognome</b> appare <i class="fa fa-star text-red"></i>
                            il cliente è già presente in
                            <?=NOME_AMMINISTRAZIONE?>, cioè ha prenotato un soggiorno più di una volta!</h5>
                        <h5><i class="fa fa-exclamation-circle text-red"></i> <b>ATTENZIONE:</b> se una prenotazione viene
                            riaperta per essere modificata, si elimina dalle Prenotazioni confermate e si riposizionerà in <b>"Conferme in
                                trattativa"</b></h5>
                               <!-- <h5><i class="fa fa-exclamation-circle text-info"></i> Per <b>inviare E-Mail di Upselling</b>: filtra le prenotazioni, seleziona i risultati ed esplodi il pulsante <b>"Azioni"</b>, infine clicca su <b>"Componi email di UpSelling"</b></h5>-->
                                <?=$legenda_pms?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?=syncro_preno_parity(IDSITO)?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?=$testo_auto_upselling?>
                                        <?=$testo_auto_precheckin?>
                                    </div>
                                    <div class="col-md-6">
                                        <?=$testo_auto_cs?>
                                        <?=$testo_auto_recensioni?>
                                        <?=$testo_auto_checkin?>
                                    </div>
                                </div>
                                <h5>
                                    <i class="fa fa-exclamation-triangle text-red"></i> 
                                    Se il filtro della <b>ricerca avanzata</b> non dovesse produrre risultati e comunque siete in possesso di una nominativo cliente che ha soggiornato presso la vostra struttura, 
                                    probabilmente <b>fa riferimento ad una prenotazione esterna</b> inserita manualmente dal <b>modulo di check-in online.</b> 
                                    Quindi in questo caso dovreste spostarvi all'interno del modulo di Check-in online per effettuare una ricerca più accurata oppure potete sempre usare la voce "Profila ed Esporta"!<br>
                                    Importante: per tutte le prenotazioni esterne, per le quali QUOTO offre l'opportunità d'inviare il modulo di Check-in Online, le stesse non usufruiscono degli automatismi delle "Prenotazioni Confermate" che sono native di QUOTO (essendo appunto esterne a QUOTO)
                                </h5>
                                <h5>
                                    <i class="fa fa-exclamation-triangle text-red"></i> 
                                    <b>Se è attiva la sincronizzazioni con il PMS di EricSoft:</b>
                                    <ul>
                                        <li>Il Bot di Ericsoft passa circa ogni mezz'ora; il loro codice inserisce le prenotazioni che trova in QUOTO sul PMS.</li>
                                        <li>Se si è modificata la prenotazione con QUOTO e si vuole modificarla di conseguenza anche sul PMS; si  deve cliccare sul pulsante con icona di modifica (che subito dopo scomparirà).</li>
                                        <li>Se si desidera <b>cancellare una prenotazione inserita nel PMS</b> si deve cliccare sul pulsante con icona del cestino (che subito dopo scomparirà).</li>
                                        <li>Il passaggio immediatamente successivo deve essere quello di <b>CESTINARE la prenotazione stessa</b>, cliccando sul pulsante in fondo a destra <b>"Elimina"</b>.</li>
                                        <li>Altrimenti al passaggio dopo quello della cancellazione il Bot di Ericsoft potrebbe ricaricarla nuovamente sul PMS.</li>
                                        <li><b>Se avete 2 o più di tipologie di camera uguali NON UTILIZZATE IL CAMPO NR. DI CAMERE inserendone il numero, ma INSERITE PIU' RIGHE!</b></li>
                                    </ul>
                                </h5>
                    </div>
                    <script>
                           $(document).ready(function(){
                             $("#attiva_legenda6").on("click",function(){
                               $("#legenda6").slideToggle("slow");
                             })
                           })
                    </script> 
                <?}?>
                <!--FORM FILTRI PER ARRIVI-->
                <div class="clearfix"></div>
                <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <?php if(CHECKINONLINE==0){?>
                    <div class="btn-group">
                    <button type="button" class="btn bg-maroon">Azioni</button>
                    <button type="button" class="btn bg-maroon dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a  data-toggle="modal" data-target="#myModalASearch" href="#"><i class="fa fa-search orange" aria-hidden="true"></i> Ricerca avanzata</a></li>
                        <li><a id="archivia_all" href="#"><i class="fa fa-inbox orange" aria-hidden="true"></i> Archivia i selezionati</a></li>
                        <li class="divider"></li>
                        <li><a id="add_all_newsletter" href="#"><img src="<?=BASE_URL_SITO?>img/emessenger.png" class="small_ico_emessenger"> Aggiungi i selezionati ad <?=NOME_CLIENT_EMAIL?></a></li>
                        <!--
                        <li class="divider"></li>
                        <li><a id="send_upselling" href="#"><i class="fa fa-send info" aria-hidden="true"></i> Componi email di UpSelling</a></li>
                        -->
                    </ul>
                    </div>
                <?}?>
                    <? include(INC_PATH_MODULI.'search.inc.php'); ?>
                    <?=$js_ajax?>
                    <?=$js_script_mailing?>
                    <?=$js_script_upselling?>
                
                </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?php if(CHECKINONLINE==0){?>
                        <div id="filtro_arrivi_preno">
                            <div class="inline">
                                Filtra gli <b>Arrivi</b> di
                                <a href="<?=BASE_URL_SITO?>prenotazioni/" class="btn bg-black btn-xs float-right-10" type="button">Reset</a>
                                <form method="post" class="float-right-10" action="<?=$_SERVER['REQUEST_URI']?>">
                                    <input type="hidden" name="ggg" value="dinamica">
                                    <button class="btn <?=($_REQUEST['date_fl']!=''?'btn-primary':'btn-success')?> btn-xs" type="submit" style="float:right!important">Filtra</button>
                                    <input type="text" id="DataFiltro" autocomplete="off"  class="date-picker form-control h-w-input h-w-input-mozilla" name="date_fl" value="<?=($_REQUEST['date_fl']==''?($_REQUEST['date_arr']!=''?$_REQUEST['date_arr']:''):$_REQUEST['date_fl'])?>">
                                    <?=$arrivi?>
                                    <script>
                                        $(document).ready(function() {
                                            $("#DataFiltro").datepicker({
                                                dateFormat: 'dd-mm-yy',
                                                numberOfMonths: 1,
                                                language:"it",
                                                showButtonPanel: true
                                            });
                                        });
                                    </script>
                                </form>
                                <form method="post" class="float-right-10" action="<?=$_SERVER['REQUEST_URI']?>">
                                    <button class="btn <?=($_REQUEST['date_arr']==$data_giorni1_view?'btn-warning':'btn-success')?> btn-xs" type="submit">Domani</button>
                                    <input type="hidden" name="ggg" value="domani">
                                    <input type="hidden" name="date_arr" value="<?=$data_giorni1_view?>">
                                </form>
                                <form method="post" class="float-right-10" action="<?=$_SERVER['REQUEST_URI']?>">
                                    <button class="btn <?=($_REQUEST['date_arr']== date('d-m-Y')?'btn-danger':'btn-success')?> btn-xs" type="submit">Oggi</button>
                                    <input type="hidden" name="ggg" value="oggi"><input type="hidden" name="date_arr" value="<?=date('d-m-Y')?>">
                                </form>
                            </div>
                        </div>
                    <?}?>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><? include(INC_PATH_MODULI.'dimension.inc.php'); ?></div>
                </div>
                <div class="clearfix"></div>
                <!-- FINE -->


                <div id="risultato"></div>
                <div id="risultato_newsletter"></div>
                <div id="risultato_upselling"></div>
                <div class="clearfix lineheight10"></div>
                <?php if(CHECKINONLINE==0){?>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <div id="checkAll" style="cursor:pointer"><small><i class="fa fa-check-square-o"></i> Seleziona tutti</small></div>
                        </div>
                        <?=$js_fatt?>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center" id="totale_fatt"></div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
                    </div>
                <?}?>
                <?php   echo $xcrud->render(); ?>
                <?//if(check_configurazioni(IDSITO,'check_pagination')==1){echo'<div style=\"clear:both\"></div><small>Per eliminare la memoria della pagina scelta nel menù di paginazione, ripassare sempre dalla pagina N° 1</small><div style=\"clear:both\"></div>';echo $js_pagination;}?>
                <?if(check_configurazioni(IDSITO,'check_pagination')==1){echo'<div id="legendaPagination"></div>';echo $js_pagination;}?>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<div id="modale_upselling"></div>
<div id="voucher_recupero"></div>
<?php include_module('footer.inc.php'); ?>
