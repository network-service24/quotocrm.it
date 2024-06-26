<?php if($TipoRichiesta == 'Preventivo'){?>
        <!-- se le proposta è 1 -->
        <?php

                $nr = ($numero_proposte+1);
                for($nr==($numero_proposte+1); $nr<=5; $nr++){
            ?>
                    <!-- ° PROPOSTA -->
                    <div class="panel box box-success">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a class="collapsed" aria-expanded="false" data-toggle="collapse"
                                    data-parent="#accordion" href="#collapse<?=$nr?>">
                                    <span class="text-black"><?=$nr?>° PROPOSTA</span>
                                </a>
                            </h4>
                        </div>
                        <div aria-expanded="true" id="collapse<?=$nr?>" class="panel-collapse collapse">
                            <div class="box-body">
                                <?if(check_simplebooking(IDSITO)==1){?>
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10 text-center">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#input_booking<?=$nr?>">Apri <img src="<?=BASE_URL_SITO?>img/powered-sb-bc.png"></button>
                                        <div id="wait<?=$nr?>"><small>Per il controllo della disponibilità con SB, vengono prese in considerazione i campi del blocco <i class="fa fa-calendar text-orange" aria-hidden="true"></i> <b>Dati Prenotazione</b>:<br>Data <b>principale</b> di Arrivo, Data <b>principale</b> di Partenza, Numero <b>totale</b> di Adulti, Numero <b>totale</b> dei Bambini e <b class="text-red">NON</b> i relativi campi <b>alternativi</b>!!</small></div>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>
                                <?}?>
                                <?if(check_ericsoftbooking(IDSITO)==1){?>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10 text-center">                                
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#input_ericsoft_booking<?=$nr?>">Apri <img src="<?=BASE_URL_SITO?>img/powered-ericsoftb-bc.png"  style="text-align:absmiddle;width:auto;height:15px"></button>                                                         
                                            <div id="wait<?=$nr?>E"></div>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                <?}?> 
                                <?if(check_bedzzlebooking(IDSITO)==1){?>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10 text-center">                                
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#input_bedzzle_booking<?=$nr?>">Apri <img src="<?=BASE_URL_SITO?>img/powered-bedzzleb-bc.png"  style="text-align:absmiddle;width:auto;height:20px"></button>                                                         
                                            <div id="wait<?=$nr?>Bedzzle"></div>
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
                                                    <input type="hidden" name="id_proposta_<?=$nr?>" value="<?=$nr?>">
                                                    <div class="Check<?=$nr?>bis"><label for="CheckProposta">
                                                        <?=$nr?>° Proposta</label></div>
                                                    <div class="Check<?=$nr?>" style="display:none">
                                                        <label for="CheckProposta"> Seleziona
                                                            Proposta</label>
                                                        <div class="form-group">
                                                            <input type="checkbox" value="1" name="CheckProposta<?=$nr?>"
                                                                onclick="check(this);" class="controllo"
                                                                id="CheckProposta_<?=$nr?>">
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
                                                                <input id="DataArrivo_<?=$nr?>" name="DataArrivo<?=$nr?>" type="text" class="date-picker form-control"
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
                                                                <input id="DataPartenza_<?=$nr?>" name="DataPartenza<?=$nr?>" type="text" class="date-picker form-control"
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
                                                        <select id="NomeProposta_<?=$nr?>" name="NomeProposta<?=$nr?>"
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
                                                        <textarea rows="3" name="TestoProposta<?=$nr?>" id="TestoProposta_<?=$nr?>"
                                                            class="form-control" placeholder="Non è obbligatoria la compilazione di questo campo, offre qualche informazione in più per la proposta"
                                                            tabindex="19"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?if(check_simplebooking(IDSITO)==1){?>
                                                <tr>
                                                    <td colspan="6" style="border:0px!important">
                                                        <div id="simple<?=$nr?>"></div>
                                                    </td>
                                                </tr>
                                            <?}?>
                                            <?if(check_ericsoftbooking(IDSITO)==1){?>
                                                <tr>
                                                    <td colspan="6" class="no-border-top">
                                                        <div id="simple<?=$nr?>E"></div>
                                                    </td>
                                                </tr>
                                            <?}?>
                                            <?if(check_bedzzlebooking(IDSITO)==1){?>
                                                <tr>
                                                    <td colspan="6" class="no-border-top">
                                                        <div id="simple<?=$nr?>Bedzzle"></div>
                                                    </td>
                                                </tr>
                                            <?}?>
                                            <tr>
                                                <td colspan="6" class="nopadding no-border-top">
                                                    <table class="table table-responsive">
                                                    <tr>
                                                        <td class="td25pdl10pdr10 no-border-top">
                                                          <div class="posizione_spiegazione_prezzo" id="spiegazione_prezzo_soggiorno_<?=$nr?>_1"></div>
                                                                <div class="form-group">
                                                                    <select name="TipoSoggiorno<?=$nr?>[]" id="TipoSoggiorno_<?=$nr?>_1"
                                                                        class="form-control" tabindex="20">
                                                                        <option value="" selected="selected">Tipo Soggiorno</option>
                                                                        <?=$ListaSoggiorno?>
                                                                    </select>
                                                                </div>
                                                        </td>
                                                        <td class="td6pdl0pdr10 no-border-top">
                                                            <div class="form-group">
                                                                <select name="NumeroCamere<?=$nr?>[]" id="NumeroCamere_<?=$nr?>_1"
                                                                    class="form-control" tabindex="21">
                                                                    <option value="" selected="selected">Nr.</option>
                                                                    <?=$NumeriC?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="td25pdl0pdr10 no-border-top">
                                                            <div class="form-group">
                                                                <select name="TipoCamere<?=$nr?>[]" id="TipoCamere_<?=$nr?>_1" class="<?=$stile_chosen?> form-control" <?=((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0 && check_bedzzlebooking(IDSITO)==0)?'onChange="get_listino(<?=$nr?>,1);"':'')?>>
                                                                    <option value="" selected="selected">Camere</option>
                                                                        <?=$ListaCamere?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="td9pdl0pdr10 no-border-top">
                                                            <div class="form-group">
                                                                <select name="NumAdulti<?=$nr?>[]" id="NumeroAdulti_<?=$nr?>_1"
                                                                    class="form-control" tabindex="20" <?=((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0 && check_bedzzlebooking(IDSITO)==0)?'onChange="get_listino(<?=$nr?>,1);"':'')?>>
                                                                    <option value="" selected="selected">Adulti</option>
                                                                    <?=$NumeriAD?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="td9pdl0pdr10 no-border-top">
                                                            <div class="form-group">
                                                                <select name="NumBambini<?=$nr?>[]" id="NumeroBambini_<?=$nr?>_1"
                                                                    class="NumeroBambini_<?=$nr?>_1 form-control" tabindex="20" onchange="eta_bimbi('<?=$nr?>_1');">
                                                                    <option value="" selected="selected">Bambini</option>
                                                                    <?=$NumeriBimbi?>
                                                                </select>
                                                                <div class="EtaBambini<?=$nr?>_1" style="display:none">
                                                                    <input type="text"  name="EtaB<?=$nr?>[]" placeholder="Età: 1,3 mesi,< 1" class="form-control" data-toggle="tooltip" title="inserire prima un numero intero, poi successivamente 3 mesi, oppure < 1">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="td25pdl0pdr0 no-border-top">
                                                        <div class="posizione_spiegazione_prezzo" id="spiegazione_prezzo_<?=$nr?>_1"></div>
                                                            <div class="form-group">
                                                                <div class="input-group" style="width:100%">
                                                            <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                                                                    <input type="text" name="Prezzo<?=$nr?>[]" id="Prezzo_<?=$nr?>_1"
                                                                        class="prezzo<?=$nr?> form-control"
                                                                        placeholder="Prezzo 0000.00" tabindex="23" <?=((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0 && check_bedzzlebooking(IDSITO)==0)?'onfocus="get_listino(<?=$nr?>,1);"':'')?> onmouseout="calcola_totale<?=$nr?>();">
                                                                    <span class="input-group-addon btn bg-green" onclick="room_fields(<?=$nr?>,'righe_room<?=$nr?>');">
                                                                        <i class="fa fa-plus"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6" class="nopadding no-border-top">
                                                            <table id="righe_room<?=$nr?>" class="table table-responsive nopadding"></table>
                                                        </td>
                                                    </tr>
                                                    <?=get_servizi_aggiuntivi($nr)?>
                                                </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <table class="table table-responsive">
                                            <tr>
                                                <td class="col-md-2 text-right"><small style="font-weight:normal!important"><small>Se
                                                            il prezzo di listino è uguale al prezzo
                                                            del soggiorno, non sarà visibile sulla
                                                            proposta!</small></small></td>
                                                <td class="col-md-3">
                                                    <label for="Prezzo">Prezzo Soggiorno <strike>Listino</strike></label>
                                                    <div class="input-group" style="width:100%">
                                                        <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                                                        <input type="text" onclick="calcola_totale<?=$nr?>();"
                                                            name="PrezzoL<?=$nr?>" id="PrezzoL_<?=$nr?>" class="form-control"
                                                            placeholder="0000.00" tabindex="24">

                                                    </div>
                                                    <span id="sconto_P<?=$nr?>"></span>
                                                </td>
                                                <td class="col-md-3">
                                                    <label for="Prezzo">Prezzo Soggiorno Proposto</label>
                                                    <div class="input-group" style="width:100%">
                                                        <span class="input-group-addon" id="p<?=$nr?>"><i
                                                                class="fa fa-euro"></i></span>
                                                        <input type="text" title="Clicca per il calcolo del totale"
                                                            onclick="calcola_totale<?=$nr?>();" name="PrezzoP<?=$nr?>"
                                                            id="PrezzoP_<?=$nr?>" class="form-control"
                                                            placeholder="0000.00" tabindex="25">
                                                    </div>
                                                </td>
                                                <div style="float:right; margin-right:180px;background-color:#FF3333;color:#FFFFFF!important;<?=($CodiceSconto != ''?'padding:10px;':'')?>" class="nowrap"><small><?=($CodiceSconto != ''  && $check_codice_sconto == true ? 'Applica il codice promo ['.$CodiceSconto.']'.($valore_sconto != ''?'':' <i class="fa fa-question-circle" data-toggle="tooltip" title="" aria-hidden="true" data-original-title="Applica lo sconto in base alla descrizione dello sconto stesso da te compilata!"></i>') : ($CodiceSconto != ''  && $check_codice_sconto == false?'Il codice promo inserito dal cliente è ['.$CodiceSconto.'],<br> ma non corrisponde a quello creato su QUOTO!':'') )?></small></div> 
                                                <td class="col-md-2">
                                                    <label>Sconto</label>
                                                        <select name="SC<?=$nr?>" id="SC_<?=$nr?>" class="form-control">
                                                            <option value="0" selected="selected">Sconto</option>
                                                            <?=$percentuali_sconto?>
                                                        </select>
                                                        <input type="hidden" name="sconto_camere<?=$nr?>" id="sconto_camere_<?=$nr?>">
                                                        <div id="Imponibile_<?=$nr?>"></div>
                                                    </div>
                                                </td>
                                                <td class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="acconto_richiesta">Caparra <i
                                                                class="fa fa-question-circle text-info"
                                                                data-toggle="tooltip" title="Inserire una %, oppure un importo se si desidera richiedere una caparra!"></i>
                                                            <i class="fa fa-exclamation-triangle text-orange"
                                                                data-toggle="tooltip" title="Se come importo viene inserito un valore inferiore ad 1 euro (0.1, 0.01), automaticamente si abilita la modalità Carta di Credito a Garanzia. Attenzione: se utilizzate questa opzione ricordatevi di disabilitare le altre modalità di pagamento, dal menù delle configurazioni!"></i></label>
                                                        <select name="AccontoPercentuale<?=$nr?>" id="AccontoPercentuale_<?=$nr?>"
                                                            class="form-control">
                                                            <?=$AccontoRichiesta?>
                                                        </select>
                                                        <div id="acconto_l<?=$nr?>"></div>

                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-md-4" colspan="2">
                                                    <div class="form-group">
                                                        <label for="NomeProposta">Tipologia Tariffa</label>
                                                        <select id="EtichettaTariffa_<?=$nr?>" name="EtichettaTariffa<?=$nr?>"
                                                            class="form-control">
                                                            <?php echo $ListaTariffe ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td colspan="4" class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="TestoProposta">Condizioni e politiche di cancellazione per Tariffa</label>
                                                        <textarea rows="3" name="AccontoTesto<?=$nr?>" id="AccontoTesto_<?=$nr?>"
                                                            class="form-control" placeholder="Il campo si autocompila scegliendo la tariffa oppure manualmente!"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-default btn-xs"
                                            data-toggle="modal" data-target="#calculator<?=$nr?>" title="Calcolatrice">
                                            <i class="fa fa-calculator text-blue" aria-hidden="true"></i>
                                        </button>
                                        <div class="modal fade modale_drag draggable" id="calculator<?=$nr?>">
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
<!-- se la richiesta è un preventivo si vede la modifica altrimenti no -->
    <!-- id utile alla compilazione automatica dei prezzi camere in ajax -->
    <div id="valori"></div>
    <div id="valori_serv"></div>
<?}?>
