<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<?php 
    if(date('Y-m-d') > DATA_QUOTO_V2){ 
        include(BASE_PATH_SITO.'js/add_room.inc.js.php');
        include(BASE_PATH_SITO.'include/controller/modello_crea_proposta_v2.php');
    }else{
        include(BASE_PATH_SITO.'include/controller/modello_crea_proposta_v1.php'); 
    }
 ?>
<div class="content-wrapper">
<?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
    <section class="content">
        <div class="box radius6">
            <div class="box-body">
                <h2 class="page-header linea_green" id="DatiRichiesta">
                    <i class="fa fa-book text-green"></i> Dati Richiesta
                </h2>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <!-- left column -->
                        <div class="form-group">
                            <label for="Lingua">Lingua</label>
                            <form role="form" name="f" method="POST" action="<?=$_SERVER['REQUEST_URI']?>">
                                <select id="lingua" name="Lingua" class="form-control" tabindex="1" onchange="document.f.submit()">
                                    <?=$ListaLingua?>
                                </select>
                            </form>
                        </div>
                    </div><!-- colonna left -->
                    <div class="col-md-6"></div>
                </div><!-- chiusura row -->
                <!-- form start -->
                <form id="ctrl_form" role="form" method="post" action="<?=$_SERVER['REQUEST_URI']?>">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <!-- left column -->
                            <div class="form-group">
                                <label for="NumeroPrenotazione">Numero Prenotazione</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                    <input type="text" name="NumeroPrenotazione" placeholder="Inserire solo numeri e non caratteri"
                                        class="form-control" value="<?=$numero_prenotazione?>" tabindex="1" readonly>
                                </div>
                            </div>
                        </div><!-- colonna left -->
                        <div class="col-md-5">
                            <!-- left column -->
                            <div class="form-group">
                                <label for="TipoRichiesta">Tipologia della richiesta</label>
                                <select id="TipoRichiesta" name="TipoRichiesta" onchange="ctrl();" class="form-control"
                                    tabindex="2">
                                    <option value="Preventivo" selected="selected">Preventivo</option>
                                    <option value="Conferma">Conferma</option>
                                </select>
                            </div>
                        </div><!-- colonna left -->
                        <div class="col-md-1"></div>
                    </div><!-- chiusura row -->
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <!-- left column -->
                            <div class="form-group">
                                <label for="ChiPrenota">Operatore</label>
                                <select id="ChiPrenota" name="ChiPrenota" class="form-control" tabindex="3">
                                    <?php echo $NomiOperatori ?>
                                </select>

                            </div>

                        </div><!-- colonna left -->
                        <div class="col-md-5">
                            <!-- right column -->
                            <div class="form-group">
                                <label for="EmailSegretaria">Email Operatore</label>
                                <select id="EmailSegretaria" name="EmailSegretaria" class="form-control" tabindex="4">
                                    <option value="0">Attendere...</option>
                                </select>
                            </div>
                        </div><!-- colonna right -->
                        <div class="col-md-1"></div>
                    </div><!-- chiusura row -->
                    <br>
                    <h2 class="page-header linea_red" id="DatiCliente">
                        <i class="fa fa-user text-red"></i> Dati Cliente
                    </h2>
                    <div id="anagContainer">
                        <?if(date('Y-m-d') > DATA_QUOTO_V2){ ?>        
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                <label for="Nome">Cerca</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                                <div id="the-basics-nomi">
                                                    <input class="form-control" type="text" id="Anagrafica" name="Anagrafica" placeholder="Cerca per nome e/o per cognome"/>
                                                </div>
                                            </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <br>
                        <?}?>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <!-- left column -->
                                <label for="Nome">Nome</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input class="form-control" type="text" id="Nome" name="Nome" placeholder="Nome" tabindex="5" />
                                </div>
                            </div><!-- colonna left -->
                            <div class="col-md-5">
                                <!-- right column -->
                                <label for="Cognome">Cognome</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" id="Cognome" name="Cognome" placeholder="Cognome" class="form-control"
                                        tabindex="6">
                                </div>
                            </div><!-- colonna right -->
                            <div class="col-md-1"></div>
                        </div><!-- chiusura row -->
                        <br>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <!-- left column -->
                                <label for="Email">Email</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="email" id="Email" name="Email" placeholder="Email" class="form-control"
                                        tabindex="7">
                                </div>
                                <span id="check_email"></span>
                                <?
                                    if(check_configurazioni(IDSITO,'check_verify_email')== 1){
                                        echo $js_Check_email;
                                    }
                                ?>
                            </div><!-- colonna left -->
                            <div class="col-md-5">
                                <!-- right column -->
                                
                                <div class="col-md-4">
                                <label for="Cellulare">Pre <small>(int)</small></label>
                                    <select id="PrefissoInternazionale" name="PrefissoInternazionale" class="form-control"  required>
                                        <?=$ListaPrefissi?>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                <label for="Cellulare">Cellulare <i class="fa fa-question-circle text-info" data-toggle="tooltip" title="" aria-hidden="true" data-original-title="Per inviare messaggi da WhatsApp è necessario l'utilizzo di WhatsApp Business, altrimenti bisogna inserire il numero del cliente nella rubrica"></i></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input type="text" id="Cellulare" name="Cellulare" placeholder="Esempio formato: 333 3333333 oppure 3333333333 oppure 333.3333333" class="form-control"
                                            tabindex="8">
                                    </div>
                                </div>
                            </div><!-- colonna right -->
                            <div class="col-md-1"></div>
                        </div><!-- chiusura row -->
                    </div> <!-- chiusura anagContainer -->

                    <br>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <!-- left column -->
                            <div class="form-group">
                                <label for="TipoRichiesta">Target Cliente</label>
                                <select id="TipoVacanza" name="TipoVacanza" class="form-control" tabindex="9" required title=" ">
                                    <?=$Target?>
                                </select>
                            </div>
                        </div><!-- colonna left -->
                        <div class="col-md-6"></div>
                    </div><!-- chiusura row -->
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10 col-md-offset-2">
                            <div class="form-group">
                                <label for="id_politiche">Template Landing Page <i class="fa fa-question-circle text-info"
                                        data-toggle="tooltip" title="Scegliere il template per la landing page!"></i></label>
                                <select name="id_template" id="id_template" class="form-control image-picker show-labels" tabindex="46"
                                    required>
                                    <?=$ListaTemplate?>
                                </select>
                                <?=$js_target_template?>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <br>
                    <h2 class="page-header linea_orange">
                        <i class="fa fa-calendar text-orange"></i> Dati Prenotazione
                    </h2>
                    <div id="notti" style="width:100%;text-align:center"></div>
                    <br>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <!-- left column -->
                            <div class="control-group">
                                <label for="DataArrivo" class="control-label">Data <?=(date('Y-m-d') > DATA_QUOTO_V2?' principale di Arrivo':'Arrivo') ?></label>
                                <div class="controls">
                                    <div class="input-group">
                                        <label for="DataArrivo" class="input-group-addon btn">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </label>
                                        <input id="DataArrivo" name="DataArrivo" type="text" class="date-picker form-control"
                                            tabindex="10" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                        </div><!-- colonna left -->
                        <div class="col-md-5">
                            <!-- right column -->
                            <div class="control-group">
                                <label for="DataPartenza" class="control-label">Data <?=(date('Y-m-d') > DATA_QUOTO_V2?' principale di Partenza':'Partenza') ?></label>
                                <div class="controls">
                                    <div class="input-group">
                                        <label for="DataPartenza" class="input-group-addon btn">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </label>
                                        <input id="DataPartenza" name="DataPartenza" type="text" class="date-picker form-control"
                                            tabindex="11" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                        </div><!-- colonna right -->
                        <div class="col-md-1"></div>
                    </div><!-- chiusura row -->
                    <br>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <!-- left column -->
                            <div class="form-group">
                                <label for="NumeroAdulti">Numero <?=(date('Y-m-d') > DATA_QUOTO_V2?' totale Adulti':'Adulti') ?></label>
                                <select id="NumeroAdulti" name="NumeroAdulti" class="form-control" tabindex="12"
                                    required>
                                    <option value="" selected="selected">--</option>
                                    <?=$Numeri?>
                                </select>
                            </div>
                        </div><!-- colonna left -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="NumeroBambini">Numero <?=(date('Y-m-d') > DATA_QUOTO_V2?' totale Bambini':'Bambini') ?></label>
                                <select name="NumeroBambini" id="NumeroBambini" class="form-control" tabindex="13">
                                    <option value="" selected="selected">--</option>
                                    <?=$NumeriBimbi?>
                                </select>
                            </div>
                        </div>
                    <? if(date('Y-m-d') < DATA_QUOTO_V2){ ?>
                        <div class="col-md-5">
                            <!-- right column -->
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group" id="EtaBambini1" style="display:none">
                                        <label for="etaBambini">Età 1°</label>
                                        <select id="EtaB1" name="EtaBambini1" class="form-control" tabindex="14">
                                            <option value="" selected="selected">--</option>
                                            <?=$etaBimbi?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" id="EtaBambini2" style="display:none">
                                        <label for="etaBambini">Età 2°</label>
                                        <select id="EtaB2" name="EtaBambini2" class="form-control" tabindex="15">
                                            <option value="" selected="selected">--</option>
                                            <?=$etaBimbi?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" id="EtaBambini3" style="display:none">
                                        <label for="etaBambini">Età 3°</label>
                                        <select id="EtaB3" name="EtaBambini3" class="form-control" tabindex="16">
                                            <option value="" selected="selected">--</option>
                                            <?=$etaBimbi?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" id="EtaBambini4" style="display:none">
                                        <label for="etaBambini">Età 4°</label>
                                        <select id="EtaB4" name="EtaBambini4" class="form-control" tabindex="17">
                                            <option value="" selected="selected">--</option>
                                            <?=$etaBimbi?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" id="EtaBambini5" style="display:none">
                                        <label for="etaBambini">Età 5°</label>
                                        <select id="EtaB5" name="EtaBambini5" class="form-control" tabindex="17">
                                            <option value="" selected="selected">--</option>
                                            <?=$etaBimbi?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" id="EtaBambini6" style="display:none">
                                        <label for="etaBambini">Età 6°</label>
                                        <select id="EtaB6" name="EtaBambini6" class="form-control" tabindex="17">
                                            <option value="" selected="selected">--</option>
                                            <?=$etaBimbi?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div><!-- colonna right -->
                    <?}?>

                        <div class="col-md-1"></div>
                    </div><!-- chiusura row -->
                    <h2 class="page-header linea_green">
                        <i class="fa fa-bed text-green"></i> Proposte Soggiorno
                    </h2>
                    <div class="row">
                        <div class="col-md-12">
                            <?
                                if(check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0 && check_bedzzlebooking(IDSITO)==0){
                                        echo $BookingOnline;
                                }
                            ?>
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="box-group" id="accordion">
                                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                        <div class="panel box box-success">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a class="collapsed" aria-expanded="false" data-toggle="collapse"
                                                        data-parent="#accordion" href="#collapseOne">
                                                        <span class="text-black">1° PROPOSTA </span>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div aria-expanded="true" id="collapseOne" class="panel-collapse collapse in">
                                                <div class="box-body">
                                                    <?if(check_simplebooking(IDSITO)==1){?>
                                                        <div class="row">
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-10 text-center">                                
                                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#input_booking1">Apri <img src="<?=BASE_URL_SITO?>img/powered-sb-bc.png"></button>                                                         
                                                                <div id="wait1"></div>
                                                            </div>
                                                            <div class="col-md-1"></div>
                                                        </div>
                                                    <?}?>
                                                    <?if(check_ericsoftbooking(IDSITO)==1){?>
                                                        <div class="row">
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-10 text-center">                                
                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#input_ericsoft_booking1">Apri <img src="<?=BASE_URL_SITO?>img/powered-ericsoftb-bc.png"  style="text-align:absmiddle;width:auto;height:15px"></button>                                                         
                                                                <div id="wait1E"></div>
                                                            </div>
                                                            <div class="col-md-1"></div>
                                                        </div>
                                                    <?}?>  
                                                    <?if(check_bedzzlebooking(IDSITO)==1){?>
                                                        <div class="row">
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-10 text-center">                                
                                                                <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#input_bedzzle_booking1">Apri <img src="<?=BASE_URL_SITO?>img/powered-bedzzleb-bc.png"  style="text-align:absmiddle;width:auto;height:20px"></button>                                                         
                                                                <div id="wait1Bedzzle"></div>
                                                            </div>
                                                            <div class="col-md-1"></div>
                                                        </div>
                                                    <?}?>                                            
                                                    <div class="row">
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-10">
                                                            <table class="table table-responsive">
                                                                <tr>
                                                                    <td colspan="6">
                                                                        <input type="hidden" name="id_proposta" value="1">
                                                                        <div class="Check1bis"><label for="CheckProposta">1°
                                                                                Proposta</label></div>
                                                                        <div class="Check1" style="display:none">
                                                                          <label for="CheckProposta"> Seleziona
                                                                                Proposta</label>
                                                                            <div class="form-group">
                                                                                <input type="checkbox" value="1" name="CheckProposta1"
                                                                                    id="CheckProposta_1">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <? if(date('Y-m-d') > DATA_QUOTO_V2){ ?>
                                                                <tr>
                                                                    <td class="no-border-top 100-percento">
                                                                        <div class="control-group">
                                                                            <label class="control-label">Data Arrivo Alternativa</label>
                                                                            <div class="controls">
                                                                                <div class="input-group">
                                                                                    <label class="input-group-addon btn">
                                                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                                                    </label>
                                                                                    <input id="DataArrivo_1" name="DataArrivo1" type="text" class="date-picker form-control"
                                                                                        tabindex="10" autocomplete="off" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="no-border-top 100-percento">
                                                                        <div class="control-group">
                                                                            <label for="DataPartenza" class="control-label">Data Partenza Alternativa</label>
                                                                            <div class="controls">
                                                                                <div class="input-group">
                                                                                    <label for="DataPartenza" class="input-group-addon btn">
                                                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                                                    </label>
                                                                                    <input id="DataPartenza_1" name="DataPartenza1" type="text" class="date-picker form-control"
                                                                                        tabindex="11" autocomplete="off" />
                                                                                </div>
                                                                            </div>
                                                                        </div>                   
                                                                    </td>
                                                                </tr>
                                                            <?}?>
                                                                <tr>
                                                                    <td colspan="6">
                                                                        <div class="form-group">
                                                                            <label for="NomeProposta">Nome Proposta o
                                                                                del Pacchetto <small style="font-weight: normal!important">(non
                                                                                    obbligatorio)</small></label>
                                                                            <select id="NomeProposta_1" name="NomeProposta1"
                                                                                class="form-control" tabindex="18">
                                                                                <?php echo $ListaPacchetti ?>
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="6">
                                                                        <div class="form-group">
                                                                            <label for="TestoProposta">Descrizione
                                                                                Proposta o del Pacchetto</label>
                                                                            <textarea rows="3" name="TestoProposta1" id="TestoProposta_1"
                                                                                class="form-control" placeholder="Non è obbligatoria la compilazione di questo campo, offre qualche informazione in più per la proposta"
                                                                                tabindex="19"></textarea>

                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <?
                                                                    if(check_simplebooking(IDSITO)==1){
                                                                        
                                                                        echo '<script>$("#RigaSimpleB1").show();</script>';
                                                                    }else{
                                                                        echo '<script>$("#RigaSimpleB1").hide();</script>';
                                                                    }
                                                                ?>
                                                                <tr id="RigaSimpleB1">
                                                                    <td colspan="6" class="no-border-top">
                                                                        <div id="simple1"></div>
                                                                    </td>
                                                                </tr>
                                                                <?
                                                                    if(check_ericsoftbooking(IDSITO)==1){
                                                                        
                                                                        echo '<script>$("#RigaEricsoftB1").show();</script>';
                                                                    }else{
                                                                        echo '<script>$("#RigaEricsoftB1").hide();</script>';
                                                                    }
                                                                ?>
                                                                <tr id="RigaEricsoftB1">
                                                                    <td colspan="6" class="no-border-top">
                                                                        <div id="simple1E"></div>
                                                                    </td>
                                                                </tr>                                                            
                                                                <?
                                                                    if(check_bedzzlebooking(IDSITO)==1){
                                                                        
                                                                        echo '<script>$("#RigaBedzzleB1").show();</script>';
                                                                    }else{
                                                                        echo '<script>$("#RigaBedzzleB1").hide();</script>';
                                                                    }
                                                                ?>
                                                                <tr id="RigaBedzzleB1">
                                                                    <td colspan="6" class="no-border-top">
                                                                        <div id="simple1Bedzzle"></div>
                                                                    </td>
                                                                </tr>                                                               
                                                                <? 
                                                                    if(date('Y-m-d') > DATA_QUOTO_V2){ 
                                                                        echo $riga_camere_proposta_v2_1;
                                                                    }else{
                                                                        echo $riga_camere_proposta_v1_1;
                                                                    }
                                                                ?>
                                                               
                                                            </table>
                                                            <table class="table table-responsive">
                                                                <tr>
                                                                    <td class="col-md-2 text-right"><small style="font-weight:normal!important"><small>Se
                                                                                il prezzo di listino è uguale al prezzo
                                                                                del soggiorno, non sarà visibile sulla
                                                                                proposta!</small></small></td>
                                                                    <td class="col-md-3">
                                                                        <label for="Prezzo">Prezzo Soggiorno <strike>Listino</strike></label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                                                                            <input type="text" onclick="calcola_totale1();"
                                                                                name="PrezzoL1" id="PrezzoL_1" class="form-control"
                                                                                placeholder="0000.00" tabindex="24">

                                                                        </div>
                                                                        <span id="sconto_P1"></span>
                                                                    </td>
                                                                    <td class="col-md-3">
                                                                        <label for="Prezzo">Prezzo Soggiorno Proposto</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon" id="p1"><i
                                                                                    class="fa fa-euro"></i></span>
                                                                            <input type="text" title="Clicca per il calcolo del totale"
                                                                                onclick="calcola_totale1();" name="PrezzoP1"
                                                                                id="PrezzoP_1" class="form-control"
                                                                                placeholder="0000.00" tabindex="25">
                                                                        </div>
                                                                    </td>
                                                                    <td class="col-md-2">
                                                                    <label for="Sconto">Sconto</label>
                                                                        
                                                                            <select name="SC1" id="SC_1" class="form-control">
                                                                                <option value="0" selected="selected">Sconto</option>
                                                                                <?=$percentuali_sconto?>
                                                                            </select>
                                                                            <input type="hidden" name="sconto_camere1" id="sconto_camere_1">
                                                                            <div id="Imponibile_1"></div>
                                                                       
                                                                    </td>
                                                                    <td class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label for="acconto_richiesta">Caparra <i
                                                                                    class="fa fa-question-circle text-info"
                                                                                    data-toggle="tooltip" title="Inserire una %, oppure un importo se si desidera richiedere una caparra!"></i>
                                                                                <i class="fa fa-exclamation-triangle text-orange"
                                                                                    data-toggle="tooltip" title="Se come importo viene inserito un valore inferiore ad 1 euro (0.1, 0.01), automaticamente si abilita la modalità Carta di Credito a Garanzia. Attenzione: se utilizzate questa opzione ricordatevi di disabilitare le altre modalità di pagamento, dal menù delle configurazioni!"></i></label>
                                                                            <select name="AccontoPercentuale1" id="AccontoPercentuale_1"
                                                                                class="form-control">
                                                                                <?=$AccontoRichiesta?>
                                                                            </select>
                                                                            <div id="acconto_l1"></div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-4" colspan="2">
                                                                        <div class="form-group">
                                                                            <label for="NomeProposta">Tipologia Tariffa</label>
                                                                            <select id="EtichettaTariffa_1" name="EtichettaTariffa1"
                                                                                class="form-control">
                                                                                <?php echo $ListaTariffe ?>
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="3" class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label for="TestoProposta">Condizioni e politiche di cancellazione
                                                                              per  Tariffa</label>
                                                                            <textarea rows="3" name="AccontoTesto1" id="AccontoTesto_1"
                                                                                class="form-control" placeholder="Il campo si autocompila scegliendo la tariffa oppure manualmente!"></textarea>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button type="button" class="btn btn-default btn-xs"
                                                                data-toggle="modal" data-target="#calculator1" title="Calcolatrice">
                                                                <i class="fa fa-calculator text-blue" aria-hidden="true"></i>
                                                            </button>
                                                            <div class="modal fade modale_drag draggable" id="calculator1">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content" style="height:360px!important;width:250px!important">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close"><span
                                                                                    aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title">Calcolatrice
                                                                                &nbsp;&nbsp;<small><small>Drag & Drop
                                                                                        <i class="fa fa-arrows"
                                                                                            aria-hidden="true"></i></small></small></h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <iframe width="100%" height="280" src="<?=BASE_URL_SITO?>calculator/index.php"
                                                                                scrolling="no" frameborder="0"
                                                                                allowfullscreen></iframe>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel box box-success">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a aria-expanded="false" class="collapsed" data-toggle="collapse"
                                                        data-parent="#accordion" href="#collapseTwo">
                                                        <span class="text-black">2° PROPOSTA</span>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div aria-expanded="false" id="collapseTwo" class="panel-collapse collapse">
                                                <div class="box-body">
                                                    <?if(check_simplebooking(IDSITO)==1){?>
                                                    <div class="row">
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-10 text-center">
                                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#input_booking2">Apri <img src="<?=BASE_URL_SITO?>img/powered-sb-bc.png"></button>
                                                            <div id="wait2"></div>
                                                        </div>
                                                        <div class="col-md-1"></div>
                                                    </div>
                                                    <?}?>
                                                    <?if(check_ericsoftbooking(IDSITO)==1){?>
                                                        <div class="row">
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-10 text-center">                                
                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#input_ericsoft_booking2">Apri <img src="<?=BASE_URL_SITO?>img/powered-ericsoftb-bc.png"  style="text-align:absmiddle;width:auto;height:15px"></button>                                                         
                                                                <div id="wait2E"></div>
                                                            </div>
                                                            <div class="col-md-1"></div>
                                                        </div>
                                                    <?}?>
                                                    <?if(check_bedzzlebooking(IDSITO)==1){?>
                                                        <div class="row">
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-10 text-center">                                
                                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#input_bedzzle_booking2">Apri <img src="<?=BASE_URL_SITO?>img/powered-bedzzleb-bc.png"  style="text-align:absmiddle;width:auto;height:20px"></button>                                                         
                                                                <div id="wait2Bedzzle"></div>
                                                            </div>
                                                            <div class="col-md-1"></div>
                                                        </div>
                                                    <?}?>
                                                    <div class="row">
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-10">
                                                            <table class="table table-responsive">
                                                                <tr>
                                                                    <td colspan="6">
                                                                        <input type="hidden" name="id_proposta" value="2">
                                                                        <div class="Check2bis"><label for="CheckProposta">
                                                                                2° Proposta</label></div>
                                                                        <div class="Check2" style="display:none">
                                                                            <label for="CheckProposta"> Seleziona
                                                                                Proposta</label>
                                                                            <div class="form-group">
                                                                                <input type="checkbox" value="1" name="CheckProposta2"
                                                                                    id="CheckProposta_2">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <? if(date('Y-m-d') > DATA_QUOTO_V2){ ?>
                                                                <tr>
                                                                    <td class="no-border-top 100-percento">
                                                                        <div class="control-group">
                                                                            <label class="control-label">Data Arrivo Alternativa</label>
                                                                            <div class="controls">
                                                                                <div class="input-group">
                                                                                    <label class="input-group-addon btn">
                                                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                                                    </label>
                                                                                    <input id="DataArrivo_2" name="DataArrivo2" type="text" class="date-picker form-control"
                                                                                        tabindex="10" autocomplete="off" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="no-border-top 100-percento">
                                                                        <div class="control-group">
                                                                            <label class="control-label">Data Partenza Alternativa</label>
                                                                            <div class="controls">
                                                                                <div class="input-group">
                                                                                    <label  class="input-group-addon btn">
                                                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                                                    </label>
                                                                                    <input id="DataPartenza_2" name="DataPartenza2" type="text" class="date-picker form-control"
                                                                                        tabindex="11" autocomplete="off" />
                                                                                </div>
                                                                            </div>
                                                                        </div>                   
                                                                    </td>
                                                                </tr>
                                                            <?}?>
                                                                <tr>
                                                                    <td colspan="6">
                                                                        <div class="form-group">
                                                                            <label for="NomeProposta">Nome Proposta o
                                                                                del Pacchetto <small style="font-weight: normal!important">(non
                                                                                    obbligatorio)</small></label>
                                                                            <select name="NomeProposta2" id="NomeProposta_2"
                                                                                class="form-control" tabindex="26">
                                                                                <?php echo $ListaPacchetti ?>
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="6">
                                                                        <div class="form-group">
                                                                            <label for="TestoProposta">Descrizione
                                                                                Proposta o del Pacchetto</label>
                                                                            <textarea rows="3" name="TestoProposta2" id="TestoProposta_2"
                                                                                class="form-control" placeholder="Non è obbligatoria la compilazione di questo campo, offre qualche informazione in più per la proposta"
                                                                                tabindex="27"></textarea>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <?if(check_simplebooking(IDSITO)==1){?>
                                                                    <tr>
                                                                        <td colspan="6" style="border:0px!important">
                                                                            <div id="simple2"></div>
                                                                        </td>
                                                                    </tr>
                                                                <?}?>
                                                                <?if(check_ericsoftbooking(IDSITO)==1){?>
                                                                    <tr id="RigaEricsoftB2">
                                                                        <td colspan="6" class="no-border-top">
                                                                            <div id="simple2E"></div>
                                                                        </td>
                                                                    </tr>
                                                                <?}?>
                                                                <?if(check_bedzzlebooking(IDSITO)==1){?>
                                                                    <tr id="RigaBedzzleB2">
                                                                        <td colspan="6" class="no-border-top">
                                                                            <div id="simple2Bedzzle"></div>
                                                                        </td>
                                                                    </tr>
                                                                <?}?>
                                                                <? 
                                                                    if(date('Y-m-d') > DATA_QUOTO_V2){ 
                                                                        echo $riga_camere_proposta_v2_2;
                                                                    }else{
                                                                        echo $riga_camere_proposta_v1_2;
                                                                    }
                                                                ?>
                                                            </table>
                                                            <table class="table table-responsive">
                                                                <tr>
                                                                    <td class="col-md-2 text-right">
                                                                        <small style="font-weight:normal!important"><small>Se
                                                                                il prezzo di listino è uguale al prezzo
                                                                                del soggiorno, non sarà visibile sulla
                                                                                proposta!</small></small>

                                                                    </td>
                                                                    <td class="col-md-3">
                                                                        <label for="Prezzo">Prezzo Soggiorno <strike>Listino</strike></label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                                                                            <input type="text" onclick="calcola_totale2();"
                                                                                name="PrezzoL2" id="PrezzoL_2" class="form-control"
                                                                                placeholder="0000.00" tabindex="32">
                                                                        </div>
                                                                        <span id="sconto_P2"></span>
                                                                    </td>
                                                                    <td class="col-md-3">
                                                                        <label for="Prezzo">Prezzo Soggiorno Proposto</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                                                                            <input type="text" title="Clicca per il calcolo del totale"
                                                                                onclick="calcola_totale2();" name="PrezzoP2"
                                                                                id="PrezzoP_2" class="form-control"
                                                                                placeholder="0000.00" tabindex="33">
                                                                        </div>
                                                                    </td>
                                                                    <td class="col-md-2">
                                                                    <label for="Sconto">Sconto</label>
                                                                            <select name="SC2" id="SC_2" class="form-control">
                                                                                <option value="0" selected="selected">Sconto</option>
                                                                                <?=$percentuali_sconto?>
                                                                            </select>
                                                                            <input type="hidden" name="sconto_camere2" id="sconto_camere_2">
                                                                            <div id="Imponibile_2"></div>
                                                                        
                                                                    </td>
                                                                    <td class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label for="acconto_richiesta">Caparra <i
                                                                                    class="fa fa-question-circle text-info"
                                                                                    data-toggle="tooltip" title="Inserire una %, oppure un importo se si desidera richiedere una caparra!"></i>
                                                                                <i class="fa fa-exclamation-triangle text-orange"
                                                                                    data-toggle="tooltip" title="Se come importo viene inserito un valore inferiore ad 1 euro (0.1, 0.01), automaticamente si abilita la modalità Carta di Credito a Garanzia. Attenzione: se utilizzate questa opzione ricordatevi di disabilitare le altre modalità di pagamento, dal menù delle configurazioni!"></i></label>
                                                                            <select name="AccontoPercentuale2" id="AccontoPercentuale_2"
                                                                                class="form-control">
                                                                                <?=$AccontoRichiesta?>
                                                                            </select>
                                                                            <div id="acconto_l2"></div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-4" colspan="2">
                                                                        <div class="form-group">
                                                                            <label for="NomeProposta">Tipologia Tariffa</label>
                                                                            <select id="EtichettaTariffa_2" name="EtichettaTariffa2"
                                                                                class="form-control">
                                                                                <?php echo $ListaTariffe ?>
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="3" class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label for="TestoProposta">Condizioni e politiche di cancellazione
                                                                              per  Tariffa</label>
                                                                            <textarea rows="3" name="AccontoTesto2" id="AccontoTesto_2"
                                                                                class="form-control" placeholder="Il campo si autocompila scegliendo la tariffa oppure manualmente!"></textarea>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button type="button" class="btn btn-default btn-xs"
                                                                data-toggle="modal" data-target="#calculator2" title="Calcolatrice">
                                                                <i class="fa fa-calculator text-blue" aria-hidden="true"></i>
                                                            </button>
                                                            <div class="modal fade modale_drag draggable" id="calculator2">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content" style="height:360px!important;width:250px!important">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close"><span
                                                                                    aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title">Calcolatrice
                                                                                &nbsp;&nbsp;<small><small>Drag & Drop
                                                                                        <i class="fa fa-arrows"
                                                                                            aria-hidden="true"></i></small></small></h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <iframe width="100%" height="280" src="<?=BASE_URL_SITO?>calculator/index.php"
                                                                                scrolling="no" frameborder="0"
                                                                                allowfullscreen></iframe>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel box box-success">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a aria-expanded="false" class="collapsed" data-toggle="collapse"
                                                        data-parent="#accordion" href="#collapseThree">
                                                        <span class="text-black">3° PROPOSTA</span>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div aria-expanded="false" id="collapseThree" class="panel-collapse collapse">
                                                <div class="box-body">
                                                    <?if(check_simplebooking(IDSITO)==1){?>
                                                    <div class="row">
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-10 text-center">
                                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#input_booking3">Apri <img src="<?=BASE_URL_SITO?>img/powered-sb-bc.png"></button>
                                                            <div id="wait3"></div>
                                                        </div>
                                                        <div class="col-md-1"></div>
                                                    </div>
                                                    <?}?>
                                                    <?if(check_ericsoftbooking(IDSITO)==1){?>
                                                        <div class="row">
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-10 text-center">                                
                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#input_ericsoft_booking3">Apri <img src="<?=BASE_URL_SITO?>img/powered-ericsoftb-bc.png"  style="text-align:absmiddle;width:auto;height:15px"></button>                                                         
                                                                <div id="wait3E"></div>
                                                            </div>
                                                            <div class="col-md-1"></div>
                                                        </div>
                                                    <?}?>
                                                    <?if(check_bedzzlebooking(IDSITO)==1){?>
                                                        <div class="row">
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-10 text-center">                                
                                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#input_bedzzle_booking3">Apri <img src="<?=BASE_URL_SITO?>img/powered-bedzzleb-bc.png"  style="text-align:absmiddle;width:auto;height:20px"></button>                                                         
                                                                <div id="wait3Bedzzle"></div>
                                                            </div>
                                                            <div class="col-md-1"></div>
                                                        </div>
                                                    <?}?>
                                                    <div class="row">
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-10">
                                                            <table class="table table-responsive">
                                                                <tr>
                                                                    <td colspan="6">
                                                                        <input type="hidden" name="id_proposta" value="3">
                                                                        <div class="Check3bis"><label for="CheckProposta">
                                                                                3° Proposta</label></div>
                                                                        <div class="Check3" style="display:none">
                                                                            <label for="CheckProposta"> Seleziona
                                                                                Proposta</label>
                                                                            <div class="form-group">
                                                                                <input type="checkbox" value="1" name="CheckProposta3"
                                                                                    id="CheckProposta_3">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <? if(date('Y-m-d') > DATA_QUOTO_V2){ ?>
                                                                <tr>
                                                                    <td class="no-border-top 100-percento">
                                                                        <div class="control-group">
                                                                            <label class="control-label">Data Arrivo Alternativa</label>
                                                                            <div class="controls">
                                                                                <div class="input-group">
                                                                                    <label class="input-group-addon btn">
                                                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                                                    </label>
                                                                                    <input id="DataArrivo_3" name="DataArrivo3" type="text" class="date-picker form-control"
                                                                                        tabindex="10" autocomplete="off" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="no-border-top 100-percento">
                                                                        <div class="control-group">
                                                                            <label class="control-label">Data Partenza Alternativa</label>
                                                                            <div class="controls">
                                                                                <div class="input-group">
                                                                                    <label  class="input-group-addon btn">
                                                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                                                    </label>
                                                                                    <input id="DataPartenza_3" name="DataPartenza3" type="text" class="date-picker form-control"
                                                                                        tabindex="11" autocomplete="off" />
                                                                                </div>
                                                                            </div>
                                                                        </div>                   
                                                                    </td>
                                                                </tr>
                                                            <?}?>                                                                
                                                                <tr>
                                                                    <td colspan="6">
                                                                        <div class="form-group">
                                                                            <label for="NomeProposta">Nome Proposta o
                                                                                del Pacchetto <small style="font-weight: normal!important">(non
                                                                                    obbligatorio)</small></label>
                                                                            <select name="NomeProposta3" id="NomeProposta_3"
                                                                                class="form-control" tabindex="34">
                                                                                <?php echo $ListaPacchetti ?>
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="6">
                                                                        <div class="form-group">
                                                                            <label for="TestoProposta">Descrizione
                                                                                Proposta o del Pacchetto</label>
                                                                            <textarea rows="3" name="TestoProposta3" id="TestoProposta_3"
                                                                                class="form-control" placeholder="Non è obbligatoria la compilazione di questo campo, offre qualche informazione in più per la proposta"
                                                                                tabindex="35"></textarea>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <?if(check_simplebooking(IDSITO)==1){?>
                                                                <tr>
                                                                    <td colspan="6" style="border:0px!important">
                                                                        <div id="simple3"></div>
                                                                    </td>
                                                                </tr>
                                                                <?}?>
                                                                <?if(check_ericsoftbooking(IDSITO)==1){?>
                                                                    <tr id="RigaEricsoftB3">
                                                                        <td colspan="6" class="no-border-top">
                                                                            <div id="simple3E"></div>
                                                                        </td>
                                                                    </tr>
                                                                <?}?>
                                                                <?if(check_bedzzlebooking(IDSITO)==1){?>
                                                                    <tr id="RigaBedzzleB3">
                                                                        <td colspan="6" class="no-border-top">
                                                                            <div id="simple3Bedzzle"></div>
                                                                        </td>
                                                                    </tr>
                                                                <?}?>
                                                                <? 
                                                                    if(date('Y-m-d') > DATA_QUOTO_V2){ 
                                                                        echo $riga_camere_proposta_v2_3;
                                                                    }else{
                                                                        echo $riga_camere_proposta_v1_3;
                                                                    }
                                                                ?>
                                                            </table>
                                                            <table class="table table-responsive">
                                                                <tr>
                                                                    <td class="col-md-2 text-right">
                                                                        <small style="font-weight:normal!important"><small>Se
                                                                                il prezzo di listino è uguale al prezzo
                                                                                del soggiorno, non sarà visibile sulla
                                                                                proposta!</small></small>
                                                                    </td>
                                                                    <td class="col-md-3">
                                                                        <label for="Prezzo">Prezzo Soggiorno <strike>Listino</strike></label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                                                                            <input type="text" onclick="calcola_totale3();"
                                                                                name="PrezzoL3" id="PrezzoL_3" class="form-control"
                                                                                placeholder="0000.00" tabindex="40">
                                                                        </div>
                                                                        <span id="sconto_P3"></span>
                                                                    </td>
                                                                    <td class="col-md-3">
                                                                        <label for="Prezzo">Prezzo Soggiorno Proposto</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                                                                            <input type="text" title="Clicca per il calcolo del totale"
                                                                                onclick="calcola_totale3();" name="PrezzoP3"
                                                                                id="PrezzoP_3" class="form-control"
                                                                                placeholder="0000.00" tabindex="41">
                                                                        </div>
                                                                    </td>
                                                                    <td class="col-md-2">
                                                                    <label for="Sconto">Sconto</label>
                                                                            <select name="SC3" id="SC_3" class="form-control">
                                                                                <option value="0" selected="selected">Sconto</option>
                                                                                <?=$percentuali_sconto?>
                                                                            </select>
                                                                            <input type="hidden" name="sconto_camere3" id="sconto_camere_3">
                                                                            <div id="Imponibile_3"></div>
                                                                        
                                                                    </td>
                                                                    <td class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label for="acconto_richiesta">Caparra <i
                                                                                    class="fa fa-question-circle text-info"
                                                                                    data-toggle="tooltip" title="Inserire una %, oppure un importo se si desidera richiedere una caparra!"></i>
                                                                                <i class="fa fa-exclamation-triangle text-orange"
                                                                                    data-toggle="tooltip" title="Se come importo viene inserito un valore inferiore ad 1 euro (0.1, 0.01), automaticamente si abilita la modalità Carta di Credito a Garanzia. Attenzione: se utilizzate questa opzione ricordatevi di disabilitare le altre modalità di pagamento, dal menù delle configurazioni!"></i></label>
                                                                            <select name="AccontoPercentuale3" id="AccontoPercentuale_3"
                                                                                class="form-control">
                                                                                <?=$AccontoRichiesta?>
                                                                            </select>
                                                                            <div id="acconto_l3"></div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-4" colspan="2">
                                                                        <div class="form-group">
                                                                            <label for="NomeProposta">Tipologia Tariffa</label>
                                                                            <select id="EtichettaTariffa_3" name="EtichettaTariffa3"
                                                                                class="form-control">
                                                                                <?php echo $ListaTariffe ?>
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="3" class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label for="TestoProposta">Condizioni e politiche di cancellazione
                                                                              per  Tariffa</label>
                                                                            <textarea rows="3" name="AccontoTesto3" id="AccontoTesto_3"
                                                                                class="form-control" placeholder="Il campo si autocompila scegliendo la tariffa oppure manualmente!"></textarea>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button type="button" class="btn btn-default btn-xs"
                                                                data-toggle="modal" data-target="#calculator3" title="Calcolatrice">
                                                                <i class="fa fa-calculator text-blue" aria-hidden="true"></i>
                                                            </button>
                                                            <div class="modal fade modale_drag draggable" id="calculator3">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content" style="height:360px!important;width:250px!important">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close"><span
                                                                                    aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title">Calcolatrice
                                                                                &nbsp;&nbsp;<small><small>Drag & Drop
                                                                                        <i class="fa fa-arrows"
                                                                                            aria-hidden="true"></i></small></small></h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <iframe width="100%" height="280" src="<?=BASE_URL_SITO?>calculator/index.php"
                                                                                scrolling="no" frameborder="0"
                                                                                allowfullscreen></iframe>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <? if(date('Y-m-d') >= DATA_QUOTO_V2){ ?>
                                        <div class="panel box box-success">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a aria-expanded="false" class="collapsed" data-toggle="collapse"
                                                        data-parent="#accordion" href="#collapse4">
                                                        <span class="text-black">4° PROPOSTA</span>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div aria-expanded="false" id="collapse4" class="panel-collapse collapse">
                                                <div class="box-body">
                                                    <?if(check_simplebooking(IDSITO)==1){?>
                                                    <div class="row">
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-10 text-center">
                                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#input_booking4">Apri <img src="<?=BASE_URL_SITO?>img/powered-sb-bc.png"></button>
                                                            <div id="wait4"></div>
                                                        </div>
                                                        <div class="col-md-1"></div>
                                                    </div>
                                                    <?}?>
                                                    <?if(check_ericsoftbooking(IDSITO)==1){?>
                                                        <div class="row">
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-10 text-center">                                
                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#input_ericsoft_booking4">Apri <img src="<?=BASE_URL_SITO?>img/powered-ericsoftb-bc.png"  style="text-align:absmiddle;width:auto;height:15px"></button>                                                         
                                                                <div id="wait4E"></div>
                                                            </div>
                                                            <div class="col-md-1"></div>
                                                        </div>
                                                    <?}?>
                                                    <?if(check_bedzzlebooking(IDSITO)==1){?>
                                                        <div class="row">
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-10 text-center">                                
                                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#input_bedzzle_booking4">Apri <img src="<?=BASE_URL_SITO?>img/powered-bedzzleb-bc.png"  style="text-align:absmiddle;width:auto;height:20px"></button>                                                         
                                                                <div id="wait4Bedzzle"></div>
                                                            </div>
                                                            <div class="col-md-1"></div>
                                                        </div>
                                                    <?}?>
                                                    <div class="row">
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-10">
                                                            <table class="table table-responsive">
                                                                <tr>
                                                                    <td colspan="6">
                                                                        <input type="hidden" name="id_proposta" value="4">
                                                                        <div class="Check4bis"><label for="CheckProposta">
                                                                                4° Proposta</label></div>
                                                                        <div class="Check4" style="display:none">
                                                                            <label for="CheckProposta"> Seleziona
                                                                                Proposta</label>
                                                                            <div class="form-group">
                                                                                <input type="checkbox" value="1" name="CheckProposta4"
                                                                                    id="CheckProposta_4">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>                                                            
                                                                <tr>
                                                                    <td class="no-border-top 100-percento">
                                                                        <div class="control-group">
                                                                            <label class="control-label">Data Arrivo Alternativa</label>
                                                                            <div class="controls">
                                                                                <div class="input-group">
                                                                                    <label class="input-group-addon btn">
                                                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                                                    </label>
                                                                                    <input id="DataArrivo_4" name="DataArrivo4" type="text" class="date-picker form-control"
                                                                                        tabindex="10" autocomplete="off" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="no-border-top 100-percento">
                                                                        <div class="control-group">
                                                                            <label class="control-label">Data Partenza Alternativa</label>
                                                                            <div class="controls">
                                                                                <div class="input-group">
                                                                                    <label  class="input-group-addon btn">
                                                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                                                    </label>
                                                                                    <input id="DataPartenza_4" name="DataPartenza4" type="text" class="date-picker form-control"
                                                                                        tabindex="11" autocomplete="off" />
                                                                                </div>
                                                                            </div>
                                                                        </div>                   
                                                                    </td>
                                                                </tr> 
                                                                <tr>
                                                                    <td colspan="6">
                                                                        <div class="form-group">
                                                                            <label for="NomeProposta">Nome Proposta o
                                                                                del Pacchetto <small style="font-weight: normal!important">(non
                                                                                    obbligatorio)</small></label>
                                                                            <select name="NomeProposta4" id="NomeProposta_4"
                                                                                class="form-control" tabindex="34">
                                                                                <?php echo $ListaPacchetti ?>
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="6">
                                                                        <div class="form-group">
                                                                            <label for="TestoProposta">Descrizione
                                                                                Proposta o del Pacchetto</label>
                                                                            <textarea rows="3" name="TestoProposta4" id="TestoProposta_4"
                                                                                class="form-control" placeholder="Non è obbligatoria la compilazione di questo campo, offre qualche informazione in più per la proposta"
                                                                                tabindex="35"></textarea>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <?if(check_simplebooking(IDSITO)==1){?>
                                                                <tr>
                                                                    <td colspan="6" class="no-border-top">
                                                                        <div id="simple4"></div>
                                                                    </td>
                                                                </tr>
                                                                <?}?>
                                                                <?if(check_ericsoftbooking(IDSITO)==1){?>
                                                                    <tr id="RigaEricsoftB4">
                                                                        <td colspan="6" class="no-border-top">
                                                                            <div id="simple4E"></div>
                                                                        </td>
                                                                    </tr>
                                                                <?}?>
                                                                <?if(check_bedzzlebooking(IDSITO)==1){?>
                                                                    <tr id="RigaBedzzleB4">
                                                                        <td colspan="6" class="no-border-top">
                                                                            <div id="simple4Bedzzle"></div>
                                                                        </td>
                                                                    </tr>
                                                                <?}?>
                                                                <?  echo $riga_camere_proposta_v2_4; ?>
                                                            </table>
                                                            <table class="table table-responsive">
                                                                <tr>
                                                                    <td class="col-md-2 text-right">
                                                                        <small style="font-weight:normal!important"><small>Se
                                                                                il prezzo di listino è uguale al prezzo
                                                                                del soggiorno, non sarà visibile sulla
                                                                                proposta!</small></small>
                                                                    </td>
                                                                    <td class="col-md-3">
                                                                        <label for="Prezzo">Prezzo Soggiorno <strike>Listino</strike></label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                                                                            <input type="text" onclick="calcola_totale4();"
                                                                                name="PrezzoL4" id="PrezzoL_4" class="form-control"
                                                                                placeholder="0000.00" tabindex="40">
                                                                        </div>
                                                                        <span id="sconto_P4"></span>
                                                                    </td>
                                                                    <td class="col-md-3">
                                                                        <label for="Prezzo">Prezzo Soggiorno Proposto</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                                                                            <input type="text" title="Clicca per il calcolo del totale"
                                                                                onclick="calcola_totale4();" name="PrezzoP4"
                                                                                id="PrezzoP_4" class="form-control"
                                                                                placeholder="0000.00" tabindex="41">
                                                                        </div>
                                                                    </td>
                                                                    <td class="col-md-2">
                                                                    <label for="Sconto">Sconto</label>
                                                                            <select name="SC4" id="SC_4" class="form-control">
                                                                                <option value="0" selected="selected">Sconto</option>
                                                                                <?=$percentuali_sconto?>
                                                                            </select>
                                                                            <input type="hidden" name="sconto_camere4" id="sconto_camere_4">
                                                                            <div id="Imponibile_4"></div>
                                                                       
                                                                    </td>
                                                                    <td class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label for="acconto_richiesta">Caparra <i
                                                                                    class="fa fa-question-circle text-info"
                                                                                    data-toggle="tooltip" title="Inserire una %, oppure un importo se si desidera richiedere una caparra!"></i>
                                                                                <i class="fa fa-exclamation-triangle text-orange"
                                                                                    data-toggle="tooltip" title="Se come importo viene inserito un valore inferiore ad 1 euro (0.1, 0.01), automaticamente si abilita la modalità Carta di Credito a Garanzia. Attenzione: se utilizzate questa opzione ricordatevi di disabilitare le altre modalità di pagamento, dal menù delle configurazioni!"></i></label>
                                                                            <select name="AccontoPercentuale4" id="AccontoPercentuale_4"
                                                                                class="form-control">
                                                                                <?=$AccontoRichiesta?>
                                                                            </select>
                                                                            <div id="acconto_l4"></div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-4" colspan="2">
                                                                        <div class="form-group">
                                                                            <label for="NomeProposta">Tipologia Tariffa</label>
                                                                            <select id="EtichettaTariffa_4" name="EtichettaTariffa4"
                                                                                class="form-control">
                                                                                <?php echo $ListaTariffe ?>
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="3" class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label for="TestoProposta">Condizioni e politiche di cancellazione
                                                                              per  Tariffa</label>
                                                                            <textarea rows="3" name="AccontoTesto4" id="AccontoTesto_4"
                                                                                class="form-control" placeholder="Il campo si autocompila scegliendo la tariffa oppure manualmente!"></textarea>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button type="button" class="btn btn-default btn-xs"
                                                                data-toggle="modal" data-target="#calculator4" title="Calcolatrice">
                                                                <i class="fa fa-calculator text-blue" aria-hidden="true"></i>
                                                            </button>
                                                            <div class="modal fade modale_drag draggable" id="calculator4">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content" style="height:360px!important;width:250px!important">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close"><span
                                                                                    aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title">Calcolatrice
                                                                                &nbsp;&nbsp;<small><small>Drag & Drop
                                                                                        <i class="fa fa-arrows"
                                                                                            aria-hidden="true"></i></small></small></h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <iframe width="100%" height="280" src="<?=BASE_URL_SITO?>calculator/index.php"
                                                                                scrolling="no" frameborder="0"
                                                                                allowfullscreen></iframe>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  

                                        <div class="panel box box-success">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a aria-expanded="false" class="collapsed" data-toggle="collapse"
                                                        data-parent="#accordion" href="#collapse5">
                                                        <span class="text-black">5° PROPOSTA</span>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div aria-expanded="false" id="collapse5" class="panel-collapse collapse">
                                                <div class="box-body">
                                                    <?if(check_simplebooking(IDSITO)==1){?>
                                                    <div class="row">
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-10 text-center">
                                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#input_booking5">Apri <img src="<?=BASE_URL_SITO?>img/powered-sb-bc.png"></button>
                                                            <div id="wait5"></div>
                                                        </div>
                                                        <div class="col-md-1"></div>
                                                    </div>
                                                    <?}?>
                                                    <?if(check_ericsoftbooking(IDSITO)==1){?>
                                                        <div class="row">
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-10 text-center">                                
                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#input_ericsoft_booking5">Apri <img src="<?=BASE_URL_SITO?>img/powered-ericsoftb-bc.png"  style="text-align:absmiddle;width:auto;height:15px"></button>                                                         
                                                                <div id="wait5E"></div>
                                                            </div>
                                                            <div class="col-md-1"></div>
                                                        </div>
                                                    <?}?>
                                                    <?if(check_bedzzlebooking(IDSITO)==1){?>
                                                        <div class="row">
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-10 text-center">                                
                                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#input_bedzzle_booking5">Apri <img src="<?=BASE_URL_SITO?>img/powered-bedzzleb-bc.png"  style="text-align:absmiddle;width:auto;height:20px"></button>                                                         
                                                                <div id="wait5Bedzzle"></div>
                                                            </div>
                                                            <div class="col-md-1"></div>
                                                        </div>
                                                    <?}?>
                                                    <div class="row">
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-10">
                                                            <table class="table table-responsive">
                                                                <tr>
                                                                    <td colspan="6">
                                                                        <input type="hidden" name="id_proposta" value="5">
                                                                        <div class="Check4bis"><label for="CheckProposta">
                                                                                5° Proposta</label></div>
                                                                        <div class="Check5" style="display:none">
                                                                            <label for="CheckProposta"> Seleziona
                                                                                Proposta</label>
                                                                            <div class="form-group">
                                                                                <input type="checkbox" value="1" name="CheckProposta5"
                                                                                    id="CheckProposta_5">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="no-border-top 100-percento">
                                                                        <div class="control-group">
                                                                            <label class="control-label">Data Arrivo Alternativa</label>
                                                                            <div class="controls">
                                                                                <div class="input-group">
                                                                                    <label class="input-group-addon btn">
                                                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                                                    </label>
                                                                                    <input id="DataArrivo_5" name="DataArrivo5" type="text" class="date-picker form-control"
                                                                                        tabindex="10" autocomplete="off" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="no-border-top 100-percento">
                                                                        <div class="control-group">
                                                                            <label class="control-label">Data Partenza Alternativa</label>
                                                                            <div class="controls">
                                                                                <div class="input-group">
                                                                                    <label  class="input-group-addon btn">
                                                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                                                    </label>
                                                                                    <input id="DataPartenza_5" name="DataPartenza5" type="text" class="date-picker form-control"
                                                                                        tabindex="11" autocomplete="off" />
                                                                                </div>
                                                                            </div>
                                                                        </div>                   
                                                                    </td>
                                                                </tr> 
                                                                <tr>
                                                                    <td colspan="6">
                                                                        <div class="form-group">
                                                                            <label for="NomeProposta">Nome Proposta o
                                                                                del Pacchetto <small style="font-weight: normal!important">(non
                                                                                    obbligatorio)</small></label>
                                                                            <select name="NomeProposta5" id="NomeProposta_5"
                                                                                class="form-control" tabindex="34">
                                                                                <?php echo $ListaPacchetti ?>
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="6">
                                                                        <div class="form-group">
                                                                            <label for="TestoProposta">Descrizione
                                                                                Proposta o del Pacchetto</label>
                                                                            <textarea rows="3" name="TestoProposta5" id="TestoProposta_5"
                                                                                class="form-control" placeholder="Non è obbligatoria la compilazione di questo campo, offre qualche informazione in più per la proposta"
                                                                                tabindex="35"></textarea>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <?if(check_simplebooking(IDSITO)==1){?>
                                                                <tr>
                                                                    <td colspan="6" style="border:0px!important">
                                                                        <div id="simple5"></div>
                                                                    </td>
                                                                </tr>
                                                                <?}?>
                                                                <?if(check_ericsoftbooking(IDSITO)==1){?>
                                                                    <tr id="RigaEricsoftB5">
                                                                        <td colspan="6" class="no-border-top">
                                                                            <div id="simple5E"></div>
                                                                        </td>
                                                                    </tr>
                                                                <?}?>
                                                                <?if(check_bedzzlebooking(IDSITO)==1){?>
                                                                    <tr id="RigaBedzzleB5">
                                                                        <td colspan="6" class="no-border-top">
                                                                            <div id="simple5Bedzzle"></div>
                                                                        </td>
                                                                    </tr>
                                                                <?}?>
                                                                <?  echo $riga_camere_proposta_v2_5; ?>
                                                            </table>
                                                            <table class="table table-responsive">
                                                                <tr>
                                                                    <td class="col-md-2 text-right">
                                                                        <small style="font-weight:normal!important"><small>Se
                                                                                il prezzo di listino è uguale al prezzo
                                                                                del soggiorno, non sarà visibile sulla
                                                                                proposta!</small></small>
                                                                    </td>
                                                                    <td class="col-md-3">
                                                                        <label for="Prezzo">Prezzo Soggiorno <strike>Listino</strike></label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                                                                            <input type="text" onclick="calcola_totale5();"
                                                                                name="PrezzoL5" id="PrezzoL_5" class="form-control"
                                                                                placeholder="0000.00" tabindex="40">
                                                                        </div>
                                                                        <span id="sconto_P5"></span>
                                                                    </td>
                                                                    <td class="col-md-3">
                                                                        <label for="Prezzo">Prezzo Soggiorno Proposto</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                                                                            <input type="text" title="Clicca per il calcolo del totale"
                                                                                onclick="calcola_totale5();" name="PrezzoP5"
                                                                                id="PrezzoP_5" class="form-control"
                                                                                placeholder="0000.00" tabindex="41">
                                                                        </div>
                                                                    </td>
                                                                    <td class="col-md-2">
                                                                        <label for="Sconto">Sconto</label>
                                                                            <select name="SC5" id="SC_5" class="form-control">
                                                                                <option value="0" selected="selected">Sconto</option>
                                                                                <?=$percentuali_sconto?>
                                                                            </select>
                                                                            <input type="hidden" name="sconto_camere5" id="sconto_camere_5">
                                                                            <div id="Imponibile_5"></div>
                                                                        
                                                                    </td>
                                                                    <td class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label for="acconto_richiesta">Caparra <i
                                                                                    class="fa fa-question-circle text-info"
                                                                                    data-toggle="tooltip" title="Inserire una %, oppure un importo se si desidera richiedere una caparra!"></i>
                                                                                <i class="fa fa-exclamation-triangle text-orange"
                                                                                    data-toggle="tooltip" title="Se come importo viene inserito un valore inferiore ad 1 euro (0.1, 0.01), automaticamente si abilita la modalità Carta di Credito a Garanzia. Attenzione: se utilizzate questa opzione ricordatevi di disabilitare le altre modalità di pagamento, dal menù delle configurazioni!"></i></label>
                                                                            <select name="AccontoPercentuale5" id="AccontoPercentuale_5"
                                                                                class="form-control">
                                                                                <?=$AccontoRichiesta?>
                                                                            </select>
                                                                            <div id="acconto_l5"></div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-4" colspan="2">
                                                                        <div class="form-group">
                                                                            <label for="NomeProposta">Tipologia Tariffa</label>
                                                                            <select id="EtichettaTariffa_5" name="EtichettaTariffa5"
                                                                                class="form-control">
                                                                                <?php echo $ListaTariffe ?>
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="3" class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label for="TestoProposta">Condizioni e politiche di cancellazione
                                                                               per Tariffa</label>
                                                                            <textarea rows="3" name="AccontoTesto5" id="AccontoTesto_5"
                                                                                class="form-control" placeholder="Il campo si autocompila scegliendo la tariffa oppure manualmente!"></textarea>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button type="button" class="btn btn-default btn-xs"
                                                                data-toggle="modal" data-target="#calculator5" title="Calcolatrice">
                                                                <i class="fa fa-calculator text-blue" aria-hidden="true"></i>
                                                            </button>
                                                            <div class="modal fade modale_drag draggable" id="calculator5">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content" style="height:360px!important;width:250px!important">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close"><span
                                                                                    aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title">Calcolatrice
                                                                                &nbsp;&nbsp;<small><small>Drag & Drop
                                                                                        <i class="fa fa-arrows"
                                                                                            aria-hidden="true"></i></small></small></h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <iframe width="100%" height="280" src="<?=BASE_URL_SITO?>calculator/index.php"
                                                                                scrolling="no" frameborder="0"
                                                                                allowfullscreen></iframe>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                       



                                    <?}?>

                                    </div>

                                </div><!-- /.box-body -->
                            </div>

                        </div>
                    </div><!-- chiusura row -->                   
                    <h2 class="page-header linea_aqua">
                        <i class="fa fa-inbox text-aqua"></i> Informazioni
                    </h2>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <!-- left column -->
                            <div class="form-group">
                                <label for="FontePrenotazione">Fonte Prenotazione</label>
                                <select name="FontePrenotazione" class="form-control" tabindex="42" required title=" ">
                                    <option value="" selected="selected">--</option>
                                    <?=$ListaFonti?>
                                </select>
                                <small style="font-weight:normal!important;">Scegliere la fonte più lontana, la prima..., dove nasce la richiesta, rende le statistiche più precise!</small>
                            </div>
                        </div><!-- colonna left -->
                        <div class="col-md-5">
                            <!-- right column -->
                            <div class="form-group">
                                <label for="DataScadenza">Data scadenza della proposta</label>
                                <input type="text" name="DataScadenza" id="DataScadenza" class="date-picker form-control"
                                    tabindex="43" autocomplete="off">
                            </div>
                        </div><!-- colonna right -->
                        <div class="col-md-1"></div>
                    </div><!-- chiusura row -->
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <!-- left column -->
                            <div class="form-group">
                                <label for="Note" style="line-height:1.1!important;text-align:justify!important;">Note<br><small
                                        style="font-weight:normal!important;">Il campo <b>è visibile solo all'operatore</b>
                                        di
                                        <?=NOME_AMMINISTRAZIONE?>, il suo contenuto è individuabile nella <b>stampa del
                                            PDF</b>!</small></label>
                                <textarea class="form-control" rows="3" placeholder="Note" name="Note" tabindex="44"></textarea>
                            </div>
                        </div><!-- colonna left -->
                        <div class="col-md-1">
                            <!-- right column -->

                            <label for="CheckCamera"> Abilita Invio</label>
                            <div class="form-group">
                                <input type="checkbox" class="js-switch" value="1" checked="checked" name="AbilitaInvio"
                                    tabindex="45">
                            </div>
                        </div><!-- colonna right -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_politiche">Condizioni Generali <i class="fa fa-question-circle text-info"
                                        data-toggle="tooltip" title="Scegliere le Condizioni Generali inserite durante il setting del software Quoto!"></i></label>
                                <select name="id_politiche" class="form-control" tabindex="47" required title=" ">
                                    <option value="" selected="selected">--</option>
                                    <?=$ListaPolitiche?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div><!-- chiusura row -->
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="form-group">
                            <label for="pagamenti"> Tipologie di pagamento <i class="fa fa-question-circle text-info"
                                data-toggle="tooltip" title="Per ogni richiesta è possibile abilitare o disabilitare le tipologie di pagamento impostate di default dalle configurazioni iniziali!"></i></label>                                                  
                                <?=$TipiPagamento?>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>

            </div><!-- /.box-body -->
            <div class="box-footer text-center">
                <input type="hidden" name="Lingua" value="<?=$Lingua?>">
                <input type="hidden" name="idsito" value="<?=IDSITO?>">
                <input type="hidden" name="DataRichiesta" value="<?=date('Y-m-d')?>">
                <input type="hidden" name="action" value="create">
                <div id="view_form_loading"></div>
                <button type="submit" class="btn btn-primary" onclick="check_prezzo()" id="bottone_salva">CREA RICHIESTA</button>
            </div>
            </form>
        </div>
</div>
</section><!-- /.content -->
</div><!-- ./wrapper -->
<?php if(check_bedzzlebooking(IDSITO)==1){include(BASE_PATH_SITO.'include/controller/modale_bedzzle.inc.php');} ?>
<?php if(check_ericsoftbooking(IDSITO)==1){include(BASE_PATH_SITO.'include/controller/modale_ericsoft.inc.php');} ?>
<?php if(check_simplebooking(IDSITO)==1){include(BASE_PATH_SITO.'include/controller/modale_simplebooking.inc.php');} ?>
<?php include(BASE_PATH_SITO.'js/modulo_hospitality.inc.js.php');?>
<?php include_module('footer.inc.php'); ?>