<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
    <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
            <h2>Filtra, profila ed esporta i risultati!</h2>
            <div style="float:right"><a href="javascript:;" id="attiva_legenda7" data-toogle="tooltip" title="Clicca per leggere!" class="h4">Help <i class="fa fa-life-ring text-info"></i></a></div>
            <div class="clearfix"></div>   
            <div class="alert alert-profila alert-default-profila alert-dismissable"  id="legenda7"  style="display:none">
                    <i class="fa fa-exclamation-triangle text-orange fa-2x fa-fw"></i>
                         <b>ATTENZIONE:</b><br>
                            Il <b>consenso GDPR</b> viene registrato per ogni conferma
                            <em>(la preferenza viene richiesta durante la visualizzazione del preventivo inviato all'utente, egli agendo sui pulsanti per scegliere e salvare il soggiorno, trasforma il preventivo in conferma e fornisce i vari consensi)!</em>
                             <br>I consensi della GDPR sono quindi disponibili solo per la conferma!
                             Cliccando sull'icona <i class="fa fa-times-circle text-red"></i> oppure  <i class="fa fa-check-circle text-green"></i> si può cambiare la scelta effettuata dall'utente sul consenso a ricevere materiale marketing! <br>
                             Sempre e solo per le conferme, potete cliccare sull'icona  <i class="fa fa-envelope text-light-blue"></i> per inviare un'email all'utente che lo invita ad aprire una pagina a lui dedicata dove poter esercitare i propri diritti in base al consenso GDPR.<br>
                            <b>Esercitando voi stessi questa azione ve ne accollate la piena responsabilità, liberando Network Service da ogni onere ed obbligo.</b><br>
                            QUOTO non è un ambiente per l'invio di Email Marketign, quindi se modificate i consensi utente, ricordatevi di aggiornare anche le liste del software che utilizzate per l'invio di Newsletter.
                </div>
                <div style="clear:both;height:5px"></div>
                 <script>
                           $(document).ready(function(){
                             $("#attiva_legenda7").on("click",function(){
                               $("#legenda7").slideToggle("slow");
                             })
                           })
                </script> 
                 <div class="row">
                    <div class="col-md-6">
                        <h4>Controlla la data dell'ultima esportazione per confrontarla con le precedenti!</h4>
                    </div>
                    <div class="col-md-2">
                        <h4><i class="fa fa-arrows-h" aria-hidden="true"></i></h4>
                    </div>
                    <div class="col-md-4">
                         <div id="id_ora_export" class="text-right text-success"><?=$data_export?></div>
                    </div>
                 </div>
                    <div class="btn-group btn-group-100">
                        <button type="button" class="btn bg-maroon">Azioni</button>
                        <button type="button" class="btn bg-maroon dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a data-toggle="modal" data-target="#myModalASearch" href="#"><i class="fa fa-search orange" aria-hidden="true"></i> Ricerca Avanzata</a></li>
                            <li>
                            <form style="padding: 3px 20px !important;" id="form_export" name="form_export" action="<?=BASE_URL_SITO?>include/controller/export_clienti_quoto.php">
                                <input type="hidden" name="action" value="export">
                                <input type="hidden" name="idsito" value="<?=IDSITO?>">
                                <input type="hidden" name="Lingua" value="<?=$_REQUEST['Lingua']?>">
                                <input type="hidden" name="TipoRichiesta" value="<?=$_REQUEST['TipoRichiesta']?>">
                                <input type="hidden" name="FontePrenotazione" value="<?=$_REQUEST['FontePrenotazione']?>">
                                <input type="hidden" name="TipoVacanza" value="<?=$_REQUEST['TipoVacanza']?>">
                                <input type="hidden" name="Nome" value="<?=$_REQUEST['Nome']?>">
                                <input type="hidden" name="Cognome" value="<?=$_REQUEST['Cognome']?>">
                                <input type="hidden" name="DataArrivo" value="<?=$_REQUEST['DataArrivo']?>">
                                <input type="hidden" name="DataPartenza" value="<?=$_REQUEST['DataPartenza']?>">
                                <input type="hidden" name="DataPrenotazione_dal" value="<?=$_REQUEST['DataPrenotazione_dal']?>">
                                <input type="hidden" name="DataPrenotazione_al" value="<?=$_REQUEST['DataPrenotazione_al']?>">
                                <input type="hidden" name="DataRichiesta_dal" value="<?=$_REQUEST['DataRichiesta_dal']?>">
                                <input type="hidden" name="DataRichiesta_al" value="<?=$_REQUEST['DataRichiesta_al']?>">
                                <input type="hidden" name="Arrivo_dal" value="<?=$_REQUEST['Arrivo_dal']?>">
                                <input type="hidden" name="Arrivo_al" value="<?=$_REQUEST['Arrivo_al']?>">
                                <input type="hidden" name="CS_inviato" value="<?=$_REQUEST['CS_inviato']?>">
                                <input type="hidden" name="Chiuso" value="<?=$_REQUEST['Chiuso']?>">
                                <input type="hidden" name="Disdetta" value="<?=$_REQUEST['Disdetta']?>">
                                <input type="hidden" name="CheckConsensoPrivacy" value="<?=$_REQUEST['CheckConsensoPrivacy']?>">
                                <input type="hidden" name="CheckConsensoMarketing" value="<?=$_REQUEST['CheckConsensoMarketing']?>">
                                <input type="hidden" name="TipoCamere" value="<?=$_REQUEST['TipoCamere']?>">
                                <input type="hidden" name="TipoSoggiorno" value="<?=$_REQUEST['TipoSoggiorno']?>">
                                <input type="hidden" name="IdMotivazione" value="<?=$_REQUEST['IdMotivazione']?>">
                                <input type="hidden" name="NoDisponibilita" value="<?=$_REQUEST['NoDisponibilita']?>">
                                <a href="#" onclick="document.getElementById('form_export').submit();" id="pulsante_esporta"><i class="fa fa-file-excel-o black"></i> <span style="margin-left: 10px!important;color:#363636 !important;">Esporta CSV</span></a>
                            </form>
                            </li>
                        </ul>
                    </div>
                    <?=$form_ricerca?>
                    <?=$js_script_data_export?>
                    <div class="clearfix"></div>
                    <?php   echo $xcrud->render(); ?>
                </div>
            </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->

<?php include_module('footer.inc.php'); ?>
